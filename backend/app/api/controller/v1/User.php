<?php
/**
 * 用户
 */
namespace app\api\controller\v1;
use app\admin\model\Config;
use app\agent\model\Agent;
use app\agent\model\Notice;
use app\agent\model\Orders;
use app\agent\model\Salesman;
use app\common\model\User as UserModel;
use app\common\model\user\UserWallet;
use app\common\model\user\UserData;
use RobThree\Auth\TwoFactorAuth;
use app\Request;
use core\utils\Tools;
use think\facade\Db;
use think\facade\Filesystem;
use think\facade\Lang;
use think\Image;

class User
{
    public function index(Request $request){

        $uid = intval($request->uid());
        if($uid == 0){
            return app('json')->fail('没有获取到登录信息');
        }
        $data = UserWallet::getToArray(['uid'=>$uid]);
        return app('json')->success($data);
    }

    public function setaddress(Request $request){
        $uid = intval($request->uid());
        $address = $request->param('address','','trim');
        if(!$address){
            return app('json')->fail( Lang::get('缺少参数'),['address'=>$address]);
        }
        // 判断提交的地址是否已经存在
        $check = UserModel::where(['address_withdraw'=>$address])->count();
        if($check){
            return app('json')->fail( Lang::get('该地址已经被其它账号绑定'));
        }
        
        $rt = UserModel::update(['address_withdraw'=>$address],['id'=>$uid]);
        if($rt){
            return app('json')->success(Lang::get('操作成功'));
        }
        return app('json')->fail(Lang::get('操作失败'));
    }

