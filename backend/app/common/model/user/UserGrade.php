<?php
declare (strict_types = 1);
/**
 * Explain: 用户等级
 */
namespace app\common\model\user;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
class UserGrade extends BaseModel
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
    use ModelTrait;

    public function getDiscountAttr($value)
    {
        if($value){
            $value  = floatval($value);
        }
        return $value;
    }
}