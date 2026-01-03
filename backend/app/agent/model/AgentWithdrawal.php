<?php

namespace app\agent\model;

use app\agent\model\Agent;
use app\common\traits\ModelTrait;
use think\Model;

class AgentWithdrawal  extends Model
{
    use ModelTrait;
    // 密码处理
    public static function getCreatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',$data);
        }
        return '';
    }

    public static function getPaidAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',$data);
        }
        return '';
    }

    public function agent()
    {
        return $this->hasOne(Agent::class,'agent_id', 'agent_id')
            ->hidden(['password','secret_key','last_time','last_ip']);
    }
}