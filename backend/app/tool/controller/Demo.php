<?php
declare (strict_types = 1);
namespace app\tool\controller;
use app\agent\model\Orders;
use app\agent\model\WalletLog;
use app\agent\services\ReferralRewardService;
use app\api\model\Relation;
use app\api\model\RelationTeam;
use app\common\model\User;
use app\common\model\user\UserData;
use app\common\model\user\UserRecord;
use app\common\model\user\UserWallet;
use app\common\model\user\UserGrade;
use app\goods\model\Goods;
use think\Container;
use think\facade\Config;
use think\facade\Db;
use think\facade\Lang;
use think\facade\Log;
use think\facade\View;
use app\jobs\TaskJob;
use think\swoole\Websocket;
use app\goods\services\GoodsGiveService;
use think\facade\Queue;
use function Swoole\Coroutine\go;
use app\jobs\OrderJob;
use FormBuilder\Factory\Elm;
use FormBuilder\Form\IviewForm;
use core\utils\ip2region\Ip2Region;
class Demo {

    public function y(){
        // 商品 今日销量 daily_sale， total_sales 总销量 ，incr_rate 增量率
        $suc = [];
        $list = Goods::where('daily_sale',0)->select();
       foreach($list as $item){
           $item->total_sales = rand(2232,18324);
           $item->daily_sale  = rand(532,intval($item->total_sales/2));
           // 增量率 incr_rate的数值 -0.1到300之间 包含小数
           $item->incr_rate = rand(-1000,3000)/1000;
           $item->save();
           $suc[] = $item->id;
       }
       return app('json')->success($suc);
    }
    public function aa(){
        $rt ='[{"\u5f53\u5929\u65e5\u671f":"08-15","\u6570\u91cf":0,"\u5145\u503c":"455.16","\u63d0\u73b0":"0.00"},{"\u5f53\u5929\u65e5\u671f":"08-16","\u6570\u91cf":2,"\u5145\u503c":"0.00","\u63d0\u73b0":"1373.78"},{"\u5f53\u5929\u65e5\u671f":"08-17","\u6570\u91cf":3,"\u5145\u503c":"28.08","\u63d0\u73b0":"1500.00"},{"\u5f53\u5929\u65e5\u671f":"08-18","\u6570\u91cf":1,"\u5145\u503c":"0.00","\u63d0\u73b0":"0.00"},{"\u5f53\u5929\u65e5\u671f":"08-19","\u6570\u91cf":2,"\u5145\u503c":"0.00","\u63d0\u73b0":"15138.42"},{"\u5f53\u5929\u65e5\u671f":"08-20","\u6570\u91cf":4,"\u5145\u503c":"0.00","\u63d0\u73b0":"0.00"},{"\u5f53\u5929\u65e5\u671f":"08-21","\u6570\u91cf":0,"\u5145\u503c":"0.00","\u63d0\u73b0":"0.00"},{"\u5f53\u5929\u65e5\u671f":"08-22","\u6570\u91cf":3,"\u5145\u503c":"0.00","\u63d0\u73b0":"540.00"},{"\u5f53\u5929\u65e5\u671f":"08-23","\u6570\u91cf":0,"\u5145\u503c":"0.00","\u63d0\u73b0":"2750.00"},{"\u5f53\u5929\u65e5\u671f":"08-24","\u6570\u91cf":1,"\u5145\u503c":"0.00","\u63d0\u73b0":"0.00"},{"\u5f53\u5929\u65e5\u671f":"08-25","\u6570\u91cf":0,"\u5145\u503c":"0.00","\u63d0\u73b0":"0.00"},{"\u5f53\u5929\u65e5\u671f":"08-26","\u6570\u91cf":2,"\u5145\u503c":"0.00","\u63d0\u73b0":"523.00"},{"\u5f53\u5929\u65e5\u671f":"08-27","\u6570\u91cf":2,"\u5145\u503c":"0.00","\u63d0\u73b0":"2721.00"},{"\u5f53\u5929\u65e5\u671f":"08-28","\u6570\u91cf":0,"\u5145\u503c":"0.00","\u63d0\u73b0":"2111.00"},{"\u5f53\u5929\u65e5\u671f":"08-29","\u6570\u91cf":0,"\u5145\u503c":"0.00","\u63d0\u73b0":"0.00"},{"\u5f53\u5929\u65e5\u671f":"08-30","\u6570\u91cf":0,"\u5145\u503c":"0.00","\u63d0\u73b0":"0.00"}]';

        $rt = json_decode($rt,true);
        //$bb = json_encode($rt,256);
        dump($rt);
    }

