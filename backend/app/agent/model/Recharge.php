<?php

namespace app\agent\model;

use app\common\traits\ModelTrait;
use think\Model;

class Recharge  extends Model
{
    protected $append = ['agent_name','worker_name'];

    use ModelTrait;
    // 密码处理
    public static function getCreatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',trim($data));
        }
        return '';
    }

    //updated_at
    public static function getUpdatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',trim($data));
        }
        return '';
    }

    public static function getAgentNameAttr($str, $data)
    {
        $agent_name = '';
        if(isset($data['agent_id']) && $data['agent_id']>0){
            $agent_name = Agent::where('agent_id',$data['agent_id'])->value('username');
        }
        return $agent_name;
    }

    //worker_name
    public static function getWorkerNameAttr($str, $data)
    {
        $worker_name = '';
        if(isset($data['worker_id']) && $data['worker_id']>0){
            $worker_name = Salesman::where('worker_id',$data['worker_id'])->value('worker_user');
        }
        return $worker_name;
    }
}