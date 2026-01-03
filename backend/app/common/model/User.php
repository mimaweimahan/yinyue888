<?php
declare (strict_types = 1);
/**
 * Explain: 用户模型
 */
namespace app\common\model;
use app\agent\model\Orders;
use app\agent\model\WalletLog;
use app\agent\model\Withdrawal;
use core\utils\CountryCode;
use core\utils\ip2region\Ip2Region;
use think\Model;
use think\facade\Db;
use think\facade\Cookie;
use think\facade\Session;
use think\model\relation\HasOne;
use app\common\model\user\UserRecord;
use app\common\model\user\UserData;
use app\common\model\user\UserWallet;
use app\common\traits\JwtAuthModelTrait;
use app\common\traits\ModelTrait;
use app\api\model\Relation;
use core\utils\Tools;

class User extends Model
{
    protected $auto = [];
    public $error = '';

    use JwtAuthModelTrait;
    use ModelTrait;

    public function setNicknameAttr($data): string
    {
        return trim($data);
    }

    // 处理update_time数据
    public function setUpdateTimeAttr(): int
    {
        return time();
    }

    // 密码处理
    public static function setPasswordAttr($data)
    {
        if($data&&trim($data)){
            return think_md5(trim($data));
        }
        return $data;
    }

    // 交易密码 trans_password
    public static function setTransPasswordAttr($data)
    {
        if($data&&trim($data)){
            return think_md5(trim($data));
        }
        return $data;
    }

    // 处理reg_time数据
    public function setRegTimeAttr(): int
    {
        return time();
    }

    // 处理reg_ip数据
    public function setRegIpAttr()
    {
        return realIp();
    }


    /**
     * 等级
     * @return HasOne
     */
    public function relation(): HasOne
    {
        return $this->hasOne(Relation::class,'uid', 'id')->bind(['referee_id']);
    }

    /**
     * 钱包
     * @return HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(UserWallet::class,'uid', 'id');
    }

    // 附表
    public function userInfo(): HasOne
    {
        return $this->hasOne(UserData::class,'uid', 'id');
    }

    public function userData(): HasOne
    {
        return $this->hasOne(UserData::class,'uid', 'id');
    }

    /**
     * 注册入口
     * @param array $opt
     * @param int $user_type
     * @param int $referee_id
     * @return int|string
     */
    public static function register(array $opt=[], int $user_type = 0, int $referee_id=0){
        if(empty($opt['phone']) && empty($opt['email'])) {
            return -101;
        }
        if(empty($opt['nickname']) || empty($opt['password']) ) {
            return -12;
        }
        // 如果提供了手机号，验证国家代码
        if(isset($opt['phone']) && !empty($opt['phone']) && $opt['phone'] !== null){
            if(empty($opt['country_code']) || $opt['country_code'] === null){
                return -13;
            }
        }
        // 如果 phone 为空字符串或 0，设置为 NULL（允许邮箱注册时 phone 为空）
        if(isset($opt['phone']) && ($opt['phone'] === '' || $opt['phone'] === 0 || $opt['phone'] === '0')){
            $opt['phone'] = null;
        }
        // 如果 country_code 为 0 或空，且没有手机号，设置为 NULL（允许邮箱注册时 country_code 为空）
        if(isset($opt['country_code']) && (empty($opt['country_code']) || $opt['country_code'] === 0 || $opt['country_code'] === '0')){
            if(empty($opt['phone']) || $opt['phone'] === null){
                $opt['country_code'] = null;
            }
        }
        // 判断用户是否存在
        if(isset($opt['email']) && $opt['email']) {
            $be = self::where('email',$opt['email'])->value('id');
            if($be){
                return -8; # 用户被暂用
            }
        }
        // 只有当 phone 不为空时才检查手机号是否已存在
        if(isset($opt['phone']) && $opt['phone'] !== null && !empty($opt['phone'])) {
            $be = self::where('phone',$opt['phone'])->value('id');
            if($be){
                return -11; # 用户被暂用
            }
        }
        $agent_id  = 0;
        $worker_id = 0;
        if($referee_id>0){
            $referee = User::getToArray(['id'=>$referee_id]);
            if(!$referee){
                return -100; # 推荐人不存在
            }
            $agent_id  = $referee['agent_id'];
            $worker_id = $referee['worker_id'];
        }
        $opt['reg_ip']      = realIp();
        $opt['reg_time']    = time();
        $opt['update_time'] = time();
        $opt['user_type']   = $user_type;
        $opt['referee_id']  = $referee_id;

        if($agent_id){
            $opt['agent_id'] = $agent_id;
        }
        if($worker_id){
            $opt['worker_id'] = $worker_id;
        }
        // 移除 null 值的字段，避免数据库约束错误（如果字段不允许 NULL）
        // 只移除 null，保留其他值（包括 0, false, '' 等）
        foreach($opt as $key => $value) {
            if($value === null) {
                unset($opt[$key]);
            }
        }
        $db = self::create($opt);
        $uid = $db->id;
        if($uid>0){
            UserData::create(['uid' => $uid]);
            UserWallet::create(['uid' => $uid]);
            return $uid;
        }
        return 0;
    }

