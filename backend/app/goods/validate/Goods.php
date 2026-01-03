<?php
/**
 * Explain: 产品模块
 */
namespace app\goods\validate;
use think\Validate;

class Goods extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =   [
        'title'  => 'require',
        'type_id'  => 'require',
        'image'  => 'require'
    ];

    protected $message  =   [
        'title.require' => '商品名称不能为空',
        'type_id.require' => '商品分类不能为空',
        'image.require' => '请上传产品图片'
    ];
}