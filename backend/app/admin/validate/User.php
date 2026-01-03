<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 用户验证规则
 */
namespace app\admin\validate;
use think\Validate;
class User extends Validate
{
    protected $rule =   [
        'nickname'  => 'require',
        'account'  => 'require',
        'type_id'  => 'require',
        'grade_id'  => 'require',
        'mobile'  => 'require|mobile',
        'password'=> 'require',
    ];

    protected $message  =   [
        'nickname.require' => '请填写用户昵称',
        'account.require' => '请填写账号名称',
        'type_id.require' => '请填选择户类型',
        'grade_id.require' => '请选择用户等级',
        'mobile.require' => '请填写手机号',
        'mobile.mobile' => '请填写正确的手机号',
        'password.require' => '请填写登录密码',
    ];

    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => ['nickname','account','type_id','grade_id','mobile','password'],
        'edit' => ['nickname','account','type_id','grade_id','mobile'],
    ];
}