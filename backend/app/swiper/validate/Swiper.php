<?php
declare (strict_types = 1);
/**
 * Explain: swiper
 */
namespace app\swiper\validate;
use think\Validate;
class swiper extends Validate
{
    /**
     * 验证规则
     */
    protected $rule =  [
        'title'  => 'require',
        'tab'  => 'require',
        'swiper'  => 'require',
    ];
    protected $message  =  [
        'title.require' => '请填写swiper名称',
        'tab.require' => '请填写调用标签',
        'swiper.require' => '请上传swiper图',
    ];
}