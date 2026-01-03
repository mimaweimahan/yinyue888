<?php

namespace app\api\controller\v1;
use app\common\model\user\UserWallet;
use app\Request;
use app\agent\model\WalletLog;
use app\agent\model\Withdrawal;
class Wallet
{
    public function info(Request $request){
        $data = UserWallet::getToArray(['uid'=>$request->uid()]);
        $total_balance = $data['balance'] + $data['freeze_balance'];
        $data['total_balance'] = sprintf("%.4f", $total_balance);
        return app('json')->success($data);
    }

    public function log(Request $request){
        $uid = $request->uid();
        $type    = $request->param('type',1,'intval');//类型
        $limit   = $request->param('limit',10);
        $params  = $request->param();
        if($type==1){
            return $this->recharge($uid,$limit,$params);
        }
        if($type==2){
            return $this->withdrawal($uid,$limit,$params);
        }
        // 1消费、2充值、3提现、4收益、5奖励、6转账,50占用,51解押,52赠金,53出金,54上分,55下分
        switch ($type){
            case 2:
                $change_type = [3,53];//提现
                break;
            case 3:
                $change_type = [4,55];//收益 54上分,55
                break;
            case 4:
                $change_type = [5];//佣金
                break;
            default:
                $change_type = [2,54];//充值
                break;
        }
        $where   = [];
        $where[] = ['uid','=',$uid];
        $where[] = ['change_type','IN',$change_type];
        $where[] = ['actype','=',0];
        $where[] = ['is_hide','=',0];
        $list = WalletLog::getListPage($where,$limit,'id desc',$params);
        foreach ($list['data'] as $k=>$r){
            $list['data'][$k]['created_at'] = date('m/d/Y H:i',strtotime($r['created_at']));
            //----------------------------------
            // records.withdraw_status.0 // Waiting
            // records.withdraw_status.1 // Completed
            // records.withdraw_status.-1 // Cancelled
            //---------------------------------
            $tips = 'records.withdraw_status.1';
            $list['data'][$k]['tips']   = $tips;
            $list['data'][$k]['status'] = 1;
        }
        //$list['MAP'] = $where;
        return app('json')->success( $list );
    }

    private function withdrawal($uid,$limit,$params){
        $map[] = ['uid','=',$uid];
        $list = Withdrawal::getListPage($map,$limit,'id desc',$params);
        foreach ($list['data'] as $k=>$r){
            $list['data'][$k]['created_at'] = date('m/d/Y H:i',strtotime($r['created_at']));
            //----------------------------------
            // records.withdraw_status.0 // Waiting
            // records.withdraw_status.1 // Completed
            // records.withdraw_status.-1 // Cancelled
            //---------------------------------
            $status = $r['status'];
            if($status==2){
                $status = -1;
            }
            $tips = 'records.withdraw_status.'.$status;
            $list['data'][$k]['tips'] = $tips;
        }
        return app('json')->success( $list );
    }

    private function recharge($uid,$limit,$params){
        $map[] = ['uid','=',$uid];
        $list = \app\agent\model\Recharge::getListPage($map,$limit,'id desc',$params);
        foreach ($list['data'] as $k=>$r){
            $list['data'][$k]['created_at'] = date('m/d/Y H:i',strtotime($r['created_at']));
            $status = $r['status'];
            if($status==2){
                $status = -1;
            }
            $tips = 'records.withdraw_status.'.$status;
            $list['data'][$k]['tips'] = $tips;
        }
        return app('json')->success( $list );
    }
}