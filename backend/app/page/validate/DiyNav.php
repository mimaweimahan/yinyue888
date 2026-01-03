<?php
declare (strict_types = 1);
/**
 * Explain: DiyPage
 */
namespace app\page\validate;
use think\Validate;
class DiyNav extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =  [
        'name'  => 'require',
        'url'  => 'require',
    ];
    protected $message  =  [
        'name.require' => '请填写名称',
        'url.require' => '请填链接地址',
    ];
}