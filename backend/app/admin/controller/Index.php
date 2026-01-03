<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 后台首页 
 */
namespace app\admin\controller;
use app\agent\model\Recharge;
use app\agent\model\Withdrawal;
use app\common\model\User;
use app\common\model\user\UserWallet;
use app\common\service\Rule;
use think\facade\Db;
use think\facade\Request;
class Index extends \app\AdminInit
{
    public function index()
    {
        $this->assign('left_menu_json',Rule::jsonMenu(0));
        return $this->fetch();
    }
		
    public function main()
    {
        $online_user_num = User::where('is_online',1)->count();
        $new_user_num    = User::whereDay('reg_time')->count();
        $task_user_num   = User::where('is_task','=',1)->count();
        $sc_user_num     = User::whereDay('sc_time')->count();
        $sc_amount       = Recharge::whereDay('created_at')->where('status',1)->where('is_sc',1)->sum('balance');
        $recharge_amount = Recharge::where('status',1)->where('is_sys',0)->sum('balance');
        $recharge_num    = Recharge::where('status',1)->where('is_sys',0)->group('uid')->count();
        $withdrawal_amount = Withdrawal::where('status',1)->sum('balance');
        $withdrawal_num    = Withdrawal::where('status',1)->group('uid')->count();

        //今日提现金额
        $day_withdrawal_amount = Withdrawal::where('status',1)->whereDay('created_at')->sum('balance');

        //今日充值金额
        $day_recharge_amount = Recharge::where('status',1)->whereDay('created_at')->sum('balance');
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

    public function public_icon()
    {
        return $this->fetch();
    }

    public function public_statistics(){
        $start_time = Request::param('start_time',date('Y-m-d 00:00:00'),'trim');
        $end_time   = Request::param('end_time',date('Y-m-d 23:59:59'),'trim');
        $day = self::diffBetweenTwoDays($start_time,$end_time);
        $data_key = [];
        if($day == 0 || $day ==1){
            for($i=0;$i<=23;$i++){
                if ($i>9){
                    $hour = $i;
                }else{
                    $hour = '0'.$i;
                }
                $data_key[] = date('Y-m-d ',strtotime($start_time)).$hour;
            }
        }else{
            $data_key = periodDate($start_time,$end_time);
        }
        $result = [];
        //新增用户
        $result['total']['user_num']   = Db::name('user')->whereTime('reg_time', 'between', [$start_time,$end_time])->count();
        //充值订单
        $result['total']['order_num'] = Db::name('recharge')->where(['pay_status'=>1])->field('bi,amount,add_time')->whereTime('add_time', 'between', [$start_time,$end_time])->count();
        //充值金额
        $result['total']['order_amount'] = Db::name('recharge')->where(['pay_status'=>1])->whereTime('add_time', 'between', [$start_time,$end_time])->sum('amount');
        //充值考拉币
        $result['total']['order_bi']  = Db::name('recharge')->where(['pay_status'=>1])->whereTime('add_time', 'between', [$start_time,$end_time])->sum('bi');
        //发起赛事
        $result['total']['match_num'] = Db::name('match')->whereTime('add_time', 'between', [$start_time,$end_time])->count();
        //平台服务费
        $result['total']['service_bi'] = Db::name('match')->where('service_fee','>',0)->whereTime('add_time', 'between', [$start_time,$end_time])->count();


        $data = [];
        foreach ($data_key as $time){
            if($day == 0 || $day ==1){
                $start = $time.":00:00";
                $end   = $time.":59:59";
                $data[] = [
                    'time'=> $time,
                    'user' => Db::name('user')->whereTime('reg_time', 'between', [$start,$end])->count(),
                    'order_num' => Db::name('recharge')->where(['pay_status'=>1])->whereTime('add_time', 'between', [$start,$end])->count(),
                    'order_amount' => Db::name('recharge')->where(['pay_status'=>1])->whereTime('add_time', 'between', [$start,$end])->sum('amount'),
                    'order_bi' =>  Db::name('recharge')->where(['pay_status'=>1])->whereTime('add_time', 'between', [$start,$end])->sum('bi'),
                    'match_num' =>  Db::name('match')->whereTime('add_time', 'between', [$start,$end])->count(),
                    'service_bi' =>  Db::name('match')->whereTime('add_time', 'between', [$start,$end])->sum('service_fee'),
                ];
            }elseif ($day>1){
                $data[] = [
                    'time'=> $time,
                    'user' => Db::name('user')->whereDay('reg_time',$time)->count(),
                    'order_num' => Db::name('recharge')->where(['pay_status'=>1])->whereDay('add_time',$time)->count(),
                    'order_amount' => Db::name('recharge')->where(['pay_status'=>1])->whereDay('add_time',$time)->sum('amount'),
                    'order_bi' =>  Db::name('recharge')->where(['pay_status'=>1])->whereDay('add_time',$time)->sum('bi'),
                    'match_num' =>  Db::name('match')->whereDay('add_time',$time)->count(),
                    'service_bi' =>  Db::name('match')->whereDay('add_time',$time)->sum('service_fee'),
                ];
            }else{
                $data[] = [
                    'time'=> $time,
                    'user' => 0,
                    'order_num' => 0,
                    'order_amount' =>0,
                    'order_bi' => 0,
                    'match_num' =>  0,
                    'service_bi' => 0,
                ];
            }
        }
        $result['lists'] = $data;
        $echarts = [];
        foreach ($data as $r){
            $echarts['user'][] = $r['user'];
            $echarts['order_num'][] = $r['order_num'];
            $echarts['order_amount'][] = $r['order_amount'];
            $echarts['order_bi'][] = $r['order_bi'];
            $echarts['service_bi'][] = $r['service_bi'];
            $echarts['match_num'][] = $r['match_num'];
            $echarts['keys'][] = $r['time'];
        }
        $result['echarts'] = $echarts;
        return app('json')->success($result);
    }

    /**
     * 求两个日期之间相差的天数
     * (针对1970年1月1日之后，求之前可以采用泰勒公式)
     * @param string $day1
     * @param string $day2
     * @return int number
     */
    private static function diffBetweenTwoDays($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);
        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return intval(($second1 - $second2) / 86400);
    }

    /**
     * 清除全部缓存
     */
    public function cache(){
        $_path = app()->getRootPath().'runtime/';
        $rt  = delDir($_path);
        if($this->request->isAjax()){
           if($rt){
               return app('json')->success('操作成功');
           }
           return app('json')->error('操作失败');
        }
        return self::success('操作成功');
    }

    /**
     * 信息统计
     * @return mixed
     */
    public function count(){
        return app('json')->success('');
    }
}