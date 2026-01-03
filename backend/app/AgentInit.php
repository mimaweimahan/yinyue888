<?php
declare (strict_types = 1);
/**
 * 后台公共入口
 */
namespace app;
use app\agent\model\Agent;
class AgentInit extends Init{
    protected $agent_id   = 0;
    protected $admin_id   = 0;
    protected $admin_info = [];

    // 初始化
    protected function initialize()
    {
        parent::initialize();
        $agent = Agent::loginInfo();
        $this->assign('admin_info', $agent);
        if(isset($agent['agent_id']) && $agent['agent_id']>0) {
            $this->agent_id = $agent['agent_id'];
            $this->admin_id = $agent['agent_id'];
            $this->admin_info = $agent;
            $this->assign('uid', $agent['agent_id']);
            $this->assign('agent_id', $agent['agent_id']);
        }else{
            $this->redirect('/agent/login/index');
        }
    }
}
