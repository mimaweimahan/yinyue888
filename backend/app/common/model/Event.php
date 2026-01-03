<?php
declare (strict_types = 1);
/**
 * Explain: 事件
 */
namespace app\common\model;

use app\common\model\BaseModel;
use app\common\traits\ModelTrait;

class Event extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    protected $name = 'event';
    use ModelTrait;
}

