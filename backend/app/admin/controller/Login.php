<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 系统登录
 */
namespace app\admin\controller;
use app\admin\model\Admin;
use app\common\model\User;
use RobThree\Auth\TwoFactorAuth;
class Login extends \app\Init
{
    protected $admin_id = 0;
    protected function initialize()
    {
        parent::initialize();
        $admin = Admin::loginAdmin();
        if(isset($admin['admin_id']) && $admin['admin_id'] >0 && isset($admin['phone']) && $admin['phone']){
            $this->admin_id = $admin['admin_id'];
        }
    }
		/**
		 * 登录首页
		 */
    public function index()
    {
        if( $this->admin_id >0 ){
            header("Location: ".url('admin/index/index'));exit;
        }
        //验证码
        $user_ip = session_id();
        $verify_lock  = 0;
        if(cache('verify_lock_'.$user_ip)){
            $verify_lock = cache('verify_lock_'.$user_ip);
        }
        $this->assign("verify_lock",$verify_lock);
        return $this->fetch();
    }
		
    /**
     * 登录处理
     */
    public function login(){

        if($this->request->isPost()){
            $user_name   = $this->request->post('user_name','','trim');
            $user_pass   = $this->request->post('user_pass','','trim');
            $verify      = $this->request->post('verify','','trim');
            $google_auth = $this->request->post('google_auth','','trim');



            if(empty($user_name)){
                return $this->error('请填写用户名！'.$user_name);
            }
            if(empty($user_pass)){
                return $this->error('请填写登陆密码！');
            }
            if(mb_strlen($user_pass)<5){
                return $this->error('登陆密码过短！');
            }
            //验证码
            $user_ip     = session_id();
            $verify_lock = 0;
            if(cache('verify_lock_'.$user_ip)){
                $verify_lock = cache('verify_lock_'.$user_ip);
            }
            //如果登陆4次以上还没有登陆成功就开启验证码
            if( $verify_lock > 3 ){
                if(empty($verify)){
                    return $this->error('请填写验证码！');
                }
                if(!captcha_check($verify)){
                    return $this->error('验证码错误！'.$verify);
                }
            }
            /*登陆方式*/
            $type = 1;
            if(isEmail($user_name)){
                $type = 2;
            }
            $login = Admin::login($user_name, $user_pass,$type, 86400 * 180 ,$google_auth);
            if($login['code']==1){
                cache('verify_lock_'.$user_ip,null); //记录登陆错误次数清除
                return app("json")->success('登录成功！',url('admin/index/index'));
            }
            cache('verify_lock_'.$user_ip,$verify_lock+1); //记录登陆错误次数
            return app("json")->fail($login['msg']);
        }
    }

    /**
     * 退出
     */
    public function signout(){
         Admin::outLogin();
         $this->redirect('/admin/login/index');
    }
}