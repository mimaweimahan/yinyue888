<?php
namespace app\api\controller\v1;
use app\agent\model\Orders;
use app\common\model\user\UserWallet;
use app\common\model\User;
use app\agent\model\Withdrawal as WithdrawalModel;
use app\Request;
use core\utils\Tools;
use think\facade\Lang;

class Withdrawal
{
    /**
     * 申请提现
     * @param Request $request
     * @return mixed
     */
    public function out(Request $request){
        $uid = $request->uid();
        list($address,$amount,$ac_type,$security) = Tools::getData([
            ['address', '','trim'],
            ['amount', 0,'floatval'],
            ['ac_type', 0,'floatval'],
            ['security', '','trim'],
        ], $request, true);

        if(!$address ){
            return app('json')->fail( Lang::get('请填写提现地址') );
        }
        if(!$amount ){
            return app('json')->fail( Lang::get('请填写提现金额') );
        }
        if(empty($ac_type) ){
            return app('json')->fail( Lang::get('请选提现地址类型'));
        }
        if(empty($security) ){
            return app('json')->fail( Lang::get('请填写交易密码') );
        }
        
        // 判断余额够不够
        $wallet = UserWallet::getToArray(['uid'=>$uid]);
        if($wallet['balance'] < $amount){
            return app('json')->fail( Lang::get('提现金额不能大于可提现余额'));
        }

        // 判断交易密码
        $user = User::getToArray(['id'=>$uid]);
        $security = think_md5($security);
        if($user['trans_password'] != $security){
            return app('json')->fail( Lang::get('交易密码错误'));
        }

        // 判断用户是否被禁用 (用户被禁用或提现被禁用或是子虚拟账号)
        if($user['status'] == 0 || $user['is_withdraw']==1 ){
            return app('json')->fail( Lang::get('账号异常，请联系客服处理'));
        }

        // 判断用户信誉分
        if($user['credit_score'] < 100){
            return app('json')->fail( 'Amount Due to your delayed order completion or 100.00 Withdrawal failure to fulfill orders according to platform regulations, your credit score has decreased. You must promptly replenish your credit score to restore withdrawal privileges.');
        }

        // 判断是否有未完成的任务订单
        $be = Orders::getToArray(['uid'=>$uid,'status'=>0]);
        if($be){
            return app('json')->fail( Lang::get('请先完成未完成的任务订单'));
        }
        // 判断是否完完成任务
        if(intval($user['task_done']) < intval($user['task_num']) ){
            return app('json')->fail( Lang::get('任务未完成提现失败，请联系客服处理'));
        }

        WithdrawalModel::startTrans();
        try {
            $trade_no = Tools::orderNumber('TX');
            $withdraw_fee = 0;
            if($ac_type == 1){
                $_trc = floatval(getConfig('withdraw_trc_fee'));
                if($_trc){
                    $withdraw_fee = $amount*$_trc;
                }
            }else{
                $_erc = floatval(getConfig('withdraw_erc_fee'));
                if($_erc){
                    $withdraw_fee = $amount*$_erc;
                }
            }
            //创建提现记录
            $_data = [
                 'agent_id'=>$user['agent_id'],
                 'worker_id'=>$user['worker_id'],
                 'uid'=>$user['id'],
                 'user_type'=>$user['user_type'],
                 'phonecode'=>$user['country_code'],
                 'trade_no'=>$trade_no,
                 'withdraw_type'=>$ac_type,
                 'address'=>$address,
                 'balance'=>$amount,
                 'symbol'=>'USDT',
                 'withdraw_fee'=>$withdraw_fee,
                 'ip'=>realIp(),
                 'mark'=>'提现',
                 'created_at'=>time(),
            ];
            if($user['user_type'] == 1){
                $_data['status'] = 1;
            }
            $db = WithdrawalModel::create($_data);
            if(!$db->id){
                WithdrawalModel::rollback();
                return app('json')->fail( Lang::get('提现失败，请联系客服'));
            }

            // 扣除提现金额
            $f_data = [
                'agent_id'  => $user['agent_id'],
                'worker_id' => $user['worker_id'],
                'user_type' => $user['user_type'],
                'actype'    => 0,
            ];

            $rt = UserWallet::updateAc($uid, ['balance'=>-$amount], 53, '提现', $f_data);
            if(!$rt['code']){
                WithdrawalModel::rollback();
                return app('json')->fail( Lang::get('提现失败，请联系客服'));
            }
            WithdrawalModel::commit();
            return app('json')->success( Lang::get('提现成功'));
        }catch (\Exception $e){
            WithdrawalModel::rollback();
            return app('json')->fail( Lang::get('提现失败，请联系客服'));
        }
    }


    /**
     * 获取当前用户的提现账号
     * @param Request $request
     * @return mixed
     */
    public function query(Request $request){
        $type   = $request->param('type',0, 'intval');
        $params = $request->param();
        $uid  = $request->uid();
        $map  = [];
        $map[] = ['uid','=',$uid];
        if($type){
            $map[] = ['type','=',$type];
        }
        $data = WithdrawalModel::getListPage($map,10,'type asc',$params);
        return app('json')->success($data);
    }
}