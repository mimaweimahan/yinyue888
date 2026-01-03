<?php
/**
 * Created by PhpStorm.
 * Explain: swiper
 */
namespace app\swiper\model;
use think\Model;
use app\common\traits\ModelTrait;
class Swiper extends Model
{
    protected $name  = 'swiper';

    use ModelTrait;

    /**
     * swiper 处理
     * @param $data
     * @return mixed
     */
    public function getSwiperAttr($data){
        if($data){
            $data = unserialize($data);
        }
        if(is_array($data) && count($data)>0){
            return arraySort($data,'num');
        }
        return $data;
    }
}