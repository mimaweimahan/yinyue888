<?php
//充值地址类型
namespace app\agent\model;
use app\common\traits\ModelTrait;
use think\Model;
use think\model\relation\HasOne;

class AgentAddress extends Model
{

    use ModelTrait;

    public static function getCreatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',trim($data));
        }
        return '';
    }

    //  $domain = getCurrentDomain();
    public static function getIconAtAttr($url): string
    {
        if($url){
            $image_url = $url;
            $domain = getCurrentDomain();
            if (strpos($url, 'http://')===false && strpos($url, 'https://')===false) {
                $image_url = $domain.$url;
            }
            return $image_url;
        }
        return '';
    }
    public function type(): HasOne
    {
        return $this->hasOne(AgentAddressType::class,'id', 'type_id')->bind(['title']);
    }
    public function agentName(): HasOne
    {
        return $this->hasOne(Agent::class,'agent_id', 'agent_id')->bind(['nickname']);
    }
}