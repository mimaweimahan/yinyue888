<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 用户等级验证规则
 */
namespace app\admin\validate;
use think\Validate;
class UserGrade extends Validate
{
    protected $rule =   [
        'grade_name'  => 'require'
    ];
    protected $message  =   [
        'grade_name.require' => '请填写用户等级'
    ];
}