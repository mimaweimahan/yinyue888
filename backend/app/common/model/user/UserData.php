<?php
declare (strict_types = 1);
/**
 * Explain: 用户附表
 */
namespace app\common\model\user;
use app\common\model\BaseModel;
use app\common\model\User;
use app\common\traits\ModelTrait;
class UserData extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'uid';
    /**
     * 模型名称
     * @var string
     */
    use ModelTrait;

    public function user()
    {
        return $this->hasOne(User::class,'id', 'uid');
    }
    public function getAvatarAttr($value)
    {
        return $value ?? getCurrentDomain() . '/statics/avatar.png';
    }
}