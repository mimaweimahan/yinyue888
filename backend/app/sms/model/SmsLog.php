<?php
/**
 * Created by PhpStorm.
 * Explain: 短信模块
 */
namespace app\sms\model;
use think\Model;
use app\common\model\User;
use app\common\traits\ModelTrait;
class SmsLog extends Model
{
    protected $name  = 'sms_log';
    // 插入数据时自动完成
    protected $insert = ['create_time'];

    use ModelTrait;
    // 处理add_time数据
    public function setCreateTimeAttr($value)
    {
        return time();
    }

    /**
     * 创建时间转换
     * @param $value
     * @return false|string
     */
    public function getCreateTimeAttr($value){
        return $value;
        //return date('Y-m-d H:i:s',$value);
    }

    /**
     * 发送状态转换
     * @param $val
     * @return false|string
     */
    public function getStatusAttr($val=0){
        switch ($val){
            case 1;
                return '已发送';
                break;
            case 2;
                return '发送成功';
                break;
            case 3;
                return '发送失败';
                break;
            default:
                return '未知';
                break;
        }
    }
}