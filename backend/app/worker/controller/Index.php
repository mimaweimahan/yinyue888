<?php

namespace app\worker\controller;

use app\agent\model\Agent;
use app\agent\model\AgentLog;
use app\agent\model\AgentWithdrawal;
use app\agent\model\Recharge;
use app\agent\model\Salesman;
use app\agent\model\Withdrawal;
use app\common\model\User;
use core\utils\Tools;
use RobThree\Auth\TwoFactorAuth;

class Index extends \app\WorkerInit
{
    public function index()
    {
        $menu_list =  [
            [
                'icon' => '#xe643;',
                'name' => '业务管理',
                'parent' => 0,
                'url' => '/worker/index/init',
                'items' => [
                    [
                        'name' => '用户管理',
                        'url' => '/worker/user/index'
                    ],
                    [
                        'name' => '订单管理',
                        'url' => '/worker/orders/index'
                    ],
                    [
                        'name' => '用户充值记录',
                        'url' => '/worker/recharge/index'
                    ],
                    [
                        'name' => '用户提现记录',
                        'url' => '/worker/withdrawal/index'
                    ],
                    [
                        'name' => '充值地址',
                        'url' => '/worker/address/recharge'
                    ],
                    [
                        'name' => '提现地址',
                        'url' => '/worker/address/withdrawal'
                    ],
                    [
                        'name' => '重粉检测',
                        'url' => '/worker/repeat/index'
                    ],
                    [
                        'name' => '派单任务模版',
                        'url' => '/worker/task/tpl'
                    ]
                ]
            ]
        ];
        $this->assign('left_menu_json', json_encode($menu_list,256));
        return $this->fetch();
    }



    public function main()
    {
        $online_user_num = User::where('is_online',1)->where('worker_id',$this->worker_id)->count();
        $new_user_num    = User::whereDay('reg_time')->where('worker_id',$this->worker_id)->count();
        $task_user_num   = User::where('is_task','=',1)->where('worker_id',$this->worker_id)->count();
        $sc_user_num     = User::whereDay('sc_time')->where('worker_id',$this->worker_id)->count();
        $sc_amount       = Recharge::whereDay('created_at')->where('status',1)->where('is_sc',1)->where('worker_id',$this->worker_id)->sum('balance');
        $recharge_amount = Recharge::where('status',1)->where('is_sys',0)->where('worker_id',$this->worker_id)->sum('balance');
        $recharge_num    = Recharge::where('status',1)->where('is_sys',0)->where('worker_id',$this->worker_id)->group('uid')->count();
        $withdrawal_amount = Withdrawal::where('status',1)->where('worker_id',$this->worker_id)->sum('balance');
        $withdrawal_num    = Withdrawal::where('status',1)->where('worker_id',$this->worker_id)->group('uid')->count();

        //今日提现金额
        $day_withdrawal_amount = Withdrawal::where('status',1)->whereDay('created_at')->where('worker_id',$this->worker_id)->sum('balance');

        //今日充值金额
        $day_recharge_amount = Recharge::where('status',1)->whereDay('created_at')->where('worker_id',$this->worker_id)->sum('balance');
        $day_yk = $day_recharge_amount - $day_withdrawal_amount;
        $charts_data = json_encode( $this->getStats() , 256);

        $this->assign([
            'online_user_num'  => $online_user_num, //在线用户
            'new_user_num'     => $new_user_num, //今日新增用户
            'task_user_num'    => $task_user_num,//参与用户数量
            'sc_user_num'      => $sc_user_num,//首充用户
            'sc_amount'        => $sc_amount,//首充金额
            'recharge_amount'  => $recharge_amount,//充值金额
            'recharge_num'     => $recharge_num,//充值人数
            'withdrawal_amount'=> $withdrawal_amount,//提现金额
            'withdrawal_num'   => $withdrawal_num,//提现人数
            'day_yk'           => $day_yk,//当日盈亏
            'charts_data'      => $charts_data //统计图
        ]);
        return $this->fetch();
    }

    /**
     * 获取最近N天的统计数据
     * @param int $days 天数，默认8天
     * @return array
     */
    public function getStats($days = 16)
    {
        // 生成最近N天的日期数组（包含今天）
        $dates = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('m-d', strtotime("-$i day"));
            $dates[] = $date;
        }

        // 计算日期范围的时间戳
        $startTime = strtotime("-".($days - 1)." day 00:00:00");
        $endTime = strtotime("today 23:59:59");

