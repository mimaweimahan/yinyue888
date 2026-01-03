<?php

namespace app\agent\controller\sys;

use app\common\model\user\UserAddress;
use app\common\traits\ControllerTrait;
use app\agent\model\Salesman;
use app\agent\model\AgentAddress;
use app\agent\model\AgentAddressType;
use app\agent\model\Recharge;
use app\agent\model\Withdrawal;

class Address extends \app\AgentInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new UserAddress();
    }
    use ControllerTrait;

    /**
     * 充值地址列表
     */
    public function recharge1() {
        $where = [];
        $params    = $this->request->param();
        $address   = $this->request->param('address','','trim');
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status',0,'intval');

        // 账号类型
        // 0TRC，1ERC ，2BSC
        $address_type = $this->request->param('address_type',0,'intval');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            $where[] = ["type","=",0];
            $where[] = ["agent_id","=",$this->agent_id];
            if($worker_id){
                $where[] = ["worker_id","=",$worker_id];
            }
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($status){
                $where[] = ["status","=",$status-1];
            }
            if($address){
                $where[] = ["address","=",$address];
            }
            $data = UserAddress::getListPage($where,$limit,'created_at DESC',$params);
            $attach = [
                'all_total'=>36,
                'all_balance'=>4255.346543,
                'map'=>$where
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("address", $address);
        $this->assign("url", url('recharge'));
        $this->assign("limit", $limit);
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch('index');
    }
    /**
     * 提现地址列表
     */
    public function withdrawal1() {
        $where = [];
        $params    = $this->request->param();
        $address   = $this->request->param('address','','trim');
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status',0,'intval');

        // 账号类型
        // 0TRC，1ERC ，2BSC
        $address_type = $this->request->param('address_type',0,'intval');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            $where[] = ["type","=",1];
            $where[] = ["agent_id","=",$this->agent_id];
            if($worker_id){
                $where[] = ["worker_id","=",$worker_id];
            }
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($status){
                $where[] = ["status","=",$status-1];
            }
            if($address){
                $where[] = ["address","=",$address];
            }
            $data = UserAddress::getListPage($where,$limit,'created_at DESC',$params);
            $attach = [
                'all_total'=>36,
                'all_balance'=>4255.346543,
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("address", $address);
        $this->assign("url", url('withdrawal'));
        $this->assign("limit", $limit);
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch();
    }

    public function qrcode(){
        $id = input('param.id', 0, 'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        $data = UserAddress::getToArray(['id'=>$id]);
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 充值地址列表
     */
    public function recharge() {
        $where = [];
        $params    = $this->request->param();
        $address   = $this->request->param('address','','trim');
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status',0,'intval');

        // 账号类型
        // 0TRC，1ERC ，2BSC
        $address_type = $this->request->param('address_type',0,'intval');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            $where[] = ["agent_id","=",$this->agent_id];
            if($worker_id){
                $where[] = ["worker_id","=",$worker_id];
            }
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($address){
                $where[] = ["address","=",$address];
            }
            $data = Recharge::where($where)->order('created_at DESC')->group('uid')->paginate(
                [
                    'list_rows'=>$limit,
                    'query'=>$params
                ]
            )->toArray();
            foreach($data['data'] as $key=>$r){
                $type_id = AgentAddress::where('address',$r['address'])->value('type_id');
                $address_type = AgentAddressType::where('id',$type_id)->value('name');
                $data['data'][$key]['address_type_name'] = $address_type;
            }
            $attach = [
                'all_total'=>Recharge::where($where)->order('created_at DESC')->group('uid')->count(),
                'all_balance'=>0,
                'map'=>$where
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("address", $address);
        $this->assign("url", url('recharge'));
        $this->assign("limit", $limit);
        $this->assign("salesman_list", Salesman::getList(['agent_id'=>$this->agent_id]));
        return $this->fetch();
    }

    /**
     * 提现地址列表
     */
    public function withdrawal() {
        $where = [];
        $params    = $this->request->param();
        $address   = $this->request->param('address','','trim');
        $agent_id  = $this->request->param('agent_id',0,'intval');
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status',0,'intval');

        // 账号类型
        // 0TRC，1ERC ，2BSC
        $address_type = $this->request->param('address_type',0,'intval');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            $where[] = ["agent_id","=",$this->agent_id];
            if($worker_id){
                $where[] = ["worker_id","=",$worker_id];
            }
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($status){
                $where[] = ["status","=",$status-1];
            }
            if($address){
                $where[] = ["address","=",$address];
            }
            //$data = Withdrawal::getListPage($where,$limit,'created_at DESC',$params);
            $data = Withdrawal::where($where)->order('created_at DESC')->group('uid')->paginate(
                [
                    'list_rows'=>$limit,
                    'query'=>$params
                ]
            )->toArray();

            $attach = [
                'all_total'=>Withdrawal::where($where)->order('created_at DESC')->group('uid')->count(),
                'all_balance'=>0,
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("address", $address);
        $this->assign("url", url('withdrawal'));
        $this->assign("limit", $limit);
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch();
    }
}