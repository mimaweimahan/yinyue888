<?php
declare (strict_types = 1);
namespace app\admin\validate;
use think\Validate;
class Manager extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        ['group_id', 'require', '请选择所属岗位'],
        ['nickname', 'require', '用户名不能为空'],
        ['account', 'require', '账户不能为空'],
        ['password', 'require|min:6', '密码不能为空|密码不能少于6位'],
        ['mobile', 'require|min:11|max:11', '请填写手机号|请填写正确的手机号|请填写正确的手机号'],
        // ['mobile', 'unique:member', '手机号已经存在'],
    ];

    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => ['group_id','nickname','password','mobile'],
        'edit' => ['group_id','nickname','mobile'],
    ];

}
