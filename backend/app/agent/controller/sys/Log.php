<?php
/**
 * Explain: 账户记录
 */
namespace app\agent\controller\sys;
use app\agent\model\WalletLog;
use app\agent\model\Salesman;
use app\common\traits\ControllerTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Log extends \app\AgentInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new WalletLog();
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
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status',0,'intval');

        // 类型
        // 0TRC，1ERC ，2BSC
        $change_type = $this->request->param('change_type',0,'intval');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            // 开始时间
            $start_time = $this->request->param('start_time','','trim');
            // 结束时间
            $end_time   = $this->request->param('end_time','','trim');
            $_date = [];
            if (!empty($start_time) ) {
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
            $where[] = ["agent_id","=",$this->agent_id];
            if($worker_id){
                $where[] = ["worker_id","=",$worker_id];
            }
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type-1];
            }
            if($change_type){
                $where[] = ["change_type","=",$change_type];
            }
            if($status){
                $where[] = ["status","=",$status-1];
            }
            $data = WalletLog::getListPage($where,$limit,['created_at'=>'DESC'],$params);
            $attach = [
                'all_total'=>count($data['data']),
                'all_balance'=>WalletLog::where($where)->sum('balance'),
                'map'=>$where
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        return $this->fetch();
    }
}