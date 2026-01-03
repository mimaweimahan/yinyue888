<?php
// +----------------------------------------------------------------------
// | 头像处理
// | author: TT
// +----------------------------------------------------------------------
declare (strict_types = 1);
namespace app\tool\controller;
use app\common\model\User;
use app\common\model\user\UserConnect;
use app\common\model\user\UserData;
use think\facade\Db;
use think\facade\Filesystem;
use think\File;
use core\utils\Tools;

class Avatar {
    /**
     * 根据用户uid获取系统用户头像
     */
	public function index() {
		$uid  = isset($_GET['uid']) ? $_GET['uid'] : 0;
        $avatar_file = UserData::where(['uid'=>$uid])->value('avatar');
        if($avatar_file){
            header('Location: '.$avatar_file."?t=".time()); exit;
        }
        $tx = getConfig('app_config_url').'/statics/avatar.png';
        header('Location: '.$tx);exit;
	}
}
