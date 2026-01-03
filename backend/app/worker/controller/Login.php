<?php

namespace app\worker\controller;
use app\agent\model\Salesman;
use app\Init;

class Login extends Init

{
    protected $worker_id = 0;
    protected function initialize()
    {
        parent::initialize();
        $admin = Salesman::loginInfo();
        if(isset($admin['worker_id']) && $admin['worker_id'] >0 ){
            $this->worker_id = $admin['worker_id'];
        }
    }
    public function index()
    {
        if( $this->worker_id >0 ){
            header("Location: ".url('worker/index/index'));exit;
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
            $user_name = input('post.user_name');
            $user_pass = input('post.user_pass');
            $verify    = input('post.verify');
            if(empty($user_name)){
                return $this->error('请填写用户名');
            }
            if(empty($user_pass)){
                return $this->error('请填写登陆密码');
            }
            if(mb_strlen($user_pass)<5){
                return $this->error('登陆密码过短');
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
                    return $this->error('请填写验证码');
                }
                if(!captcha_check($verify)){
                    return $this->error('验证码错误');
                }
            }
            $google_auth = $this->request->param('google_auth','','trim');
            /*登陆方式*/
            $login = Salesman::login($user_name, $user_pass, $google_auth );
            if($login['code']==1){
                cache('verify_lock_'.$user_ip,null); //记录登陆错误次数清除
                return app("json")->success('登录成功！',url('worker/index/index'));
            }
            cache('verify_lock_'.$user_ip,$verify_lock+1); //记录登陆错误次数
            return app("json")->fail($login['msg']);
        }
    }

    /**
     * 退出
     */
    public function signout(){
        Salesman::outLogin();
        $this->redirect('/worker/login/index');
    }
}