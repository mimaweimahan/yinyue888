<?php
declare (strict_types = 1);
/**
 * Explain: 用户钱包地址
 */
namespace app\common\model\user;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
class UserAddress extends BaseModel
{
    /**
     * 模型名称
     * @var string
     */
    use ModelTrait;

    public static function getCreatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',$data);
        }
        return '';
    }

    public static function getUpdatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',$data);
        }
        return '';
    }
}