    /**
     * 自动登陆，使用用户的ID自动登陆
     * @param int $uid 用户ID
     * @return array|int 返回错误代码
     */
    public static function autoLogin(int $uid = 0)
    {
        // 检测是否用户是否存在
        $user = self::get(['id'=>$uid]);
        if (!$user) {
            return -1001; # 用户用户不存在
        }
        $data = $user->toArray();
        if ($data['status'] !== 1) {
            return -1004; # 用户未激活或已禁用
        }
        // 用户登录记录
        self::loginLog($data);
        return $data;
    }

    /**
     * 执行用户登陆
     * @param string $account 用户名
     * @param string $password 用户密码
     * @param int $type 用户名类型 （1-手机，2-邮箱，3-账号）
     * @param int $cookie_time 登陆状态 cookie 保存时间
     * @return int|mixed 登录成功-用户ID，登录失败-错误编号
     */
    public static function login(string $account = '', string $password = '', int $type = 1, int $cookie_time = 0)
    {
        $map = [];
        switch ($type) {
            case 1:
                $map['phone'] = $account;
                break;
            case 2:
                $map['email'] = $account;
                break;
            case 3:
                $map['account'] = $account;
                break;
            default:
                return 0; //参数错误
        }
        /* 获取用户数据 */
        $user = self::getToArray($map);

        if (!$user) {
            return -1; //用户不存在或被禁用
        }
        if($user['status'] !==1){
            return -1004;//被禁
        }
        if (think_md5($password) === $user['password']) {
            //更新用户登陆记录
            self::loginLog($user, $cookie_time);
            //返回会员id
            return $user['id'];
        }
        //密码错误
        return -2;
    }

    /**
     * 用户登录记录
     * @param array $user 用户信息数组
     * @param int $cookie_time 记录保存时间
     */
    public static function loginLog(array $user = array(), int $cookie_time = 0)
    {
        $cookie_time = $cookie_time ? $cookie_time : 86400;
        $last_login_ip = realIp();
        $last_area = '';
        if($last_login_ip){
            $ip2region = new Ip2Region();
            $arr = $ip2region->get($last_login_ip);
            if($arr && is_array($arr) && count($arr) > 0){
                // 过滤空值并拼接
                $arr = array_filter($arr);
                $last_area = trim(implode(' ', $arr));
            }
        }
        $data = [
            'login' => Db::raw('login + 1'),
            'last_login_time' => time(),
            'last_login_ip' => $last_login_ip,
        ];
        if($last_area){
            $data['last_area'] = $last_area;
        }
        // 更新登录信息
        self::update($data,['id'=>$user['id']]);
        
        $auth = array(
            'uid' => $user['id'],
            'phone' => $user['phone'],
            'email' => $user['email'],
            'nickname' => $user['nickname'],
            'last_login_time' => $user['last_login_time'],
        );
        // 把数据转换为字符串并且进行加密
        $auth = think_encrypt(array2string($auth), '');
        // 保存数据到 cookie 及 session
        Cookie::set('user_auth',$auth,$cookie_time);
        Session::set('user_auth',$auth);
    }

    /**
     * 获取当前登陆用户数据
     * @return array|bool 返回false 或 登陆用户数据
     */
    public static function loginUser()
    {
        // 获取加密数据
        $user_auth = session('user_auth') ? session('user_auth') : cookie('user_auth');
        if (!$user_auth) {
            return false;
        }
        // 解密数据
        $user_info = think_decrypt($user_auth,'');
        // 把得到对数据转换为数组
        return string2array($user_info);
    }

    /**
     * 注销当前用户
     */
    public static function logout()
    {
        Cookie::delete('user_auth');
        Session::delete('user_auth');
    }

    /**
     * 修改密码
     * @param int $uid 用户ID
     * @param string $password  新密码
     * @return User|false
     */
    public static function editPass(int $uid = 0, string $password=''){
        $password = trim($password);
        if($uid>0 && $password){
            return self::update(['password'=>$password],['id'=>$uid]);
        }
        return false;
    }

    /**
     * 获取用户信息
     * @param string $val 或用户名的字段 id，mobile ,email
     * @param string $field
     * @return array|bool
     */
    public static function info(string $val='', string $field='id',$hidden=['password','trans_password','remark','update_time'])
    {
        if(!$val || !$field){
            return false;
        }
        if(!in_array($field,array('id','mobile','invite','email'))){
            return false;//错误的查询字段
        }
        $map = [];
        $map[$field] = $val;
        try {
            $user    = self::where($map)->hidden($hidden)->find();
            $extend  = [];
            $account = [];
            if($user){
                $user    = $user->toArray();
                $extend  = UserData::getToArray(['uid'=>$user['id']]);
                $account = UserWallet::getToArray(['uid'=>$user['id']]);
            }
            if($extend){
                $user = array_merge($user, $extend);
            }
            if($account){
                $user = array_merge($user, $account);
            }
            return $user;
        }catch (\Exception $exception){
            return false;
        }
    }

