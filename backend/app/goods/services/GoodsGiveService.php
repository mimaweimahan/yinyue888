<?php
/**
 * 商品赠送服务
 */
namespace app\goods\services;
use JetBrains\PhpStorm\ArrayShape;
use app\common\model\user\UserAddress;
use app\goods\model\Attribute;
use app\goods\model\GoodsGive;
use app\order\model\Order;
use app\order\model\OrderGoods;
use core\utils\Tools;
class GoodsGiveService
{
    /**
     * 处理赠送商品（写入）
     * @param array $data
     * @return array
     */
    public static function give_join(array $data): array
    {
        if( isset($data['give_num']) && $data['give_num']>0 ){
            $give_num = $data['give_num'];
        }else{
            return [];
        }
        $_data = $arr = array();
        $buy_num = $data['buy_num'];

        for ($i=1; $i <= $give_num; $i++){
            $year  = date('Y', strtotime('+'.$i.' month'));
            $month = date('m', strtotime('+'.$i.' month'));
            $arr[] = [
                'uid' => $data['uid'],
                'order_id' => $data['order_id'],
                'order_no' => $data['order_no'],
                'goods_id' => $data['goods_id'],
                'attribute_id' => $data['attribute_id'],
                'shop_id' => $data['shop_id'],
                'year' => intval($year),
                'month' => intval($month),
                'give_num' => $buy_num,
                'add_time' => time()
            ];
        }
        $_data[] = (new GoodsGive)->insertAll($arr);
        return $_data;
    }

    /**
     * 创建赠送订单
     * @param  array $give 赠送数据（goods_give数据）
     * @return array
     */
    #[ArrayShape(['code' => "int", 'msg' => "string"])]
    public static function give_order(array $give): array
    {
        if(!isset($give['order_id']) || !isset($give['give_num']) ){
            return ['code'=>0,'msg'=>'创建订单失败'];
        }
        $order_number = Tools::orderNumber('GIVE');
        //获取用户的默认收货地址
        $adr = UserAddress::getToArray(['uid'=>$give['uid']],'username,phone,address,street,is_default',[],'is_default desc');
        if(!$adr){
            return ['code'=>0, 'msg'=>'请完善收货地址'];
        }
        $goods = Attribute::getToArray(['id'=>$give['attribute']],'',['goods']);
        if(!$goods){
            return ['code'=>0, 'msg'=>'商品不存在'];
        }
        $model = new Order();
        $model->startTrans();
        //初始化订单
        $order_id = $model->insertGetId([
            'uid'=> $give['uid'],
            'body'=>'赠送商品',
            'order_number'=> $order_number,
            'module'=> 'gift',
            'express_username'=> $adr['username'],
            'express_phone'=> $adr['phone'],
            'express_address' => $adr['address'].$adr['street'],
            'balance'=> 0, //余额抵扣
            'payment_method'=> 'BALANCE',
            'pay_status'=> 1,
            'total_price'=> $goods['unit_price']*$give['give_num'],
            'settlement'=> 1,
            'pay_amount'=> 0,
            'data'=> serialize( ['give_id'=>$give['id'], 'give_num'=>$give['give_num'] ] ),
            'pay_time'=> time(),
            'update_time'=> time(),
            'add_time'=> time()
        ]);
        try {
            //订单附表
            OrderGoods::create([
                'order_id'=>$order_id,
                'order_sn'=>$order_number,
                'shop_id'=>$give['shop_id'],
                'goods_type'=>$goods['type_id'],
                'goods_name'=>$goods['title'],
                'attribute_name'=>$goods['attribute_name'],
                'goods_id'=>$goods['goods_id'],
                'attribute_id'=>$goods['id'],
                'thumb'=>$goods['thumb'],
                'num'=>$give['give_num'],
                'unit_price'=>$goods['unit_price'],
                'goods_price'=>$goods['unit_price'],
                'count_price'=>$goods['unit_price']*$give['give_num'],
                'goods_amount'=>$goods['unit_price'],
                'goods_unit'=>$goods['unit']
            ]);
            //更改赠送状态
            $model->commit();
            return ['code'=>1,'msg'=>'创建订单成功'];
        }catch (\Exception $e){
            $model->rollback();
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }
}