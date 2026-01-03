<?php

namespace app\agent\services;
use app\common\model\User;
class OnlineService
{
    public static function getOnlineUserList(){
        $list = User::where('is_online',1)->select();
        return $list;
    }
    public static function getOnlineUserCount(){
        $count = User::where('is_online',1)->count();
        return $count;
    }

    public static function getOnlineUserListByAgentId($agent_id){
        $list = User::where('is_online',1)->where('agent_id',$agent_id)->select();
        return $list;
    }

    /**
     * 处理离线用户
     * 把用户最后登录时间间隔超过5分钟的 数据设置为离线，is_online_up为最后活动时间，is_online为在线状态
     * @return true
     */
    public static function handleOfflineUser(){
        User::whereTime('is_online_up','<','-5 minute')->where('is_online',1)->update(['is_online'=>0]);
        return true;
    }
}