    /**
     * 更新用户信息
     * @param int $uid 用户id
     * @param string $password 密码，用来验证
     * @param array $data 修改的字段数组
     * @return false|true
     */
    public function updateUserFields(int $uid, string $password, array $data): bool
    {
        if (empty($uid) || empty($password) || empty($data)) {
            $this->error = '参数错误！';
            return false;
        }
        //更新前检查用户密码
        if (!$this->verifyPass($uid, $password)) {
            $this->error = '验证出错：密码不正确！';
            return false;
        }
        //更新用户信息
        if (self::update($data,['id'=>$uid])) {
            return true;
        }
        return false;
    }

    /**
     * 更新附表字段
     */
    public static function editData($uid=0,$data=array()){
        if(!$uid || $data){
            return false;
        }
        return UserData::update($data,['uid'=>$uid]);
    }

    /**
     * 验证用户密码
     * @param int $uid 用户id
     * @param string $password 密码
     * @return false|true
     */
    protected static function verifyPass(int $uid, string $password): bool
    {
        $_password = self::where('id', $uid)->value('password');
        if (think_md5($password, '') === $_password) {
            return true;
        }
        return false;
    }


    /**
     * 删除用户数据
     * @param int|array $uid
     * @return bool
     */
    public static function del( $uid,$map=[]): bool
    {
        if(!$uid){
            return false;
        }
        if(self::whereIn('id', $uid)->where($map)->delete()){
            UserData::whereIn('uid', $uid)->where($map)->delete();
            UserWallet::whereIn('uid', $uid)->where($map)->delete();
            WalletLog::whereIn('uid', $uid)->where($map)->delete();
            Withdrawal::whereIn('uid', $uid)->where($map)->delete();
            Orders::whereIn('uid', $uid)->where($map)->delete();
            return true;
        }
        return false;
    }

    /**
     * 获取手机号是否注册
     * @param $phone
     * @return bool
     */
    public static function checkPhone($phone): bool
    {
        return self::be(['mobile' => $phone]);
    }

    /**
     * 新增之后
     */
    public static function onAfterInsert($data){
        if($data->id){
            $code = Tools::inviteCode($data->id,6);
            self::update(['invite'=>$code],['id'=>$data->id]);
        }
    }

    /**
     * 获取用户注册错误信息
     * @param integer $code 错误编码
     * @return string 错误信息
     */
    public static function showRegError(int $code = 0): string
    {
        switch ($code) {
            case -1:
                $error = '账号或密码错误';
                break;
            case -2:
                $error = '密码错误';
                break;
            case -3:
                $error = '账号被占用';
                break;
            case -4:
                $error = '登陆密码不能少于6位';
                break;
            case -5:
                $error = '请填写正确的邮箱';
                break;
            case -6:
                $error = '邮箱长度必须在1-32个字符之间';
                break;
            case -7:
                $error = '邮箱被禁止注册';
                break;
            case -8:
                $error = '邮箱已存在';
                break;
            case -9:
                $error = '请填写正确的手机号码';
                break;
            case -10:
                $error = '手机被禁止注册';
                break;
            case -11:
                $error = '手机已存在';
                break;
            case -12:
                $error = '创建用户账户失败';
                break;
            case -13:
                $error = '请填写国家代码';
                break;
            case -100:
                $error = '推荐人不存在';
                break;
            case -101:
                $error = '请填写手机号及邮箱号';
                break;
            case -1003:
                $error = '用户不存在';
                break;
            case -1004:
                $error = '账号或已禁用';
                break;
            default:
                $error = '登录失败';
        }
        return $error;
    }

    /**
     * 获取2级用户
     * @param $uid
     * @param int $type 返回类型 1 返回数据列表，2返回总数
     * @return array
     */
    public static function level2list($uid,int $type=1, $limit=10, $params=[],$field=''){
       $level1_ids = self::where('referee_id',$uid)->column('id');
       if($type==2){
           $data = 0;
           if ($level1_ids){
               $data = self::whereIn('referee_id',$level1_ids)->count();
           }
       }else{
           $data = ['data'=>[]];
           if($level1_ids){
               $map = [
                   ['referee_id','IN',$level1_ids],
               ];
               $data = self::getListPage($map,$limit,'id desc',$params,[],$field);
           }
       }
       return $data;
    }

    /**
     * 获取3级用户
     * @param $uid
     * @param int $type 返回类型 1 返回数据列表，2返回总数
     * @return array | int
     */
    public static function level3list($uid, int $type=1, $limit=10, $params=[],$field=''){
        $level1_ids = self::where('referee_id',$uid)->column('id');
        if(!$level1_ids){
            if($type==2){
                return 0;
            }else{
                return [];
            }
        }

        $level2_ids = self::whereIn('referee_id',$level1_ids)->column('id');
        if(!$level2_ids){
            if($type==2){
                return 0;
            }else{
                return ['data'=>[]];
            }
        }

        if($type==2){
            return self::whereIn('referee_id',$level2_ids)->count();
        }else{
            $map = [
                ['referee_id','IN',$level2_ids],
            ];
            return self::getListPage($map,$limit,'id desc',$params,[],$field);
        }
    }
}