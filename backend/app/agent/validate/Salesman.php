<?php
/**
 * Explain: 业务员模型认证
 */
namespace app\agent\validate;
use think\Validate;

class Salesman extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =   [
        'agent_id'  => 'require',
        'nickname'  => 'require',
    ];

    protected $message  =   [
        'agent_id.require' => '请设置所属代理',
        'nickname.require' => '请填写业务员昵称'
    ];
}