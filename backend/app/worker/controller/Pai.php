<?php
/**
 * Explain: 派单管理
 */
namespace app\worker\controller;
use app\agent\model\Ptask;
use app\agent\model\TaskTpl;
use app\common\model\User;
use app\common\traits\ControllerTrait;

class Pai extends \app\WorkerInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new Ptask();
    }
    use ControllerTrait;

    public function index() {
        $uid   = $this->request->param('id',0,'intval');
        $limit = $this->request->param('limit',10,'intval');
        if($uid == 0){
            return self::error('请选择用户！');
        }
        $user = User::getToArray(['id'=>$uid,'agent_id'=>$this->agent_id]);
        $this->assign("url", url('lst',['uid'=>$uid]));
        $this->assign("limit", $limit);
        $this->assign("uid", $uid);
        $this->assign($user);
        return $this->fetch();
    }

    /**
     * 导入模版
     * @return string
     */
    public function import(){
        $uid = $this->request->param('uid',0,'intval');
        if($uid == 0){
            return self::error('请选择用户！');
        }
        if($this->request->isPost()){
            $tpl_id = $this->request->param('tpl_id',0,'intval');
            if($tpl_id == 0){
                return self::error('缺少模版ID');
            }
            $tpl = TaskTpl::getToArray(['id'=>$tpl_id]);
            if(!$tpl){
                return self::error('模版不存在！');
            }
            $data = [];
            $task_no_arr       = str2arr($tpl['task_no'],'/');
            $start_balance_arr = str2arr($tpl['start_balance'],'/');
            $end_balance_arr   = str2arr($tpl['end_balance'],'/');
            if(!$task_no_arr || !$start_balance_arr || !$end_balance_arr){
                return self::error('选择的模版有误，导入失败');
            }
            foreach ($task_no_arr as $k=>$task_no){
                if($task_no && isset($start_balance_arr[$k]) && isset($end_balance_arr[$k]) && $start_balance_arr[$k] && $end_balance_arr[$k]){
                    $data[] = [
                        'uid'        => $uid,
                        'task_no'    => $task_no,
                        'agent_id'   => $tpl['agent_id'],
                        'worker_id'   => $this->worker_id,
                        'start_balance' => $start_balance_arr[$k],
                        'end_balance'  => $end_balance_arr[$k],
                        'task_rate'  => $tpl['task_rate']
                    ];
                }
            }
            if($data){
                $rt = (new Ptask())->insertAll($data);
                if($rt){
                    return self::success('导入成功！');
                }
            }
            return self::error('导入失败！');
        }
        $tpl_list = TaskTpl::getList(['worker_id'=>$this->worker_id]);
        $this->assign("tpl_list", $tpl_list);
        $this->assign("limit", 500);
        $this->assign("uid", $uid);
        $this->assign("url", url('tpl',['uid'=>$uid]));
        return $this->fetch();
    }

    /**
     * 模版列表
     */
    public function tpl(){
        $map = ['worker_id'=>$this->worker_id];
        $params = $this->request->param();
        $limit  = $this->request->param('limit',500,'intval');
        $data   = TaskTpl::getListPage($map,$limit,['created_at'=>'DESC'],$params);
        return self::result_layui($data);
    }

    /**
     * 列表
     */
    public function lst() {
        $where = [];
        $params    = $this->request->param();
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type','');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status','');

        if(!$uid){
            return self::error('请选择用户！');
        }
        $where[] = ["uid","=",$uid];
        $where[] = ["worker_id","=",$this->worker_id];
        // 类型
        $limit      = $this->request->param('limit',10,'intval');

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
        if(!empty($user_type)){
            $where[] = ["user_type","=",intval($user_type)];
        }
        if(!empty($status)){
            $where[] = ["status","=",intval($status)];
        }
        $data = Ptask::getListPage($where,$limit,['created_at'=>'DESC'],$params);
        return self::result_layui($data);
    }

    public function add()
    {
        if($this->request->isPost()){
            $params = $this->request->param();
            $params['worker_id'] = $this->worker_id;
            //验证数据
            $validate = validate('Ptask',[],false,false);
            if( !$validate->check($params) ){
                return self::error($validate->getError());
            }
            //判断是否有未完成的任务
            $be = Ptask::getToArray(['uid'=>$params['uid'],'task_no'=>$params['task_no']]);
            if($be){
                return self::error('用户当前任务编号已经派发啦，不要重复派发');
            }
            if ($this->model->create($params)) {
                return self::success("操作成功");
            }
            return self::error('操作失败');
        }
    }

    /**
     * 清空派单
     * @return string
     */
    public function clear(){
        $uid = $this->request->param('uid',0,'intval');
        if(!$uid){
            return self::error('请选择用户！');
        }
        Ptask::where('uid',$uid)->where('worker_id',$this->worker_id)->delete();
        return self::success('操作成功！');
    }
}