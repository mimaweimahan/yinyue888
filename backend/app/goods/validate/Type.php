<?php
/**
 * Explain: 产品分类
 */
namespace app\goods\validate;
use think\Validate;

class Type extends Validate
{
    /**
     * 验证规则
     */
    protected $rule = [
        ['name', 'require', '请填写分类名称']
    ];
}