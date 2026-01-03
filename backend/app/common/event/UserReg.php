<?php
declare (strict_types = 1);
namespace app\common\event;
use app\common\model\User;
use app\common\model\user\UserWallet;
use app\common\model\user\UserRecord;
class UserReg
{
    /**
     * 用户成功登录后
     * @param $event
     */
    public function handle($event): void
    {
        [$user,$referee_id] = $event;
        //用户注册
        $reg_bi = intval(getConfig('reg_bi'));
        if($reg_bi){
            UserWallet::updateAc($user['id'],['bi'=>$reg_bi],'新用户福利',5);
        }
        $friend_register_bi = intval(getConfig('friend_register_bi'));
        if($referee_id>0&&$friend_register_bi){
            //1判断注册用户IP和邀请最后登陆的ip是否一致如果一致就跳过奖励
            $no_is_ip = false;
            $referee_ip = User::where(['id'=>$referee_id])->value('last_login_ip');
            if($referee_ip !== $user['reg_ip']){
                $no_is_ip = true;
            }
            //2判断邀请人党人的奖励上限，如果上限就跳过奖励
            $day_max_reward = false;
            $day_reward = UserRecord::where(['uid'=>$referee_id,'type'=>5])->whereTime('add_time', 'today')->sum('bi');
            //每天奖励上限
            $friend_register_max_reward = floatval(getConfig('friend_register_max_reward'));
            if($day_reward<$friend_register_max_reward){
                $day_max_reward = true;
            }
            if($no_is_ip && $day_max_reward){
                UserWallet::updateAc($referee_id,['bi'=>$friend_register_bi],'邀请好友['.$user['nickname'].']，获得奖励',5);
            }
        }
    }
}