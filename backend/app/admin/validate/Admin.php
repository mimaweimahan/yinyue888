<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 管理员验证规则
 */
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate
{
    protected $rule =   [
        'phone'  => 'require',
        'nickname'  => 'require',
        'password'  => 'require',
        'group_id'   => 'require'
    ];

    protected $message  =   [
        'nickname.require' => '请填写你的姓名',
        'phone.require'  => '请填写登录手机号',
        'password.require'  => '请填写登录密码',
        'group_id.require'  => '请填选择所属角色',
    ];
    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => ['nickname','phone','password','group_id'],
        'edit' => ['nickname','phone','group_id'],
    ];
}