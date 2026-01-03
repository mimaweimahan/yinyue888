<?php
declare (strict_types = 1);
namespace app\common\model\user;
use app\common\model\BaseModel;
use app\common\model\User;
use app\common\traits\ModelTrait;
use think\model\relation\HasOne;
class UserSign extends BaseModel
{
    use ModelTrait;
    /**
     * 获取用户累计签到次数
     * @Parma int $uid 用户id
     * @return int
     * */
    public function getSignSumDay(int $uid)
    {
        return self::where(['uid' => $uid])->count();
    }

    /**
     * 用户昵称
     * @return HasOne
     */
    public function nickname()
    {
        return $this->hasOne(User::class,'id', 'uid')->bind(['nickname']);
    }

    /**
     * 当日签到次数
     * @param int $uid
     * @return int|mixed
     */
    public static function dayNum(int $uid=0){
        //获取上一次签到时间
        $id = self::whereDay('add_time')->where(['uid'=>$uid])->value('id');
        if($id){
            return $id;
        }
        return 0;
    }

    /**
     * 获取累计签到次数
     * @param int $uid
     * @return int|mixed
     */
    public static function totalNum(int $uid=0){
        //获取上一次签到时间
        $last = self::whereDay('add_time', 'yesterday')->where(['uid'=>$uid])->value('total');
        if($last){
            return $last;
        }
        return 0;
    }

}