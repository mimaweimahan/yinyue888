<?php
declare (strict_types = 1);
namespace app;
use app\common\model\User as UserMode;
use think\facade\Config;
use think\facade\Request;
/**
 * 控制器基础类
 */
class Base extends Init
{
    protected $group_id  = 0;
    protected $uid       = 0;
    protected $user_info = [];

    // 初始化
    protected function initialize()
    {
        parent::initialize();
        $user_info = UserMode::loginUser();
        if(isset($user_info['uid']) && $user_info['uid']){
            $this->uid = $user_info['uid'];
            $this->user_info = $user_info;
            $this->assign('user_info', $user_info);
        }
        $module     = app('http')->getName();
        $controller = app('request')->controller();
        $action     = app('request')->action();
        $this->assign('app_path', strtolower($module.'/'.$controller.'/'.$action));
        # 手机主题路径
        $wap_template = app()->getRootPath() . 'public/template/mobile/' .$module. '/';
        # PC主题路径
        $pc_template  = app()->getRootPath() . 'public/template/default/' .$module . '/';
        # 手机模版文件
        $template = $wap_template . strtolower($controller) . '/' .strtolower($action). '.php';
        $domain   = $_SERVER ['HTTP_HOST'];
        $domain_ext = explode('.',$domain);
        if(isset($domain_ext[0]) && $domain_ext[0]){
            $domain_ext = $domain_ext[0];
        }
        # 如果是手机访问并且手机模版存在
        if ( ($domain_ext=='m'|| $domain_ext=='h5' || isMobile()==true ) ) {
            Config::set(['view_path'=>$wap_template],'view');
        }else{
            Config::set(['view_path'=>$pc_template],'view');
        }
    }
}
