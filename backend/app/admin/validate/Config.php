<?php
declare (strict_types = 1);
namespace app\admin\validate;
use think\Validate;
class Config extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =   [
        'name'  => 'require',
        'title'   => 'require',
        'type'   => 'require',
        'group'   => 'require',

    ];
    protected $message  =   [
        'name.require' => '填写配置标识',
        'title.require'  => '填写配置标题',
        'type.require'  => '选择配置配置类型',
        'group.require'  => '请选择所属分组',
    ];
}
