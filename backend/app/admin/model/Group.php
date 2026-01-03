<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 管理角色模型
 */
namespace app\admin\model;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
class Group extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    /**
     * 模型名称
     * @var string
     */
    protected $name = 'auth_group';
    use ModelTrait;
}