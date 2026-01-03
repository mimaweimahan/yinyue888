<?php
namespace app\tool\controller;
use app\order\model\Order;
use app\Request;
use app\shop\model\Shop;
use app\common\model\User;
use app\common\model\user\UserConnect;
use core\services\WxService;
use core\utils\Tools;
use think\facade\View;
use app\api\model\Relation;
use think\Response;
use wxpay\WxAPIv3Partner;
use wxpay\WxPayAPIv3;

class Cashier
{
    public function index(Request $request){
        $shop_id  = $request->param('shop_id',0,'intval');
        $code     = $request->param('code','','trim');
        $store_id = $request->param('store_id',0,'intval');
        $openid   = $request->param('openid','','trim');
        $salesman_id = $request->param('salesman_id',0,'intval');
        $params = $request->param();
        if( $shop_id == 0 ){
            return app('json')->fail('缺少参数');
        }
        $shop = Shop::getToArray(['id'=>$shop_id]);
        if(!$shop){
            return app('json')->fail('商家不存在');
        }
        if($code=='' && $openid==''){
            $param = ['shop_id'=>$shop_id, 'salesman_id'=>$salesman_id, 'store_id'=>$store_id];
            return self::auth_redirect($param);
        }
        $member_id = 0;
        if( $code && $openid=='' ){

            $wx = WxService::getOauthUserInfo($code);
            if( !isset($wx['openid'])  ){
                return app('json')->fail('支付配置错误');
            }
            unset($params['code']);
            $params['openid'] = $wx['openid'];
            return Response::create(url('index',$params), 'redirect', 302);
        }
        $uid = 0;
        if($openid){
            $uid = UserConnect::where(['openid'=>$openid])->value('uid');
        }
        // 判断是否已经绑定会员
        if($uid>0 && is_numeric($uid) && $openid){
            $user = User::autoLogin($uid);// 登录用户
            if(is_array($user) && isset($user['id'])){
                $member_id = $uid;
            }
        }
        View::assign('shop',$shop);
        View::assign('member_id',$member_id);
        View::assign('shop_id',$shop_id);
        View::assign('store_id',$store_id);
        View::assign('openid',$openid);
        View::assign('salesman_id',$salesman_id);
        return View::fetch();
    }

    /**
     * 跳转授权
     */
    public static function bak_auth_redirect($param=[]){
        $redirect_url = getConfig('config_app_url').url('index',$param);
        $redirect_url = urlencode($redirect_url);
        $get_code_url = 'https://www.sfl6s.com/tool/wx/code?url='.$redirect_url;
        return Response::create($get_code_url, 'redirect', 302);
    }

