<?php
declare (strict_types = 1);
namespace app\admin\validate;
use think\Validate;
class Group extends Validate
{
    protected $rule =   [
        'title'  => 'require|max:255'
    ];
    protected $message  =   [
        'title.require' => '菜单名称不能为空',
        'title.max'  => '名称最多不能超过25个字符'
    ];
}
