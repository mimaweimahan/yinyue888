<?php

namespace app\agent\validate;

use think\Validate;

class TaskTpl extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =   [
        'agent_id'  => 'require',
        'name'  => 'require',
        'task_no'  => 'require',
        'start_balance'  => 'require',
        'end_balance'  => 'require',
        'task_rate'  => 'require',
    ];

    protected $message  =   [
        'agent_id.require' => '请设置所属代理',
        'name.require' => '请填写模版名称',
        'task_no.require' => '请填写任务编号',
        'start_balance.require' => '请填写最大派单',
        'end_balance.require' => '请填写最小派单',
        'task_rate.require' => '请填写收益倍数',
    ];
}