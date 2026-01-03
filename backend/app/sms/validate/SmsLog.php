<?php
declare (strict_types = 1);
/**
 * Explain: 模板
 */
namespace app\sms\validate;
use think\Validate;
class SmsLog extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =  [
        'phone'  => 'require',
        'content'  => 'require',
    ];
    protected $message  =  [
        'phone.require' => '缺少手机号',
        'content.require' => '缺少短信内容',
    ];
}