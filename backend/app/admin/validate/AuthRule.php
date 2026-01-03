<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 菜单节点验证规则
 */
namespace app\admin\validate;
use think\Validate;
class AuthRule extends Validate
{
    protected $rule =   [
        'title'  => 'require|max:255',
        'name'   => 'require'
    ];
    protected $message  =   [
        'title.require' => '菜单名称不能为空',
        'name.require'  => '名称最多不能超过25个字符',
    ];
    /**
     * 验证场景
     */
    protected $scene = [
        // 'add'  => [''],
        // 'edit' => [],
    ];
}
