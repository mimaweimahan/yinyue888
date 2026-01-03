<?php
/**
 * Explain: 钱包
 */
namespace app\agent\controller\admin;
use app\agent\model\Ptask;
use app\agent\model\WalletLog;
use app\common\model\User;
use app\common\model\user\UserWallet;
use app\common\traits\ControllerTrait;
use app\agent\model\Recharge;
use core\utils\Tools;
class Wallet extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new WalletLog();
    }
    use ControllerTrait;

    // 上分
    public function index() {
        $uid   = $this->request->param('id',0,'intval');
        $limit = $this->request->param('limit',10,'intval');
        $acType = $this->request->param('acType',0,'intval');
        if($uid == 0){
            return self::error('请选择用户！');
        }
        $user = User::getToArray(['id'=>$uid]);
         $_field = 'balance';
         $_current_field = 'current_balance';
        if($acType===1){
            $_field = 'frozen_balance';
            $_current_field = 'current_frozen_balance';
        }
        if($acType===2){
            $_field = 'freeze_balance';
            $_current_field = 'current_freeze_balance';
        }
        $this->assign("url", url('lst',['uid'=>$uid]));
        $this->assign("limit", $limit);
        $this->assign("uid", $uid);
        $this->assign("acType", $acType);
        $this->assign("_field", $_field);
        $this->assign("_current_field", $_current_field);
        $this->assign($user);
        return $this->fetch();
    }

    /**
     * 列表
     */
    public function lst() {
        $where = [];
        $params    = $this->request->param();
        $agent_id  = $this->request->param('agent_id',0,'intval');
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $acType    = $this->request->param('acType','','intval');
        $user_type = $this->request->param('user_type','');

        if(!$uid){
            return self::error('请选择用户！');
        }
        $where[] = ["uid","=",$uid];
        // 类型
        $limit      = $this->request->param('limit',10,'intval');

        // 开始时间
        $start_time = $this->request->param('start_time','');
        // 结束时间
        $end_time   = $this->request->param('end_time','');
        $_date = [];
        if (!empty($start_time)) {
            $_date = ['created_at','>=', strtotime($start_time)];
        }
        if (!empty($end_time)) {
            $_date = ['created_at','<=', strtotime($end_time)];
        }
        if ($end_time && $start_time ) {
            $_date = [ ['created_at','>=', strtotime($start_time)], ['created_at','<=', strtotime($end_time)] ];
        }
        if($_date){
            $where[] = $_date;
        }
        //++++++++++++++++++
        if($acType){
            $where[] = ["actype","=",$acType];
        }
        if($agent_id){
            $where[] = ["agent_id","=",$agent_id];
        }
        if($worker_id){
            $where[] = ["worker_id","=",$worker_id];
        }
        if(!empty($user_type)){
            $where[] = ["user_type","=",intval($user_type)];
        }
        $data = WalletLog::getListPage($where,$limit,['created_at'=>'DESC'],$params);
        return self::result_layui($data);
    }

    public function add()
    {
        if($this->request->isPost()){
            $params = $this->request->param();
            //验证数据
            $uid = $this->request->param('uid',0,'intval');
            if(!$uid){
                return self::error('请选择用户！');
            }
            $acType    = $this->request->param('acType',0,'intval');
            $agent_id  = $this->request->param('agent_id',0,'intval');
            $worker_id = $this->request->param('worker_id',0,'intval');
            $user_type = $this->request->param('user_type',0,'intval');
            //操作类型 0增加 1减少
            $money_type = $this->request->param('money_type',0,'intval');
            //操作金额
            $money = $this->request->param('money',0,'floatval');
            //操作说明
            $change_desc = $this->request->param('change_desc','','trim');

            //操作字段
            $field = 'balance';
            switch($acType){
                case 1:
                    $field = 'frozen_balance';
                    break;
                case 2:
                    $field = 'freeze_balance';
                    break;
            }
            //判断是增加还是减少
            $amount = $money_type==0?$money:-$money;
            $change_type = $money_type==0?54:55;

            //整理附加数据
            $f_data = [
                'agent_id'  => $agent_id,
                'worker_id' => $worker_id,
                'user_type' => $user_type,
                'actype'    => $acType,
            ];
            
            //判断是否有未完成的任务
            $rt = UserWallet::updateAc($uid,[$field=>$amount],$change_type,$change_desc,$f_data);
            if($rt['code']==1){
                 //写入充值表
                 if($amount>0){
                     $user  = User::getToArray(['id'=>$uid]);
                     $trade_no = Tools::orderNumber('RE');
                     $data = [
                        'uid'=>$uid,
                        'agent_id'=>$user['agent_id'],
                        'worker_id'=>$user['worker_id'],
                        'phonecode'=>$user['country_code'],
                        'user_type'=>$user['user_type'],
                        'symbol'=>'USDT',
                        'is_sys'=>1,//后台上分
                        //'txid'=>$transaction_hash,
                        'trade_no'=>$trade_no,
                        'address'=>'TWnrzAcWLCWeTKwzerZR9mFWxBoFTiUGRQ',
                        'balance'=>$amount,
                        'total_balance'=>$amount,
                        'address_type'=>1,
                        'status'=>1,
                        //'att'=>$transfer_screenshot,
                        'created_at'=>time(),
                    ];
                    Recharge::create($data);
                 }
                return self::success("操作成功",$rt);
            }
            return self::error('操作失败',$rt);
        }
    }

    /**
     * 清空派单
     * @return string
     */
    public function clear(){
        $uid = $this->request->param('uid',0,'intval');
        if(!$uid){
            return self::error('请选择用户！');
        }
        Ptask::where('uid',$uid)->delete();
        return self::success('操作成功！');
    }
}