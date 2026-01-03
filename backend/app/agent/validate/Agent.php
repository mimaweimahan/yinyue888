<?php
/**
 * Explain: 代理模型认证
 */
namespace app\agent\validate;
use think\Validate;

class Agent extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =   [
        'username'  => 'require',
        'nickname'  => 'require'
    ];

    protected $message  =   [
        'username.require' => '请填写代理登陆账号',
        'nickname.require' => '请填写代理昵称'
    ];
}