    /**
     * 获取用户信息
     * @param Request $request
     * @return mixed
     */
    public function info(Request $request){
        $login_uid = intval($request->uid());
        $uid = $request->param('uid',$login_uid,'intval');
        if($uid == 0){
            return app('json')->fail('没有获取到登录信息');
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
        $user = UserModel::info($uid,'id',$hidden);
        $cfg = Config::getMore('withdraw_trc_fee,withdraw_erc_fee,withdraw_min,withdraw_max,level1_rate,level2_rate,level3_rate');
        $withdraw_trc_fee = floatval(isset($cfg['withdraw_trc_fee'])&&$cfg['withdraw_trc_fee']?$cfg['withdraw_trc_fee']:0);
        $withdraw_erc_fee = floatval(isset($cfg['withdraw_erc_fee'])&&$cfg['withdraw_erc_fee']?$cfg['withdraw_erc_fee']:0);
        $userinfo = [
            "uid" => $user['id'],
            "email" => maskEmail($user['email']),
            "country_code" => $user['country_code'],
            "user_type" => $user['user_type'],
            "balance" => $user['balance'],
            "frozen_balance" => $user['frozen_balance'],
            "freeze_balance" => $user['freeze_balance'],
            "in_balance" => $user['in_balance'],
            "out_balance" => $user['out_balance'],
            "profit" => Orders::where(['uid'=>$uid,'status'=>1])->sum('profit'),
            "bonus" => "0.0000",
            "is_set_tran" => 1,
            "address_withdraw" => $user['address_withdraw'],
            "affcode" => "",
            'invite'=>$user['invite'],
            "is_bind" => $user['is_bind'],
            "withdraw_trc_fee" => $withdraw_trc_fee,
            "withdraw_erc_fee" => $withdraw_erc_fee,
            "withdraw_min" => isset($cfg['withdraw_min'])&&$cfg['withdraw_min']?$cfg['withdraw_min']:0,
            "withdraw_max" => isset($cfg['withdraw_max'])&&$cfg['withdraw_max']?$cfg['withdraw_max']:0,
            "level1_rate" => isset($cfg['level1_rate'])&&$cfg['level1_rate']?$cfg['level1_rate']:0,
            "level2_rate" => isset($cfg['level2_rate'])&&$cfg['level2_rate']?$cfg['level2_rate']:0,
            "level3_rate" => isset($cfg['level3_rate'])&&$cfg['level3_rate']?$cfg['level3_rate']:0,
        ];
        $userinfo['avatar'] = getCurrentDomain() . '/statics/avatar.png';
        $userinfo['total_balance'] = $user['balance'] + $user['freeze_balance'];
        $userinfo['balance_number'] = $user['balance'] + $user['freeze_balance'];
        $userinfo['total_balance'] = sprintf("%.4f", $userinfo['total_balance'] );
        //更新用户在线状态
        UserModel::update(['is_online_up' => time(),'is_online'=>1],['id'=>$uid]);
        return app('json')->success($userinfo);
    }

    public function data(Request $request){
        $login_uid = intval($request->uid());
        $uid = $request->param('uid',$login_uid,'intval');
        if($uid == 0){
            return app('json')->fail('没有获取到登录信息');
        }
        $data = UserData::getToArray(['uid'=>$uid]);
        $data['mobile'] = UserModel::where(['id'=>$uid])->value('mobile');
        return app('json')->success($data);
    }

    /**
     * 修改密码
     * @param Request $request
     * @return mixed
     */
    public function pwd(Request $request){
        $uid = $request->uid();
        list($opassword,$password,$password2) = Tools::getData([
            ['opassword', '','trim'],
            ['password', '','trim'],
            ['password2', '','trim'],
        ], $request, true);
        if(!$opassword){
            return app('json')->fail( Lang::get('pwd.请填写旧密码'));
        }
        if(!$password){
            return app('json')->fail( Lang::get('pwd.请填写新密码'));
        }
        if(!$password2){
            return app('json')->fail( Lang::get('pwd.请填写确认密码'));
        }
        $user = UserModel::getToArray(['id'=>$uid]);
        if(think_md5($opassword) != $user['password']){
            return app('json')->fail( Lang::get('pwd.旧密码错误'));
        }
        if($password != $password2){
            return app('json')->fail( Lang::get('pwd.两次密码不一致'));
        }
        $rt = UserModel::update(['password'=>$password],['id'=>$uid]);
        if($rt){
            return app('json')->success( Lang::get('pwd.修改成功'));
        }
        return app('json')->fail( Lang::get('pwd.修改失败'));
    }

    /**
     * 修改交易密码
     * @param Request $request
     * @return mixed
     */
    public function pin(Request $request){
        $uid = $request->uid();
        list($otranpass,$ntranpass,$ctranpass) = Tools::getData([
            ['otranpass', '','trim'],
            ['ntranpass', '','trim'],
            ['ctranpass', '','trim'],
        ], $request, true);
        if(!$otranpass){
            return app('json')->fail( Lang::get('pwd.请填写旧密码'));
        }
        if(!$ntranpass){
            return app('json')->fail( Lang::get('pwd.请填写新密码'));
        }
        if(!$ctranpass){
            return app('json')->fail( Lang::get('pwd.请填写确认密码'));
        }
        if($ntranpass != $ctranpass){
            return app('json')->fail( Lang::get('pwd.两次密码不一致'));
        }
        $user = UserModel::getToArray(['id'=>$uid]);
        if(think_md5($otranpass) != $user['trans_password']){
            return app('json')->fail( Lang::get('pwd.旧密码错误'));
        }
        $rt = UserModel::update(['trans_password'=>$ntranpass],['id'=>$uid]);
        if($rt){
            return app('json')->success( Lang::get('pwd.修改成功'));
        }
        return app('json')->fail( Lang::get('pwd.修改失败'));
    }


    /**
     * 头像设置
     * @param Request $request
     * @return mixed
     * @throws \think\db\exception\DbException
     */
    public function avatar(Request $request){
        $uid = $request->uid();
        $driver = getConfig('file_driver');
        $file   = $request->file('file');
        validate(
            [
                'file' => [
                    // 限制文件大小(单位b)，这里限制为20M
                    'fileSize' => 5 * 1024 * 1024,
                    // 限制文件后缀，多个后缀以英文逗号分割
                    'fileExt'  => 'gif,jpg,png,jpeg,xlsx,xls,doc,docx,ppt,pptx,pdf,txt,zip,rar,mp3,mp4'
                ]
            ],
            [
                'file.fileSize' => '文件太大',
                'file.fileExt' => '不支持的文件后缀',
            ]
        )->check(['file' => $file]);
        if(!$file){
            return app('json')->fail('缺少上传文件',['url'=>'']);
        }
        try {
            $data = [
                'app'=>'user',
                'driver'=>$driver,
                'type_id'=>10000,
                'mime'=>$file->getOriginalMime(),
                'name'=>$file->getOriginalName(),
                'ext'=>$file->extension(),
                'hash'=>$file->hash(),
                'md5'=>$file->md5()
            ];
            $_file_size = $file->getSize();
            $file_size  = round($_file_size/1024,2);
            if($file_size<1024){
                $data['size'] = $file_size;
                $data['unit'] = 'KB';
            }else{
                $data['size'] = round($file_size/1024,2);
                $data['unit'] = 'M';
            }
            $driver_cfg = Filesystem::getDiskConfig('public');
            $path = $driver_cfg['path'].'/avatar';
            $root = $driver_cfg['root'];

            if(!$path){ $path = ''; }
            $data['path'] = $path;

            // 判断文件是否存在
            $save_name = Db::name('file')->where(['hash'=>$data['hash']])->value('savename');
            if($save_name){
                $image = $save_name;
                Db::name('file')->where(['hash'=>$data['hash']])->update(['create_time'=>time()]);
            }else{
                $disk = Filesystem::disk('public');
                //先将图片保存到本地
                $local_save_name = $disk->putFile($path, $file, function () use ($uid){
                    return $uid;
                });
                $local_save_name_path =  $root.'/'.$local_save_name;
                //获取图片后缀
                $res_extension = $file->extension();
                //  以下类型的图片才可以压缩，gif不行
                if ($res_extension == 'jpg' || $res_extension == 'jpeg' || $res_extension == 'png') {
                    //压缩图片
                    $_image = Image::open($local_save_name_path);
                    $_image->thumb(300, 300, 1);
                    $_image->save($local_save_name_path,null,65);
                }
                $image = $local_save_name;
                if($local_save_name){
                    $_file = new \think\File($local_save_name_path);
                    //重新获取文件大小
                    $_file_size = $_file->getSize();
                    $file_size  = round($_file_size/1024,2);
                    if($file_size<1024){
                        $data['size'] = $file_size;
                        $data['unit'] = 'KB';
                    }else{
                        $data['size'] = round($file_size/1024,2);
                        $data['unit'] = 'M';
                    }
                }
            }

            if(!$image){
                return app('json')->fail('上传失败',['url'=>'']);
            }
            //如果是本地上传
            if( $driver  == 'public'){
                //路径不包含域名
                $image_url = '/' . str_replace('\\', '/', $image);
            }else{
                $disk  = Filesystem::disk($driver);
                $image = $disk->putFile($path, $file, function () use ($uid){
                    return $uid;
                });
                if(!$image){
                    return app('json')->fail('上传失败',['url'=>'']);
                }
                $domain = Filesystem::getDiskConfig($driver, 'url');
                if(!$domain){
                    $domain = getConfig('config_app_url');
                }
                //路径包含域名
                $image_url = $domain . '/' . str_replace('\\', '/', $image);
            }
            $data['savename'] = $image;
            $data['url']      = $image_url;
            $data['create_time'] = time();
            if(!$save_name){
                Db::name('file')->insertGetId($data);
            }
            if (strpos($image_url, 'http://')===false && strpos($image_url, 'https://')===false) {
                $data['domain_url'] = getConfig('config_app_url').$image_url;
            }else{
                $data['domain_url'] = $image_url;
            }
            UserData::update(['avatar'=>$data['domain_url']],['uid'=>$uid]);
            return app('json')->success($data);

        } catch (\think\exception\ValidateException|\think\exception\HttpException $e) {
            return app('json')->fail('上传失败,'.$e->getMessage(),['url'=>'']);
        }
    }


    /**
     * 用户自定义广告
     * @param Request $request
     * @return mixed
     */
    public function notice(Request $request){
        $uid = $request->uid();
        $map = [
            'uid'=>$uid,
            'status'=>1
        ];
        $data = Notice::getToArray($map);
        if($data){
            return app('json')->success($data);
        }
        return app('json')->fail();
    }

    /**
     * 用户自定义广告查看
     * @param Request $request
     * @return mixed
     */
    public function seeNotice(Request $request){
        $uid = $request->uid();
        $map = ['uid'=>$uid];
        $rt = Notice::update(['see_at'=>date('Y-m-d H:i:s'),'status'=>0],$map);
        if($rt){
            return app('json')->success($rt);
        }
        return app('json')->fail();
    }

    /**
     * 绑定谷歌验证
     * @param Request $request
     * @return void
     */
    public function noticeList(Request $request){

    }

    /**
     * 获取客服链接
     * @return mixed
     */
    // public function kf(Request $request){
    //     $data = [
    //         'url'=>getConfig('kf_url')
    //     ];
    //     $uid = intval($request->uid());
    //     if($uid>0){
    //         $user   = UserModel::getToArray(['id'=>$uid]);
    //         $worker_kf = Salesman::where(['worker_id'=>$user['worker_id']])->value('telegram');
    //         if($worker_kf){
    //             $data['url'] = 'https://t.me/'.$worker_kf;
    //         }else{
    //             $data['url'] = 'https://t.me/'.Agent::where(['agent_id'=>$user['agent_id']])->value('telegram');
    //         }
    //     }
    //     return app('json')->success($data);
    // }
    /**
     * 获取客服链接
     * 支持未登录访问：
     *   1. 如果提供邮箱或手机号，可查询对应的业务员客服
     *   2. 如果未提供，返回全局客服链接
     * 登录用户可获取个性化客服链接（业务员/代理商）
     * @param Request $request
     * @return mixed
     */
    public function kf(Request $request){
        // 默认获取后台配置的全局客服链接
        $kf_url = getConfig('kf_url');
        
        $user = null;
        
        // 尝试获取用户ID（如果已登录）
        $uid = 0;
        if(method_exists($request, 'uid')){
            $uid = intval($request->uid());
        }
        
        // 如果用户已登录，直接获取用户信息
        if($uid > 0){
            $user = UserModel::getToArray(['id' => $uid]);
        } else {
            // 未登录用户：尝试通过邮箱或手机号查询用户信息
            $email = $request->param('email', '', 'trim');
            $phone = $request->param('phone', '', 'trim');
            
            if($email){
                // 通过邮箱查询
                $user = UserModel::where('email', $email)->find();
                if($user){
                    $user = $user->toArray();
                }
            } elseif($phone){
                // 通过手机号查询（不需要国家代码）
                $user = UserModel::where('phone', $phone)->find();
                if($user){
                    $user = $user->toArray();
                }
            }
        }
        
        // 如果找到了用户信息，尝试获取个性化客服链接
        if($user && isset($user['worker_id']) && isset($user['agent_id'])){
            // 1. 先找业务员的客服信息
            $kf_setting = Salesman::where(['worker_id' => $user['worker_id']])->value('telegram');
            
            // 2. 如果业务员没设，找代理商的
            if(!$kf_setting){
                $kf_setting = Agent::where(['agent_id' => $user['agent_id']])->value('telegram');
            }

            // 3. 处理链接逻辑
            if($kf_setting){
                // 判断数据库里存的是不是已经带了 http 或 https 的完整网页链接
                if(strpos($kf_setting, 'http') === 0){
                    $kf_url = $kf_setting;
                } else {
                    // 如果只是纯账号，则依然按照 Telegram 处理
                    $kf_url = 'https://t.me/' . $kf_setting;
                }
            }
        }

        $data = ['url' => $kf_url];
        return app('json')->success($data);
    }
}