<?php

namespace app\api\model;
use app\common\traits\ModelTrait;
use app\order\model\Order;
use think\Model;
class DistributorTask extends Model
{
    protected $name ='distributor_task';
    use ModelTrait;
    /**
     * 时间处理 order_pay_time
     */
    public function getOrderPayTimeAttr($val){
        if($val){
            return date('Y-m-d H:i:s',$val);
        }
        return '';
    }
    // 绑定订单数据
    public function orders()
    {
        return $this->hasOne(Order::class,'order_number', 'order_number')->bind(['total_price','pay_amount','address_user','address_phone','address']);
    }
}