<?php

namespace app\agent\model;

use app\common\traits\ModelTrait;
use think\Model;
use think\model\relation\HasOne;

class AgentLog extends Model
{
    use ModelTrait;

    public static function getCreatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',trim($data));
        }
        return '';
    }

    public function agentName(): HasOne
    {
        return $this->hasOne(Agent::class,'agent_id', 'agent_id')->bind(['nickname']);
    }

    /**
     * 更新账户
     * @param int $agent_id
     * @param int|float $amount  变动金额
     * @param int $type 变动类型 1提现/2收益/3冻结/4解押/5奖励/6转出/7上分/8下分
     * @param string $remark
     * @return array
     */
    public static function updateAc(int $agent_id=0, int|float $amount=0, int $type=1, string $remark='')
    {
        if(!$agent_id){
            return ['code'=>0,'msg'=>'用户ID为空'];
        }
        self::startTrans();
        try {
            $do = Agent::where(['agent_id'=>$agent_id])->inc('balance',$amount)->save();
            $log_data = [];
            if($do){
                $current_balance = Agent::where(['agent_id'=>$agent_id])->value('balance');
                // 记录数据
                $log_data = [
                    'agent_id'=>$agent_id,
                    'balance'=>$amount,
                    'current_balance'=>$current_balance,
                    'type'=>$type,
                    'created_at'=>time(),
                ];
                if($remark){
                    $log_data['remark'] = $remark;
                }
            }
            if( count($log_data)<1 ){
                self::rollback();
                return ['code'=>0,'msg'=>'账户变动失败'];
            }
            // 写入账户记录
            $rt = self::create($log_data);
            if($rt->id){
                self::commit();
                return ['code'=>1,'msg'=>'操作成功','data'=>$log_data];
            }else{
                self::rollback();
                return ['code'=>0,'msg'=>'操作失败', 'data'=>$rt];
            }
        }catch (\Exception $e){
            self::rollback();
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }
}