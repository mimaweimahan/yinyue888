<?php
namespace app\page\model;
use app\common\traits\ModelTrait;
use think\Model;

class DiyPage extends Model
{
    // 设置返回数据集的对象名
    protected $name ='diy_page';
    use ModelTrait;

    public function getCreateTimeAttr($value)
    {
        if($value){
            $value =date('Y-m-d H:i:s',$value);
        }
        return $value;
    }

    public function setCreateTimeAttr($value)
    {
        return time();
    }

    public function setUpdateTimeAttr($value)
    {
        return time();
    }
}