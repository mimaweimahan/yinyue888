<?php
/**
 * Explain: 代理业务员
 */
namespace app\agent\controller\sys;
use app\agent\model\Recharge as RechargeModel;
use app\agent\model\Salesman;
use app\common\model\user\UserWallet;
use app\common\traits\ControllerTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Recharge extends \app\AgentInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new RechargeModel();
    }
    use ControllerTrait;
    /**
     * 列表
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function index() {
        $where = [];
        $params    = $this->request->param();
        $keys      = $this->request->param('keys','','trim');
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status',0,'intval');

        // 账号类型
        // 0TRC，1ERC ，2BSC
        $address_type = $this->request->param('address_type',0,'intval');
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
            $where[] = ["agent_id","=",$this->agent_id];
            //++++++++++++++++++

            if($worker_id){
                $where[] = ["worker_id","=",$worker_id];
            }
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($status){
                $where[] = ["status","=",$status-1];
            }
            $data = RechargeModel::where($where)
                ->order(['created_at'=>'DESC'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();

            $attach = [
                'all_total'=>count($data['data']),
                'all_balance'=>RechargeModel::where($where)->sum('balance')
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("keys", $keys);
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        $this->assign("salesman_list", Salesman::getList(['agent_id'=>$this->agent_id]));
        return $this->fetch();
    }
    /**
     * 充值审批
     * @return string
     */
    public function approval(){
        $id = $this->request->param('id', 0, 'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        $result = $this->model::getToArray(['id'=>$id]);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $this->assign($result);
        return $this->fetch();
    }

}