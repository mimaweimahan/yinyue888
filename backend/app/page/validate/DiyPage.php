<?php
declare (strict_types = 1);
/**
 * Explain: DiyPage
 */
namespace app\page\validate;
use think\Validate;
class DiyPage extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =  [
        'title'  => 'require',
        'thumb'  => 'require',
        'label'  => 'require',
    ];
    protected $message  =  [
        'title.require' => '请填写页面名称',
        'thumb.require' => '请填上传缩略图',
        'label.require' => '请设置页面标签',
    ];
}