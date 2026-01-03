<?php
declare (strict_types = 1);
/**
 * Explain: 第三方登录
 */
namespace app\common\model\user;
use app\common\model\User;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
class UserConnect extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';
    protected $name = 'connect';

    public function getAddTimeAttr($value)
    {
        if($value){
            return date('Y-m-d H:i:s',$value);
        }
        return '';
    }

    /**
     * 模型名称
     * @var string
     */
    use ModelTrait;

    public function user()
    {
        return $this->hasOne(User::class,'id', 'uid')->bind(['mobile','account']);
    }

}