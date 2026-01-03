<?php
/**
 * Created by PhpStorm.
 * Explain: 短信模板
 */
namespace app\sms\model;
use think\Model;
use app\common\traits\ModelTrait;
class SmsTemplate extends Model
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    protected $name = 'sms_template';
    use ModelTrait;
}