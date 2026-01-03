<?php
declare (strict_types = 1);
/**
 * Explain: 模板
 */
namespace app\sms\validate;
use think\Validate;
class Template extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =  [
        'template_name'  => 'require',
        'content'  => 'require',
    ];
    protected $message  =  [
        'template_name.require' => '请填写模板名称',
        'content.require' => '请填写模板内容',
    ];
}