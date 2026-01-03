<?php

namespace app\worker\controller;

use app\agent\model\Orders as Order;
use app\agent\model\Salesman;
use app\agent\model\Withdrawal as WithdrawalModel;
use app\common\traits\ControllerTrait;

class Orders extends \app\WorkerInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new Order();
    }
    use ControllerTrait;

    public function index() {
        $where = [];
        $params    = $this->request->param();
        $keys      = $this->request->param('keys','','trim');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status');
        // 账号类型
        $is_pai    = $this->request->param('is_pai');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){

            // 开始时间
            $start_time = $this->request->param('start_time','');
            // 结束时间
            $end_time   = $this->request->param('end_time','');
            $_date = [];
            if (!empty($start_time)) {
                $_date = ['created_at','>=', strtotime($start_time)];
            }
            if (!empty($end_time)) {
                $_date = ['created_at','<=', strtotime($end_time)];
            }
            if ($end_time && $start_time ) {
                $_date = [ ['created_at','>=', strtotime($start_time)], ['created_at','<=', strtotime($end_time)] ];
            }
            if($_date){
                $where[] = $_date;
            }
            //++++++++++++++++++

            $where[] = ["worker_id","=",$this->worker_id];
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type];
            }
            if($is_pai){
                $where[] = ["withdraw_type","=",$is_pai];
            }
            if($status){
                $where[] = ["status","=",$status-1];
            }
            $data = Order::where($where)
                ->order(['created_at'=>'DESC'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();

            $attach = [
                'all_total'=>count($data['data']),
                'all_balance'=>Order::where($where)->sum('total_price')
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("keys", $keys);
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch();
    }
}