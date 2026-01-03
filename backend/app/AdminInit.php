<?php
declare (strict_types = 1);
/**
 * 后台公共入口
 */
namespace app;
use think\Auth;
use app\common\service\Rule;
use app\admin\model\Admin;
class AdminInit extends Init{
    protected $admin_id   = 0;
    protected $group_id   = 0;
    protected $uid        = 0;
    protected $admin_info = [];
    protected $app_module = '';
    protected $controller = '';
    protected $action = '';

    // 初始化
    protected function initialize()
    {
        parent::initialize();
        $admin = Admin::loginAdmin();
        $this->app_module = app('http')->getName();
        $this->controller = app('request')->controller();
        $this->action = app('request')->action();
        $this->assign('admin_info', $admin);
        if(isset($admin['admin_id']) && $admin['admin_id']&&isset($admin['phone']) && $admin['phone']){
            $this->admin_id = $admin['admin_id'];
            $this->group_id = $admin['group_id'];
            $this->uid = $admin['uid'];
            $this->admin_info = $admin;
            $this->assign('admin_info', $admin);
            $auth = new Auth();
            $_action_name = substr($this->action,0,7);
            $auth_name    = strtolower($this->app_module.'/'.$this->controller.'/'. $this->action);
            // 接入记录
            // 如果不是超级管理员，并且不属于开放的控制器和方法 就开启权限认证
            if(!($this->admin_id == 1 || $this->group_id == 1 || $this->controller == 'login' || $_action_name == 'public_')){
                if(!$auth->check($auth_name, $this->admin_id)){
                    $this->error('你没有权限'.$auth_name);
                }
            }
        }else{
            $this->redirect('/admin/login/index');
        }
        $this->assign('__app',strtolower($this->app_module));
        $this->assign('__controller',strtolower($this->controller));
        $this->assign('__action',strtolower($this->action)); 
        $this->assign('rule', Rule::info());
        $this->assign('admin_id', $this->admin_id);
    }
}
