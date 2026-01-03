<?php
declare (strict_types = 1);
/**
 * Explain: 全局公告
 */
namespace app\common\model;

use app\common\model\BaseModel;
use app\common\traits\ModelTrait;

class Notice extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    protected $name = 'notice';
    use ModelTrait;

    /**
     * 状态：隐藏
     */
    const STATUS_HIDE = 0;
    
    /**
     * 状态：显示
     */
    const STATUS_SHOW = 1;
}