    /**
     * 跳转授权
     */
    public static function auth_redirect($param=[]){
        $app_id       = getConfig('wx_app_id');
        $redirect_url = getConfig('config_app_url').url('index',$param);
        $redirect_url = urlencode($redirect_url);
        $state        = mt_rand(1,1000);
        $oauth_url    = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$app_id}&redirect_uri={$redirect_url}&response_type=code&scope=snsapi_userinfo&state={$state}&connect_redirect=1#wechat_redirect";
        return Response::create($oauth_url, 'redirect', 302);
    }

    /**
     * 支付
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function payment(Request $request){
        $shop_id  = $request->param('shop_id',0,'intval');
        $store_id = $request->param('store_id',0,'intval');
        $phone    = $request->param('phone','','trim');
        $uid      = $request->param('uid',0,'intval');
        $amount   = $request->param('amount',0,'floatval');
        $openid   = $request->param('openid','','trim');
        $note     = $request->param('note','收款码收款','trim');
        $salesman_id = $request->param('salesman_id',0,'floatval');
        if($shop_id==0 ){
            return app('json')->fail('缺少店铺参数');
        }
        if($amount==0 ){
            return app('json')->fail('缺少支付金额');
        }

        $shop = Shop::getToArray(['id'=>$shop_id]);
        if(!$shop){
            return app('json')->fail('商家不存在');
        }
        $sub_mchid = '';
        if($shop['platform_charge'] == 0 && ($shop['mchid']!='0' && $shop['mchid']!='888') ){
            $sub_mchid = $shop['mchid'];
        }

        if($uid==0 && validMobile($phone) ){
            $uid = User::where(['mobile'=>$phone])->value('id');
            if(!$uid){
                $uid = User::register($phone,'321321',$phone,'',$phone);
            }
            $admin_id = $shop['admin_id'];
            if($uid){
                # 绑定关系
                Relation::binding($uid, $admin_id);
                # 绑定门店
                User::update(['shop_id'=>$shop_id],['id'=>$uid,'shop_id'=>$shop_id]);
            }
        }
        if(!$uid){
            return app('json')->fail('绑定会员失败');
        }
        UserConnect::update(['uid'=>$uid],['openid'=>$openid]);
        $mch_id = getConfig('mch_id');
        $order_number = Tools::orderNumber('C');
        // 平台服务费
        $service_fee  = 0;
        $service_fee_bi = floatval( getConfig('service_fee'));
        if($service_fee_bi){
            $service_fee = floatval($amount * $service_fee_bi);
        }
        if($service_fee>0.01){
            $order['service_fee'] = $service_fee;
        }
        $connect_id = UserConnect::where(['openid'=>$openid])->value('id');
        if(!$connect_id){
            $connect_id = 0;
        }
        $express_phone    = User::where('id',$uid)->value('mobile');
        $express_username = User::where('id',$uid)->value('nickname');
        $referee_id = Relation::where('uid',$uid)->value('referee_id');
        if(!$referee_id){
            $referee_id = 0;
        }
        $shop_zk = Shop::where('id',$shop_id)->value('discount');
        $shop_rl = $amount*($shop_zk/100);
        $order = [
            'appid'=>getConfig('wx_app_id'),
            'shop_id'=>$shop_id,
            //'store_id'=>$store_id,
            'module'=>'cashier',
            'mchid'=>$mch_id,
            'referee_id'=>$referee_id,
            'uid'=>$uid,
            'openid'=>$openid,
            'salesman_id'=>$salesman_id,
            'order_number'=> $order_number,
            'payment_method'=>'WECHAT_PAY',
            'total_price'=>$amount,
            'connect_id'=>$connect_id,
            'amount'=>$amount,
            'pay_amount'=>$amount,
            'shop_rl'=>$shop_rl,
            'service_fee'=>$service_fee,
            'profit_sharing'=>1,
            'note'=>$note,
            'express_phone'=>$express_phone,
            'express_username'=>$express_username,
            'add_time'=>time(),
        ];
        if($sub_mchid){
            $order['sub_mchid'] = $sub_mchid;
        }
        Order::create($order);
        $opt = [
            'out_trade_no'=> $order['order_number'],
            'description'=> '扫码收款',
            'attach'=> 'cashier',
            'goods_tag'=> '线下收银',
            'amount'=> $amount,
            'openid'=> $openid,
            'notify_url'=> getConfig('config_app_url').'/api/notify/wx/'.$sub_mchid,
            'profit_sharing'=> true,//分账
            'time_expire'=> date("c", strtotime('+15 minute')),
        ];
        if($sub_mchid){
            $WxPayAPIv3 = new WxAPIv3Partner(['type'=>'WECHAT_PAY','sub_mchid'=>$sub_mchid]);
        }else{
            $WxPayAPIv3 = new WxPayAPIv3(['type'=>'WECHAT_PAY']);
        }
        $pay = $WxPayAPIv3->jsApiPay($opt);
        if(isset($pay['code']) && $pay['code'] == 1){
            $pay['data']['order_number'] = $order['order_number'];
            return app('json')->success('请稍等',$pay['data']);
        }
        return app('json')->fail($pay['msg']);
    }

    /**
     * 判断是否为手机号
     * @param $mobile
     * @return bool
     */
    public function validMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('/^1[3|4|5|6|7|8|9]\d{9}$/', $mobile) ? true : false;
    }

    /**
     * 返回结果
     */
    public function result(Request $request){
        $order_number = $request->param('order_number','','trim');
        if(!$order_number){
            return app('json')->fail('缺少订单号');
        }
        $order = Order::getToArray(['order_number'=>$order_number]);
        if(!$order){
            return app('json')->fail('订单不存在');
        }
        //+++++++++++++++++++++++++++++++++++++++++++
        $WxPayAPIv3 = new WxAPIv3Partner(['type'=>$order['payment_method'], 'sub_mchid'=>$order['mchid']]);
        $data = $WxPayAPIv3->getOrder(['out_trade_no'=>$order_number]);
        if($data['code'] == 1){
            $wx_order = $data['data'];
            if(isset($wx_order['trade_state']) && $wx_order['trade_state'] == 'SUCCESS'){
                Order::notify($order['id'], $order, true);
            }
        }
        //+++++++++++++++++++++++++++++++++++++++++++
        View::assign('order',$order);
        return View::fetch();
    }
}