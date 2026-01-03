<?php
namespace app\page\model;
use app\common\traits\ModelTrait;
use think\Model;

class DiyNav extends Model
{
    // 设置返回数据集的对象名
    protected $name ='diy_nav';
    use ModelTrait;

    public function getAttributeAttr($value)
    {
        if($value){
            $value = json_decode($value,true);
        }
        return $value;
    }

    public function setAttributeAttr($value)
    {
        if($value){
            $value = json_encode($value,256);
        }
        return $value;
    }

}