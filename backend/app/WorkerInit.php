<?php
declare (strict_types = 1);
/**
 * 后台公共入口
 */
namespace app;
use app\agent\model\Salesman;

class WorkerInit extends Init{
    protected $agent_id   = 0;
    protected $admin_id   = 0;
    protected $worker_id   = 0;
    protected $admin_info = [];

    // 初始化
    protected function initialize()
    {
        parent::initialize();
        $worker = Salesman::loginInfo();
        $this->assign('admin_info', $worker);
        if(isset($worker['worker_id']) && $worker['worker_id']>0) {
            $this->agent_id   = $worker['agent_id'];
            $this->admin_id   = $worker['worker_id'];
            $this->worker_id  = $worker['worker_id'];
            $this->admin_info = $worker;
            $this->assign('uid', $worker['agent_id']);
            $this->assign('agent_id', $worker['agent_id']);
            $this->assign('worker_id', $worker['worker_id']);
        }else{
            $this->redirect('/worker/login/index');
        }
    }
}
