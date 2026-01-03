<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 用户分类验证规则
 */
namespace app\admin\validate;
use think\Validate;
class UserType extends Validate
{
    protected $rule =   [
        'name'  => 'require'
    ];
    protected $message  =   [
        'name.require' => '请填写分类名称'
    ];
}