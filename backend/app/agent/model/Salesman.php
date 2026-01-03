<?php
declare (strict_types = 1);
/**
 * Explain: 业务员管理
 */
namespace app\agent\model;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
use think\facade\Cookie;
use think\facade\Session;
use RobThree\Auth\TwoFactorAuth;
class Salesman extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'worker_id';
    use ModelTrait;

    public static function setWorkerPassAttr($data): string
    {
        if($data){
            return think_md5(trim($data));
        }
        return '';
    }

    public static function login($account = '', $password = '', $google_auth = '', $cookie_time = 86400)
    {
        // 管理员登陆状态 保持时间
        $cookie_time = $cookie_time ? $cookie_time : 86400;

        // 登陆成功，判断是否为管理员
        $user = self::getToArray(['worker_user'=>$account]);
        if (!$user) {
            return ['code' => 0, 'msg' =>'账号不存在']; //
        }
        if($user['is_bind'] == 1){
            if(empty($google_auth)){
                return ['code' => 0, 'msg' => '请填写谷歌验证'];
            }
            // 验证谷歌验证码
            $auth = new TwoFactorAuth(config('app.app_name'));
            if( !$auth->verifyCode($user['secret_key'], $google_auth) ){
                return ['code' => 0, 'msg' => '谷歌验证码错误'];
            }
        }

        // 判断管理员权限是否开启
        if ($user['status'] !== 1) {
            return ['code' => 0, 'msg' => '你的账户已经被暂停使用'];
        }
        if (think_md5($password) === $user['worker_pass']) {
            //更新用户登陆记录
            self::update([
                'last_time' => date('Y-m-d H:i:s'),
                'last_ip' => realIp(),
            ],['worker_id'=>$user['worker_id']]);

        }else{
            return ['code' => 0, 'msg' => '密码错误'];
        }

        $user_info = [
            'agent_id' => $user['agent_id'],
            'worker_id' => $user['worker_id'],
            'worker_user' => $user['worker_user'],
            'status' => $user['status'],
            'is_bind' => $user['is_bind'],
            'nickname' => $user['nickname'],
            'telegram' => $user['telegram'],
            'is_account' => $user['is_account'],
        ];

        // 把数据转换为字符串并且进行加密
        $auth = think_encrypt(array2string($user_info), '');
        if($auth){
            // 保存数据到 cookie 及 session
            Cookie::set('worker_auth', $auth, $cookie_time);
            Session::set('worker_auth', $auth);
            return ['code' => 1, 'msg' => '登陆成功'];
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
        //$user_auth = session('worker_auth') ? session('worker_auth') : cookie('worker_auth');
        $user_auth = session('worker_auth');
        if (!$user_auth) {
            return false;
        }
        // 解密数据
        $user_info = think_decrypt($user_auth,'');
        
        // 把得到对数据转换为数组
        $user = string2array($user_info);

        if(isset($user['worker_id']) && $user['worker_id']){

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
        Cookie::delete('worker_auth');
        Session::delete('worker_auth');
    }
}