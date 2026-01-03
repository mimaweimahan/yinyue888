<?php
declare (strict_types = 1);
/**
 * Explain: 用户公告
 */
namespace app\agent\model;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;

class Notice extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'uid';
    protected $name = 'user_notice';
    use ModelTrait;

}