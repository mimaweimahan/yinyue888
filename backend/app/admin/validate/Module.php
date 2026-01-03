<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 模型安装验证规则
 */
namespace app\admin\validate;
use think\Validate;
class Module extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        'module'  => 'require',
        'module_name'  => 'require',
        'admin_url'  => 'require'
    ];

    protected $message = [
        'module.require' => '模块目录不能为空',
        'module_name.require' => '模块名称不能为空',
        'admin_url.require' => '模块管理地址不能为空'
    ];
}