    public function index(){
        $lst = Shop::getList();
        $suc = [];
        foreach ($lst as $r){
            $_amount = Order::where('shop_id',$r['id'])->where('pay_status',1)->where('module','=','cashier')->sum('amount');
            $zk = $r['discount'];
            $shop_rl = $_amount*($zk/100);
            if($shop_rl) {
                Shop::update(['flowing'=>$shop_rl],['id'=>$r['id']]);
                $suc[] = $shop_rl;
            }
        }
        dump($suc);
    }
    public function zxf(){
        $user_ids = Order::where('pay_status',1)->where('module','=','cashier')->group('uid')->column('uid');
        $suc = [];
        foreach ($user_ids as $uid){
            if($uid>0){
                $_amount = Order::where('uid',$uid)->where('pay_status',1)->where('module','=','cashier')->sum('amount');
                if($_amount){
                    User::update(['consumption'=>$_amount],['id'=>$uid]);
                    $suc[] = ['uid'=>$uid,'consumption'=>$_amount];
                }
            }
        }
        return app('json')->success($suc);
    }

    public function cs(){
        $map[] = ['id','>=','436'];
        $map[] = ['id','<','480'];
        $lst = UserRecord::getList($map);
        $suc = [];
        foreach ($lst as $r){
            if($r['amount']>0){
               $suc[] = UserWallet::updateAc($r['uid'],['amount'=>-$r['amount']],'奖励撤回,详情请联系客服人员');
            }
        }
        return app('json')->success($suc);
    }

    public function zf(){
        $wx = Transfers::instance([
            'appid'=> getConfig('wx_app_id'),
            'mch_id'=> getConfig('mch_id'),
            'public_key'=> getConfig('cert_cer'), // apiclient_cert.pem 这个文件里的字符串
            'private_key'=> getConfig('cert_key'), // apiclient_key.pem 这个文件里的字符串
            'mch_key_v3'=> getConfig('mch_key_v3') // v3key
        ]);
        $rt = $wx->transfer([
            'out_bill_no' => '20220101000000003',//商家批次单号
            'openid' => 'oVe9r6hJE1CJRVg9jKpL9WHGWhe8',
            'transfer_amount' => 0.1,//转账总金额
            'transfer_remark' => '转账测试',//转账说明
        ]);
        dump($rt);
    }

    public function test(){
        $wx = Transfers::instance([
            'appid'=> getConfig('wx_app_id'),
            'mch_id'=> getConfig('mch_id'),
            'public_key'=> getConfig('cert_cer'), // apiclient_cert.pem 这个文件里的字符串
            'private_key'=> getConfig('cert_key'), // apiclient_key.pem 这个文件里的字符串
            'mch_key_v3'=> getConfig('mch_key_v3') // v3key
        ]);
        $rt = $wx->query([
            'out_bill_no' => '20220101000000003',//商家批次单号
        ]);
        dump($rt);

    }
  /**
     * 规则转换，处理百分比的情况
     * @param string $reward
     * @param int|float $amount
     * @return float
     */
    public static function to_rules(string $reward='', int|float $amount=0): float
    {
        //判断是否为百分比
        if(str_contains($reward, '%')){
            $_reward   = floatval( str_replace('%','',$reward) );
            $reward_bi = $_reward/100;
            dump($reward_bi);
            $amount = int2($amount * $reward_bi);
        }else{
            $amount = floatval($reward);
        }
        return floatval($amount);
    }
    public function query(Request $request){
        $params  = $request->param();
        $file_id = $request->param('file_id');
        $map = [];
        if($file_id){
            $map = [ 'parent_folder'=>$file_id ];
        }else{
            $map = [ 'parent_folder'=>'' ];
        }
        $data = Resources::getListPageObj($map,100,[],$params);
        $lists = [];
        if($data){
            $lists = $data->toArray();
        }
        $pages = $data->render();  //分页
        View::assign('lists',$lists['data']);
        View::assign('pages',$pages);
        return View::fetch();
    }
}
