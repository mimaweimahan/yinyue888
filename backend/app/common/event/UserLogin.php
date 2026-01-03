<?php
declare (strict_types = 1);
namespace app\common\event;
use app\common\model\User;

class UserLogin
{
    /**
     * 用户成功登录后
     * @param $event
     */
    public function handle($event): void
    {
        [$user, $token] = $event;
        User::loginLog($user);//登录记录
    }
}