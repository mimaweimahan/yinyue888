<?php
declare (strict_types = 1);
/**
 * Explain: 账户记录
 */
namespace app\common\model\user;
use app\common\model\BaseModel;
use app\common\model\User;
use app\common\traits\ModelTrait;
use think\model\relation\HasOne;

class UserRecord extends BaseModel
{
    /**
     * 模型名称
     * @var string
     */
    use ModelTrait;

    public function getAddTimeAttr($val){
        return date('Y-m-d H:i:s',$val);
    }
    /**
     * 记录类型
     * @param int $val 1消费、2充值、3提现、4收益、5奖励、6转入
     * @param int $text
     * @return string
     */
    public static function type($val=0,$text=0){
        switch ($val){
            case 1:
                return $text==1?'消费':'<span class="layui-badge layui-bg-green">消费</span>';
                break;
            case 2:
                return $text==1?'充值':'<span class="layui-badge layui-bg-blue">充值</span>';
                break;
            case 3:
                return $text==1?'提现':'<span class="layui-badge">提现</span>';
                break;
            case 4:
                return $text==1?'收益':'<span class="layui-badge layui-bg-warm">收益</span>';
                break;
            case 5:
                return $text==1?'奖励':'<span class="layui-badge layui-bg-danger">奖励</span>';
                break;
            case 6:
                return $text==1?'转账': '<span class="layui-badge" style="background-color: #7b51b6">转账</span>';
                break;
            default:
                return $text==1?'其他': '<span class="layui-badge" style="background-color: #1699cd">其他</span>';
                break;
        }
    }

    /**
     * 用户
     * @return HasOne
     */
    public function withUser()
    {
        return $this->hasOne(User::class,'id', 'uid')->bind(['nickname']);
    }
}