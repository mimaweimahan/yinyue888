<?php

namespace app\agent\controller\admin;

use app\agent\model\Agent;
use app\agent\model\AgentLog;
use app\common\traits\ControllerTrait;

class Record extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new AgentLog();
    }
    use ControllerTrait;

    public function index() {
        $where = [];
        $params    = $this->request->param();
        $agent_id  = $this->request->param('agent_id',0,'intval');
        // 类型
        $type  = $this->request->param('type','','intval');
        $limit = $this->request->param('limit',10,'intval');
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
            if($agent_id){
                $where[] = ["agent_id","=",$agent_id];
            }
            if($type){
                $where[] = ["type","=",$type];
            }
            $data = AgentLog::getListPage($where,$limit,['created_at'=>'DESC'],$params,['agentName']);
            $attach = [
                'all_total'=>count($data['data']),
                'all_balance'=>AgentLog::where($where)->sum('balance'),
                'map'=>$where
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        $this->assign("agent_list", Agent::getList());
        return $this->fetch();
    }
}