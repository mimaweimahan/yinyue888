<?php

namespace app\api\controller\v1;
use app\agent\model\Orders;
use app\agent\model\Ptask;
use app\common\model\user\UserWallet;
use app\Request;
use app\common\model\User;
use app\goods\model\Goods;
use core\utils\Tools;
use PgSql\Lob;
use think\facade\Lang;

class Trading
{
    private int $uid = 0;
    public function __construct()
    {
        $this->uid  = (new Request)->uid();
        if(!$this->uid){
            return app('json')->fail( lang('缺少参数') );
        }
    }

    /**
     * 订单列表
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request){
        $type    = $request->param('type',0,'intval');//类型
        $limit   = $request->param('limit',10);
        $params  = $request->param();
        $where   = [];
        $where[] = ['uid','=',$this->uid];
        $where[] = ['status','=',$type];
        $list    = Orders::getListPage($where,$limit,'id desc',$params,['goodsPic']);
        return app('json')->success( $list );
    }

    public function info(Request $request){
        $uid     = $request->uid();
        $user    = User::getToArray(['id'=>$uid],'task_num,task_done,task_rate,task_batch,credit_score,credit_usdt');
        $revenue = Orders::where(['uid'=>$uid,'status'=>1,'task_batch'=>$user['task_batch']])->sum('profit');
        
        $total_revenue = Orders::where(['uid'=>$uid,'status'=>1])->sum('profit');
        $task_revenue  = sprintf("%.4f", $revenue);
        $total_revenue = sprintf("%.4f", $total_revenue);//总收益
        $been_released = sprintf("%.4f", $total_revenue);//已释放累计金额

        $be_released  = Orders::where(['uid'=>$uid,'status'=>0])->sum('profit');
        $be_released  = sprintf("%.4f", $be_released);//待释放累计金额
        $credit_tips  = lang('信誉分提示');
        $credit_score = $user['credit_score'];
        $credit_usdt  = floatval($user['credit_usdt']);
        if($credit_score<100){
            $_str =  Lang::get('信誉分不足提示');
            $credit_tips = str_replace('{je}',$credit_usdt, $_str);
        }
        $data = [
           'task_num'=>$user['task_num'],
           'task_done'=>$user['task_done'],
           'task_rate'=>$user['task_rate'],
           'credit_score'=>$user['credit_score'],
           'credit_usdt'=>$user['credit_usdt'],
           'credit_tips'=> $credit_tips,
           'task_revenue'=>$task_revenue,//本轮收益
           'total_revenue'=>$total_revenue,//总收益
           'been_released'=>$been_released,//已释放累计金额
           'be_released'=>$be_released,//待释放累计金额
           'lang'=> Lang::getLangSet(),
        ];
        return app('json')->success($data);
    }

    public function dynamics(Request $request){
        $_data = [
            ['uid'=>126962,'data'=>'depositing 3,457.70 USDT'],
            ['uid'=>127582,'data'=>'depositing 302.00'],
            ['uid'=>127582,'data'=>'depositing 234.00 USDT'],
            ['uid'=>125232,'data'=>'depositing 512.00 USDT'],
            ['uid'=>125451,'data'=>'depositing 5,2515.00 USDT'],
        ];
        $list = \app\agent\model\Recharge::getList(['status'=>1],0,'id desc');
        $data = [];
        foreach ($list as $v){
            $data[] = [
                'uid'=>$v['uid'],
                'data'=>"depositing ".$v['balance']." USDT",
            ];
        }
        if($data){
            $data = array_merge($data,$_data);
        }else{
            $data = $_data;
        }
        return app('json')->success($data);
    }

    // 提交订单
    public function createOrder( Request $request ){
        $uid = $request->uid();
        if(!$uid){
            return app('json')->fail( lang('缺少参数') );
        }
        // 判断用户是否有抢单权限
        $user = User::info($uid);
        if($user['is_task']==0 || $user['task_num']<=0){
            return app('json')->fail( lang('请联系客服获取任务') );
        }

        if($user['task_done']>=$user['task_num']){
            return app('json')->fail( lang('本轮任务已经完成') );
        }

        // 判断用户信誉分是否足够
        if($user['credit_score']<100){
            return app('json')->fail( lang('信誉分不足100,请联系客服') );
        }

        // 用户当前余额
        $balance = floatval($user['balance']);
        if($balance < 1 ){
            return app('json')->fail( lang('可用余额不足,请充值') );
        }

        // 判断当前用户是否有为完成的订单
        $be = Orders::where('uid',$uid)->where('status',0)->lock(true)->count();
        if($be>0){
            return app('json')->fail( lang('您有未完成的订单') );
        }
        // 获取当前的任务编号
        $task_no = intval($user['task_done'])+1;

        // 判断有没有派单
        $pai = Ptask::getToArray(['uid'=>$uid,'status'=>0,'task_no'=>$task_no]);
        $need_price = 0;
        if ($pai){
            $need_price = rand(floatval($pai['end_balance']), floatval($pai['start_balance']));
        }

        $is_pai   = 0; //是否为派单
        $trade_no = Tools::orderNumber('TK');
        $goods  = [];
        $pp_num = 1;

        // 判断有没有打针价如果存在就浮动抢单价，这里的抢单价大于用户的可用余额
        if($need_price>0){
            $is_pai = 1;
            $input_price = intval($balance) + $need_price;
            $_rt = Goods::findOptimalProduct($input_price,$uid); //匹配抢单商品
            if($_rt['goods']){
                $_rt['goods']['price'] = $input_price/$_rt['num'];
                $goods  = $_rt['goods'];
                $pp_num = $_rt['num'];
            }
        }else{
            $map = [];
            // $goods_ids = Orders::where('uid',$uid)->group('goods_id')->column('goods_id');
            // if($goods_ids){
            //     $map[] = ['id','not in' ,$goods_ids];
            // }
            // 随机匹配一条商品数据，价格范围为用户余额的70%-100%
            // 计算用户余额的70%
            $min_price = $balance * 0.7;
            // 随机匹配一条价格在用户余额70%-100%范围内的商品数据
            $goods = Goods::where($map)
            ->where('price', '>=', $min_price)
            ->where('price', '<=', $balance)
            ->orderRand()
            ->find();

            if($goods){
                $goods = $goods->toArray();
            }else{
                // 如果没有匹配到商品数据, 就随机匹配一条商品数据（按价格从低到高排序），同时 $pp_num 等于 $min_price/$goods['price'] 正数取整
                $max_price = $balance * 0.5; //最大金额不超过余额的50%
                $goods = Goods::where($map)
                    ->where('price', '<=', $max_price)
                    ->order('price','desc')
                    ->find();
                    
                if($goods){
                    $goods = $goods->toArray(); 
                    $goods_price = floatval($goods['price']);
                    $pp_num = intval($min_price/$goods_price);
                }
            }
        }
        if(empty($goods['price'])){
            return app('json')->fail( lang('订单匹配失败，请联系客服') , ['goods'=>$goods]);
        }
        $need = 0;
        $goods_price = floatval($goods['price']);
        $total_price = $goods_price * $pp_num;
        $profit      = Orders::getUserProfit($uid,$total_price);

        //如果是派单需要重新计算利润
        if($is_pai==1){
            $profit = $profit * $pai['task_rate'];
        }
        $created_at  = time();
        if($total_price>$balance){
            $need = $balance - $total_price;
        }
        $need = floatval(sprintf("%.4f", $need));
        $_order = [
            'uid'=>$uid,
            'agent_id'=>$user['agent_id'],
            'worker_id'=>$user['worker_id'],
            'user_type'=>$user['user_type'],
            'is_pai'=>$is_pai,
            'trade_no'=>$trade_no,
            'goods_id'=>$goods['id'],
            'goods_name'=>$goods['title'],
            'num'=>$pp_num,
            'task_batch'=>$user['task_batch'],
            'price'=>$goods_price,
            'need'=>$need,
            'total_price'=>$total_price,
            'profit'=> $profit,
            'Ip'=>realIp(),
            'created_at'=>$created_at,
        ];
        Orders::startTrans();
        try {
            $db = Orders::create($_order);
            if(isset($db->id) && $db->id){
                // 扣除可用余额
                $f_data = [
                    'agent_id'  => $user['agent_id'],
                    'worker_id' => $user['worker_id'],
                    'user_type' => $user['user_type'],
                    'actype'    => 0,
                ];
                $rt = UserWallet::updateAc($uid,['balance'=>-$total_price,'freeze_balance'=>$total_price],50,'抢单冻结',$f_data);
                if($rt['code']==0){
                    return app('json')->fail( lang('订单匹配失败，请联系客服') );
                }
                //更新派单状态
                if($pai){
                    Ptask::update(['status'=>1],['id'=>$pai['id']]);
                }
                Orders::commit(); 
                $order = [
                    "order_id" => $db->id,
                    "trade_no" => $trade_no,
                    "goods_name" => $goods['title'],
                    "goods_pic" => thumb($goods['image'],300,300),
                    "goods_price" => formatCurrency($goods_price),
                    "goods_num" => $pp_num,
                    "total_price" => sprintf("%.4f", $total_price),
                    "profit" =>  sprintf("%.4f", $profit),
                    "created_at" => date("m/d/Y H:i"),//"09/07/2025 21:03"
                    "is_ready" => 0,
                    "need" => $need
                ];
                return app('json')->success($order);
            }
            Orders::rollback();
            return app('json')->fail( lang('订单匹配失败，请联系客服') );
        }catch (\Exception $e){
            Orders::rollback();
            return app('json')->fail( lang('订单匹配失败，请联系客服') );
        }
    }

    
    public function confirm(Request $request)
    {
        $order_id = $request->param('order_id');
        if(!$order_id){
            return app('json')->fail( lang('缺少参数') );
        }
        $uid   = $request->uid();
        $order = Orders::getToArray(['id'=>$order_id,'uid'=>$uid,'is_ready'=>0,'status'=>0]);
        if(!$order){
            return app('json')->fail( lang('订单不存在') );
        }
        $balance = UserWallet::where('uid',$uid)->value('balance');
        $balance = floatval($balance);
        $freeze_balance = UserWallet::where('uid',$uid)->value('freeze_balance');
        $z_balance = $balance + $freeze_balance;
        
         // 把差额的负数转为正数
        $need = floatval($order['need']);
        
        if($balance < 0 || $need > $balance || $z_balance < $order['total_price']){
            return app('json')->fail( lang('可用余额不足,请充值') ,[
                    'need'=>$need,
                    'balance'=>$balance,
                    'z_balance'=>$z_balance
                ]);
        }
        $res = Orders::confirm($order,$uid);
        return app('json')->success( $res ? lang('操作成功') : lang('操作失败') );
    }
}