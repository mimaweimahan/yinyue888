<?php

namespace app\api\model;
use app\common\model\User;
use app\common\traits\ModelTrait;
use think\Model;
use wxpay\WxAPIv3Partner;
use wxpay\WxPayAPIv3;

class ProfitsharingReceivers extends Model
{
    protected $name ='profitsharing_receivers';
    use ModelTrait;

    public function users()
    {
        return $this->hasOne(User::class,'id', 'uid')->bind(['mobile','nickname']);
    }

    /**
     * 查询或创建分账接收方
     * @param int $uid
     * @param string $mchid
     * @param string $openid
     * @param string $name
     * @param string $sub_mchid
     * @param string $type  //MERCHANT_ID：商户ID , PERSONAL_OPENID：个人openid（由父商户APPID转换得到）,PERSONAL_SUB_OPENID：个人sub_openid（由子商户APPID转换得到）
     * @param string $relation_type
     * @param string $custom_relation
     * @return array|Model
     * @throws \Exception
     */
    public static function getOrSet(int $uid, $mchid, $openid, $name='', $sub_mchid='', $type='PERSONAL_OPENID', $relation_type='USER', $custom_relation='')
    {
        $map = ['uid'=>$uid,'mchid'=>$mchid,'account'=>$openid];
        if($sub_mchid){
            $map['sub_mchid'] = $sub_mchid;
        }
        if($sub_mchid){
            $pay = new WxAPIv3Partner(['sub_mchid'=>$sub_mchid]);
        }else{
            $pay = new WxPayAPIv3(['type'=>'wx']);
        }
        // 执行分账
        $_account = ProfitsharingReceivers::getToArray($map);
        if($_account){
            $_data = [
                'type'=>$_account['type'],
                'account'=>$_account['account'],
                "relation_type"=>$_account['relation_type'],
            ];
            if (isset($_account['sub_mchid']) && $_account['sub_mchid']){
                $_data['sub_mchid'] = $_account['sub_mchid'];
            }
            if (isset($_account['custom_relation']) && $_account['custom_relation']){
                $_data['custom_relation'] = $_account['custom_relation'];
            }
            // 添加分账接收方
            $rt = $pay->addReceivers($_data);
            if( $rt['code']==1 ){
                return $_data;
            }else{
                return ['account'=>''];
            }
        }

        $_data = [
            "type" => $type,
            "account" => $openid,
            "mchid" => $mchid,
            "relation_type" => $relation_type,
        ];

        if($sub_mchid){
            $_data['sub_mchid'] = $sub_mchid;
        }

        if($custom_relation){
            $_data['custom_relation'] = $custom_relation;
        }

        $rt = $pay->addReceivers($_data);
        if( $rt['code']==1 ){
            if($name){
                $_data['uid']  = $uid;
                $_data['name'] = $name;
            }
            ProfitsharingReceivers::create($_data);
            unset($_data['name']);
            return $_data;
        }
        return ['account'=>''];
    }
}