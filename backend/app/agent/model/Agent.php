<?php
/**
 * Explain: 代理模型
 */
namespace app\agent\model;
use app\common\traits\ModelTrait;
use think\facade\Cookie;
use think\facade\Session;
use think\Model;
use RobThree\Auth\TwoFactorAuth;
class Agent extends Model
{
    protected $pk = 'agent_id';
    use ModelTrait;
    // 密码处理
    public static function setPasswordAttr($data): string
    {
        if(!empty($data)){
            return think_md5(trim($data));
        }
        return $data;
    }

    public static function login($account = '', $password = '', $google_auth ='', $cookie_time = 86400)
    {
        // 管理员登陆状态 保持时间
        $cookie_time = $cookie_time ? $cookie_time : 86400;

        // 登陆成功，判断是否为管理员
        $agent = self::getToArray(['username'=>$account]);
        if (!$agent) {
            return ['code' => 0, 'msg' =>'账号不存在']; //
        }
        // 判断管理员权限是否开启
        if ($agent['status'] !== 1) {
            return ['code' => 0, 'msg' => '你的账户已经被暂停使用'];
        }

        if($agent['is_bind'] == 1){

            if(empty($google_auth)){
                return ['code' => 0, 'msg' => '请填写谷歌验证'];
            }
            // 验证谷歌验证码
            $auth = new TwoFactorAuth(config('app.app_name'));
            if( !$auth->verifyCode($agent['secret_key'], $google_auth) ){
                return ['code' => 0, 'msg' => '谷歌验证码错误'];
            }
        }

        // 验证密码
        if (think_md5($password) === $agent['password']) {
            //更新用户登陆记录
            self::update([
                'last_time' => date('Y-m-d H:i:s'),
                'last_ip' => realIp(),
            ],['agent_id'=>$agent['agent_id']]);
        }else{
            return ['code' => 0, 'msg' => '密码错误'];
        }

        $agent_info = [
            'agent_id' => $agent['agent_id'],
            'username' => $agent['username'],
            'nickname' => $agent['nickname'],
            'status' => $agent['status'],
            'is_bind' => $agent['is_bind'],
            'telegram' => $agent['telegram']
        ];

        // 把数据转换为字符串并且进行加密
        $auth = think_encrypt(array2string($agent_info), '');
        if($auth){
            // 保存数据到 cookie 及 session
            Cookie::set('agent_auth', $auth, $cookie_time);
            Session::set('agent_auth', $auth);
            return ['code' => 1, 'msg' => '登陆成功', 'data' => $agent_info];
        }
        return ['code' => 0, 'msg' => '登陆失败！'];
    }

    # 2.获取当前登陆管理员的相关数据
    /**
     * 获取当前登陆用户数据
     * @return array|bool|string 返回false 或 登陆用户数据
     */
    public static function loginInfo()
    {
        // 获取加密数据
        //$user_auth = session('agent_auth') ? session('agent_auth') : cookie('agent_auth');
        $user_auth = session('agent_auth');
        if (!$user_auth) {
            return false;
        }
        // 解密数据
        $user_info = think_decrypt($user_auth,'');
        // 把得到对数据转换为数组
        $user = string2array($user_info);

        if(isset($user['agent_id']) && $user['agent_id']){
            return $user;
        }
        return false;
    }

    # 3.登出处理
    /**
     * 登出处理
     */
    public static function outLogin()
    {
        Cookie::delete('agent_auth');
        Session::delete('agent_auth');
    }
}