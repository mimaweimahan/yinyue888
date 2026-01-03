<?php
/**
 * Explain: 账户记录
 */
namespace app\agent\controller\admin;
use app\agent\model\Agent;
use app\agent\model\TaskTpl;
use app\common\traits\ControllerTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Task extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new TaskTpl();
    }
    use ControllerTrait;

    public function index() {
        if($this->request->isPost()){
            $opt = [
                'task_num'=>$this->request->param('task_num',0,'floatval'),
                'task_rate'=>$this->request->param('task_rate',0,'floatval'),
                'is_task'=>$this->request->param('is_task',0,'floatval'),
            ];
            io_cache('TaskCfg', $opt);
            return self::success('修改成功');
        }else{
            $params    = io_cache('TaskCfg');
            $task_rate = $params['task_rate'] ?? 0;
            $task_num  = $params['task_num'] ?? 0;
            $is_task   = $params['is_task'] ?? 0;
            $this->assign('task_num',$task_num);
            $this->assign('is_task',$is_task);
            $this->assign('task_rate',$task_rate);
        }
        return $this->fetch();
    }

    /**
     * 列表
     */
    public function tpl() {
        $where = [];
        $params    = $this->request->param();
        $agent_id  = $this->request->param('agent_id',0,'intval');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            //++++++++++++++++++
            if($agent_id){
                $where[] = ["agent_id","=",$agent_id];
            }
            $data = TaskTpl::getListPage($where,$limit,['created_at'=>'DESC'],$params);
            return self::result_layui($data);
        }
        $this->assign("url", url('tpl'));
        $this->assign("limit", $limit);
        return $this->fetch();
    }

    public function add() {
        if($this->request->isPost()){
            $params = $this->request->param();
            $agent_id = $this->request->param('agent_id',0,'intval');
            if(!$agent_id){
                return self::error('请选择代理');
            }
            //验证数据
            $validate = validate('TaskTpl',[],false,false);
            if( !$validate->check($params) ){
                return self::error($validate->getError());
            }
            //任务编号是否重复
            $be = TaskTpl::getToArray(['agent_id'=>$params['agent_id'],'task_no'=>$params['task_no']]);
            if($be){
                return self::error('任务编号已存在');
            }
            if (TaskTpl::create($params)) {
                return self::success("操作成功");
            }
            return self::error('操作失败');
        }
        $this->assign("agent_list", Agent::getList());
        return $this->fetch();
    }

    public function edit() {
        $id = $this->request->param('id',0,'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        if($this->request->isPost()){
            $params = $this->request->param();
            $agent_id = $this->request->param('agent_id',0,'intval');
            if(!$agent_id){
                return self::error('请选择代理');
            }
            //验证数据
            $validate = validate('TaskTpl',[],false,false);
            if( !$validate->check($params) ){
                return self::error($validate->getError());
            }
            //任务编号是否重复
            $be = TaskTpl::getToArray(['agent_id'=>$params['agent_id'],'task_no'=>$params['task_no']]);
            if($be){
                return self::error('任务编号已存在');
            }
            if (TaskTpl::update($params,['id'=>$id])) {
                return self::success("操作成功");
            }
            return self::error('操作失败');
        }
        $data = TaskTpl::getToArray(['id'=>$id]);
        $this->assign($data);
        $this->assign("agent_list", Agent::getList());
        return $this->fetch();
    }
}