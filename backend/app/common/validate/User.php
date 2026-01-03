<?php
namespace app\common\validate;
use think\Validate;
/**
 * 注册验证
 */
class User extends Validate
{
    protected $rule = [
        'country_code'  => 'require',
        'phone'  => 'require',
        'email'  => 'require',
        'nickname'  => 'require',
        'password'  => 'require',
        'trans_password'  => 'require',
    ];

    protected $message  =   [
        'country_code.require' => '请填写国际区号',
        'phone.require' => '请填写手机号',
        'email.require' => '请填写邮箱地址',
        'nickname.require' => '请填写昵称',
        'password.require' => '请填写登陆密码',
        'trans_password.require' => '请填交易密码',
    ];
    public function add()
    {
        return $this->only(['country_code','phone','email','nickname','password','trans_password']);
    }
    public function edit()
    {
        return $this->only(['country_code','phone','email','nickname']);
    }
    public function login()
    {
        return $this->only(['phone','password']);
    }
}