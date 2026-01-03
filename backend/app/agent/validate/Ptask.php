<?php
/**
 * Explain: 代理模型认证
 */
namespace app\agent\validate;
use think\Validate;

class Ptask extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =   [
        'task_no'  => 'require',
        'task_rate'  => 'require',
        'start_balance'  => 'require',
        'end_balance'  => 'require'
    ];

    protected $message  =   [
        'task_no.require' => '请填写任务编号',
        'task_rate.require' => '请填写收益倍数',
        'start_balance.require' => '请填写派单最小值',
        'end_balance.require' => '请填写派单最大值'
    ];
}