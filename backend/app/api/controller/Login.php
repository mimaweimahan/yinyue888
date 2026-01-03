<?php
namespace app\api\controller;
use core\utils\Tools;
use think\Exception;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\exception\ValidateException;
use think\db\exception\ModelNotFoundException;
use think\facade\Cache;
use app\sms\services\SmsService;
use app\common\model\User;
use app\common\model\user\UserToken;
use app\common\validate\Register;
use app\api\model\Relation;
use app\Request;
use think\facade\Lang;

class Login
{
    /**
     * 账号登录
     * @param Request $request
     * @return mixed
     * @throws Exception
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function index(Request $request){
        $account       = $request->param('account','','trim');
        $password      = $request->param('password','','trim');
        $ac_type       = $request->param('ac_type',1,'intval');
        $country_code  = $request->param('country_code',0,'intval');
        if($ac_type==1 && !$country_code){
            return app('json')->fail(Lang::get('login.请选择国家码'));
        }

        $client   = $request->header('form-client','app');
        if(!$account || !$password){
            return app('json')->fail(Lang::get('login.账号或密码错误'));//
        }
        if($ac_type==1){
            $user = User::where('phone',$account)->where('country_code',$country_code)->find();
        }else{
            $user = User::where('email',$account)->find();
        }
        if (!$user){
            return app('json')->fail( Lang::get('login.账号或密码错误') ,['lang'=>Lang::getLangSet()]);
        }
        if ($user->password !== think_md5($password)){
            return app('json')->fail( Lang::get('login.账号或密码错误') );
        }
        if ($user->status !==1){
            return app('json')->fail( Lang::get('login.账号已被禁用') );
        }
        $hidden = [
            'password','remark','update_time',
            'type_id','is_top','is_auto_paid','del_time','is_ip_repeat','is_guid_repeat',
            'login_key',
            'reg_ip',
            'reg_time',
            'withdraw_notice',
            'is_withdraw'
        ];
        $userInfo = User::info($user->id,'id',$hidden);
        $token    = UserToken::createToken($user, 'user');
        if ($token) {
            // 更新最后登录时间
            User::loginLog($user->toArray());
            event('UserLogin', [$userInfo, $token]);
            return app('json')->success( Lang::get('login.登陆成功') , [
                'client' => $client,
                'token' => $token->token,
                'userInfo' => $userInfo,
                'expires_time' => strtotime($token->expires_time)
            ]);
        }
        return app('json')->fail( Lang::get('login.登陆失败') );
    }

    /**
     * 退出登录
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        $uid = $request->header('uid',0);
        if($uid > 0){
            User::logout();
            UserToken::destroy(['uid'=>$uid]);
        }
        $token = trim(ltrim($request->header('Authori-zation'), 'Bearer'));
        if(!$token)  $token = trim(ltrim($request->header('Authorization'), 'Bearer'));
        if($token){
            UserToken::destroy(['token'=>$token]);
        }
        return app('json')->success('成功');
    }

    /**
     * 注册新用户
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        list($email,$phone,$country_code, $password, $password2, $tranpass, $invite) = Tools::postData([
            ['email', ''],
            ['phone', ''],
            ['country_code', ''],
            ['password', 0],
            ['password2', ''],
            ['tranpass', ''],
            ['invite', ''],
        ], $request, true);

        // 手机号或邮箱至少需要提供一个
        if(!$email && !$phone){
            return app('json')->fail( Lang::get('register.请填写手机号码或邮箱') );
        }

        // 如果提供邮箱，验证邮箱格式
        if($email){
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return app('json')->fail( Lang::get('register.请填入正确的邮箱') );
            }
        }

        // 如果提供手机号，验证手机号格式和国家代码
        if($phone){
            if (!validateLocalPhone($phone)){
                return app('json')->fail( Lang::get('register.请填入正确的手机号码') );
            }
            if(!$country_code){
                return app('json')->fail( Lang::get('register.请填入国家代码') );
            }
        }
        if(!$password){
            return app('json')->fail(Lang::get('register.请填写密码'));
        }
        if (strlen(trim($password)) < 6 || strlen(trim($password)) > 16){
            return app('json')->fail(Lang::get('register.登陆密码不能少于6位'));
        }
        if ($password == '123456'||$password == '111111'||$password == '000000') return app('json')->fail(Lang::get('register.密码太过简单'));

        if(!$tranpass){
            return app('json')->fail(Lang::get('register.请填写交易密码'));
        }
        if (strlen(trim($tranpass)) < 6 || strlen(trim($tranpass)) > 16){
            return app('json')->fail(Lang::get('register.交易密码不能少于6位'));
        }
        // 检查交易密码是否与登录密码相同
        if ($tranpass == $password){
            return app('json')->fail(Lang::get('register.交易密码不能与登录密码相同'));
        }
        // 检查交易密码是否过于简单
        // if ($tranpass == '123456'||$tranpass == '111111'||$tranpass == '000000'){
        //     return app('json')->fail(Lang::get('register.交易密码太过简单'));
        // }

        if ($password != $password2){
            return app('json')->fail(Lang::get('register.两次输入的密码不一致'));
        }

        if (!$invite){
            return app('json')->fail(Lang::get('register.请填写邀请码'));
        }

        $referee = User::getToArray(['invite'=>$invite]);
        if(!$referee){
            return app('json')->fail(Lang::get('register.邀请码无效'));
        }
        if($referee['is_invite']==1){
            return app('json')->fail(Lang::get('register.邀请码被禁用'));
        }
        $opt = [
            'password' => $password,
            'trans_password' => $tranpass,
        ];
        
        // 根据注册方式设置不同的字段
        if($email){
            $opt['email'] = $email;
            $opt['nickname'] = maskEmail($email);
            // 邮箱注册时，不传递 phone 和 country_code 字段（不设置为 null，而是不传递）
        }
        if($phone){
            $opt['phone'] = $phone;
            $opt['country_code'] = $country_code;
            // 如果只有手机号没有邮箱，使用手机号作为昵称
            if(!$email){
                $opt['nickname'] = substr($phone, 0, 3) . '****' . substr($phone, -4);
            }
        }
        
        // 检查邮箱是否已被注册
        if($email){
            $be = User::where('email',$email)->lock(true)->value('id');
            if($be){
                return app('json')->fail( Lang::get('邮箱已被注册') );
            }
        }
        
        // 检查手机号是否已被注册
        if($phone){
            $be = User::where('phone',$phone)->lock(true)->value('id');
            if($be){
                return app('json')->fail( Lang::get('手机号码已被注册') );
            }
        }
        
        $uid = User::register($opt,0,$referee['id']);
        if($uid>0){
            Relation::binding($uid, $referee['id']);
            $hidden = [
                'password','remark','update_time',
                'type_id','is_top','is_auto_paid','del_time','is_ip_repeat','is_guid_repeat',
                'login_key',
                'reg_ip',
                'reg_time',
                'withdraw_notice',
                'is_withdraw'
            ];
            $user  = User::find($uid);
            $token = UserToken::createToken($user, 'app');
            if ($token) {
                $userInfo = User::info($uid,'id',$hidden);
                event('UserLogin', [$userInfo, $token]);
                return app('json')->success(Lang::get('register.注册成功'), [
                    'token' => $token->token,
                    'userInfo' => $userInfo,
                    'expires_time' => strtotime($token->expires_time)
                ]);
            }
            return app('json')->success(Lang::get('register.注册成功'));
        }
        $err = Lang::get(User::showRegError($uid));
        return app('json')->fail($err);
    }
}