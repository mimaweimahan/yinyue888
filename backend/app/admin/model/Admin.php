<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 管理员模型
 */
namespace app\admin\model;
use app\common\model\User;
use think\Model;
use think\facade\Db;
use think\facade\Cookie;
use think\facade\Session;
use think\model\relation\HasOne;
use app\common\traits\ModelTrait;
use RobThree\Auth\TwoFactorAuth;
class Admin extends Model
{
    protected $name = 'admin';

    use ModelTrait;

    public function users(): HasOne
    {
        return $this->hasOne(User::class,'id', 'uid')->bind(['phone','email']);
    }

    public static function login($account = '', $password = '', $type = 1, $cookie_time = 86400, $google_auth = '')
    {
        // 管理员登陆状态 保持时间
        $cookie_time = $cookie_time ? $cookie_time : 86400;

        $uid = User::login($account, $password, $type, $cookie_time);
        if($uid<1){
            return ['code' => 0, 'msg' => User::showRegError($uid)];
        }
        // 登陆成功，判断是否为管理员
        $admin = self::where(['uid'=>$uid])->find();
        if (!$admin) {
            return ['code' => 0, 'msg' =>'不是管理员身份']; //
        }
        $admin = $admin->toArray();
        // 判断管理员权限是否开启
        if ($admin['status'] !== 1) {
            return ['code' => 0, 'msg' => '你的账户已经被暂停使用'.$admin['status']];
        }
        // 验证谷歌验证码
        if($admin['is_bind']==1 && empty($google_auth)){
            return ['code' => 0, 'msg' => '请填写谷歌验证码！'];
        }
        if($admin['is_bind']==1 && $google_auth){
            $auth = new TwoFactorAuth(config('app.app_name'));
            if( !$auth->verifyCode($admin['secret_key'], $google_auth) ){
                return ['code' => 0, 'msg' => '谷歌验证码错误'];
            }
        }
        $admin['admin_id'] = $admin['id'];
        unset( $admin['id'] );
        // 获取管理员岗位
        $admin['group_id'] = Db::name('AuthGroupAccess')->where('uid', $admin['admin_id'])->value('group_id');

        // 获取管理员岗位
        $admin['rules'] = Db::name('AuthGroup')->where('id', $admin['group_id'])->value('rules');

        // 获取管理员对应的用户数据
        $user_info = User::loginUser();
        // 清除用户表的里面的 用户组group_id避免和管理员的岗位group_id冲突
        unset($user_info['group_id']);
        // 整合管理员数据
        $admin_info = array_merge($admin, $user_info);
        if(isset($admin['admin_id']) && $uid == 1){
            $admin['group_id'] = 0;
        }
        // 把数据转换为字符串并且进行加密
        $auth = think_encrypt(array2string($admin_info), '');
        if($auth){
            // 保存数据到 cookie 及 session
            Cookie::set('admin_auth', $auth, $cookie_time);
            Session::set('admin_auth', $auth);
            return ['code' => 1, 'msg' => '登陆成功'];
        }
        return ['code' => 0, 'msg' => '登陆失败！'];
    }

    # 2.获取当前登陆管理员的相关数据
    /**
     * 获取当前登陆用户数据
     * @return array|bool|string 返回false 或 登陆用户数据
     */
    public static function loginAdmin()
    {
        // 获取加密数据
        //$user_auth = session('admin_auth') ? session('admin_auth') : cookie('admin_auth');
        $user_auth = session('admin_auth');
        if (!$user_auth) {
            return false;
        }
        // 解密数据
        $user_info = think_decrypt($user_auth,'');
        // 把得到对数据转换为数组
        $admin = string2array($user_info);

        if(isset($admin['admin_id']) && $admin['admin_id']){
            if(isset($admin['group_id']) && $admin['group_id']){
                $admin['rules'] = Db::name('AuthGroup')->where(['id'=>$admin['group_id']])->value('rules');
            }else{
                $admin['group_id'] = 0;
                $admin['rules'] = '';
            }
            return $admin;
        }
        return false;
    }

    # 3.登出处理
    /**
     * 登出处理
     * @param int $type 登出类型 2 同时登出用户登陆及管理员登陆状态，其他只登出管理员登陆状态
     */
    public static function outLogin($type=2)
    {
        if($type == 2){
            // 清除用户登陆状态
            Cookie::delete('user_auth');
            Session::delete('user_auth');

            // 清除管理员登陆状态
            Cookie::delete('admin_auth');
            Session::delete('admin_auth');

        }else{
            // 只清除管理员登陆状态
            Cookie::delete('admin_auth');
            Session::delete('admin_auth');
        }
    }

    /**
     * 注册管理员
     * @param array $opt
     * @return array
     * @throws \think\db\exception\DbException
     */
    public static function register($opt=['phone'=>'','password'=>'','email'=>'','nickname'=>'','group_id'=>0,'status'=>0])
    {
        if( !isset($opt['phone']) && isset($opt['email'])  ){
            return ['status' => 0, 'error' => '缺少账号信息'];
        }
        // 判断用户是否已经存在
        $uid = User::where(['phone|email'=>$opt['phone']])->value('id');
        if(empty($opt['country_code'])){
            $opt['country_code'] = 1;
        }
        // 如果不存在就注册
        if(!$uid){
            $uid = User::register([
                'phone'=>$opt['phone'],
                'country_code'=>$opt['country_code'],
                'password'=>$opt['password'],
                'email'=>$opt['email'],
                'nickname'=>$opt['nickname'],
                'type_id'=>99
            ],1);
            if( $uid < 0 || $uid == 0){
                return ['status' => 0, 'error' => User::showRegError($uid)];
            }
        }

        // 判断管理员是否重复创建

        if( (new self())->where(['uid'=>$uid])->value('id') ){
            return ['status' => 0, 'error' => '管理员不能重复创建！'];
        }
        // 管理员创建成功接做创建 管理员岗位关系
        if($admin_id = (new self())->insertGetId(['uid'=>$uid,'status'=>$opt['status']])){
            // 创建之前先清除之前可能存在的沉余数据
            Db::name('AuthGroupAccess')->where('uid', $admin_id)->delete();
            Db::name('AuthGroupAccess')->insertGetId(['uid'=>$admin_id, 'group_id'=>$opt['group_id']]);
            return ['status' => 1, 'admin_id'=>$admin_id, 'uid'=>$uid, 'group_id'=>$opt['group_id'], 'error' =>'新增成功！'];
        }
        return ['status' => 0, 'error' => '新增失败'];
    }
}
