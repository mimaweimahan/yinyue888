<?php
// 充值
namespace app\api\controller\v1;
use app\agent\model\AgentAddress;
use app\agent\model\AgentAddressType;
use app\common\model\User;
use app\Request;
use core\utils\Tools;
use app\agent\model\Recharge as RechargeModel;
class Recharge
{
    public function index(Request $request){
        $uid = $request->uid();
        $agent_id  = User::where('id',$uid)->value('agent_id');
        $type_list = AgentAddressType::getList([],0,'sort asc');
        $data = [];
        if($type_list && $agent_id){
            foreach ($type_list as $v){
                $_data = [
                    'title'=>$v['title'],
                    'name'=>$v['name'],
                    'address'=>''
                ];
                $currency = AgentAddress::getList(['type_id'=>$v['id'],'agent_id'=>$agent_id],0,'sort asc',[],'name,icon,address');
                if($currency){
                    $_data['currency'] = $currency;
                }
                $data[] = $_data;
            }
        }
        $result=[
            'data'=>$data,
            //'tips'=>lang('转账完成后请上传转账凭证，如遇到问题请联系客服处理'),
            'tips'=>'',
        ];
        return app('json')->success($result);
    }

    public function approval(Request $request){
        $uid = $request->uid();
        $amount = $request->param('amount',0,'floatval');
        $transaction_hash    = $request->param('transaction_hash');
        $transfer_screenshot = $request->param('transfer_screenshot','');
        $address = $request->param('address','');

        $address_type = $request->param('address_type','');
        $symbol = $request->param('symbol','');
        if(!$address){
            return app('json')->fail(lang('缺少参数'));
        }
        if(!$amount){
            return app('json')->fail(lang('缺少参数'));
        }
        /*
        if(!$transaction_hash){
            return app('json')->fail(lang('缺少参数'));
        }
        if(!$transfer_screenshot){
            return app('json')->fail(lang('缺少参数'));
        }
        */
        $trade_no = Tools::orderNumber('RE');
        $is_sc = 1;
        $user  = User::getToArray(['id'=>$uid]);
        $be    = RechargeModel::where(['uid'=>$uid,'status'=>1])->count();
        if($be){
            $is_sc = 0;
        }
        //0 TRC,1 ERC,2 BSC,3 BIT
        $_type = 0;
        switch ($address_type){
            case "trc":
                $_type = 0;
                break;
            case "erc":
                $_type = 1;
                break;
            case "bsc":
                $_type = 3;
                break;
            case "bit":
                $_type = 4;
                break;
        }
        $data = [
            'uid'=>$uid,
            'agent_id'=>$user['agent_id'],
            'worker_id'=>$user['worker_id'],
            'phonecode'=>$user['country_code'],
            'user_type'=>$user['user_type'],
            'symbol'=>$symbol,
            //'txid'=>$transaction_hash,
            'trade_no'=>$trade_no,
            'address'=>$address,
            'balance'=>$amount,
            'total_balance'=>$amount,
            'address_type'=>$_type,
            'is_sc'=>$is_sc,
            //'att'=>$transfer_screenshot,
            'created_at'=>time(),
        ];
        $db = RechargeModel::create($data);
        if(isset($db->id) && $db->id){
            return app('json')->success( lang('提交成功，请等待管理员审核') );
        }
        return app('json')->fail(lang('操作失败，请联系客服'));
    }
}