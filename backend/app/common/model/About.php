<?php
declare (strict_types = 1);
/**
 * Explain: 关于我们
 */
namespace app\common\model;

use app\common\model\BaseModel;
use app\common\traits\ModelTrait;

class About extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    protected $name = 'about';
    use ModelTrait;
}

