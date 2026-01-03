<?php
declare (strict_types = 1);
/**
 * Explain: 条款
 */
namespace app\common\model;

use app\common\model\BaseModel;
use app\common\traits\ModelTrait;

class Clause extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    protected $name = 'clause';
    use ModelTrait;
}