        // 查询这段时间内每天的注册数量
        $reg_arr = User::whereBetween('reg_time', [$startTime, $endTime])
            ->where('worker_id',$this->worker_id)
            ->field("FROM_UNIXTIME(reg_time, '%m-%d') as date, COUNT(*) as count")
            ->group('date')
            ->select()
            ->toArray();
        if($reg_arr){
            $reg_arr = array_column($reg_arr, 'count', 'date');
        }else{
            $reg_arr = [];
        }
        // 查询这段时间内充值金额
        $recharge_arr = Recharge::whereBetween('created_at', [$startTime, $endTime])
            ->where('status',1)
            ->where('worker_id',$this->worker_id)
            ->field("FROM_UNIXTIME(created_at, '%m-%d') as date, SUM(balance) as c_balance")
            ->group('date')
            ->select()
            ->toArray();

        if($recharge_arr){
            $recharge_arr = array_column($recharge_arr, 'c_balance', 'date');
        }else{
            $recharge_arr = [];
        }

        $withdrawal_arr = Withdrawal::whereBetween('created_at', [$startTime, $endTime])
            ->where('status',1)
            ->where('worker_id',$this->worker_id)
            ->field("FROM_UNIXTIME(created_at, '%m-%d') as date, SUM(balance) as c_balance")
            ->group('date')
            ->select()
            ->toArray();
        if($withdrawal_arr){
            $withdrawal_arr = array_column($withdrawal_arr, 'c_balance', 'date');
        }else{
            $withdrawal_arr = [];
        }

        $data = [];
        // 合并数据，确保所有日期都有记录
        foreach ($dates as $date) {
            $_num = 0;
            if (isset($reg_arr[$date])) {
                $_num = $reg_arr[$date];
            }
            $_cz = 0;
            if (isset($recharge_arr[$date])) {
                $_cz = $recharge_arr[$date];
            }
            $_tx = 0;
            if (isset($withdrawal_arr[$date])) {
                $_tx = $withdrawal_arr[$date];
            }
            $data[] = [
                '当天日期'=>$date,
                '数量'=>$_num,
                '充值'=>$_cz,
                '提现'=>$_tx,
            ];
        }
        return $data;
    }

    public function updated()
    {
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            $cpassword = $this->request->param('cpassword', '','trim');
            $npassword = $this->request->param('npassword', '','trim');
            $npassword2= $this->request->param('npassword2', '','trim');

            if($cpassword && !$npassword){
                return self::error('请输入新密码！');
            }
            if( $cpassword && $npassword && $npassword != $npassword2 ){
                return self::error('新密码两次输入不一致！');
            }
            // 数据验证
            $validate = validate('Agent',[],false,false);
            if (!$validate->check($params)) {
                return self::error($validate->getError());
            }

            $opt = [
                'nickname'=>$params['nickname'],
                'telegram'=>$params['telegram'],
            ];
            if($npassword){
                if(strlen($npassword)<6){
                    return self::error('密码长度不能小于6位！');
                }
                $opt['worker_pass'] = $npassword;
            }

            if ( Salesman::update($opt,['worker_id'=>$this->worker_id]) ) {
                return self::success('编辑成功！',$params);
            }
            return self::error('编辑失败！');
        }
        $result = Salesman::getToArray(['worker_id'=>$this->worker_id]);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $this->assign($result);
        return $this->fetch();
    }

    /**
     * 绑定谷歌验证
     */
    public function binding(){
        $app_name = config('app.app_name');
        if($this->request->isPost()){
            $secret_key = $this->request->param('secret_key','','trim');
            if(!$secret_key){
                return self::error('参数错误！');
            }
            $rt = Salesman::update(['secret_key'=>$secret_key,'is_bind'=>1],['worker_id'=>$this->worker_id]);
            if($rt){
                return self::success('绑定成功！');
            }
            return self::error('绑定失败！');
        }

        $agent = Salesman::getToArray(['worker_id'=>$this->worker_id]);
        // 创建一个 TwoFactorAuth 实例，设置应用名称、认证码长度以及每个认证码的有效时间
        $auth  = new TwoFactorAuth($app_name);
        if($agent['is_bind']&&$agent['secret_key']){
            $secret_key = $agent['secret_key'];
        }else{
            // 生成一个随机的密钥
            $secret_key = $auth->createSecret();
        }
        // 生成一个供用户扫描的二维码，其中包含用户名和密钥
        $qrCodeUrl = $auth->getQRCodeImageAsDataUri($this->admin_info['nickname'], $secret_key);
        $this->assign([
            'worker_id' => $this->worker_id,
            'qrCodeUrl' => $qrCodeUrl,
            'secret_key'=>$secret_key,
            'agent'=>$agent,
        ]);
        return $this->fetch();
    }

    /**
     * 解绑谷歌验证
     */
    public function unbinding(){
        $rt = Salesman::update(['secret_key'=>'', 'is_bind'=>0],['worker_id'=>$this->worker_id]);
        if($rt){
            return self::success('解绑成功！');
        }
        return self::error('解绑失败！');
    }
}