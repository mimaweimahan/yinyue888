<?php

namespace app\agent\model;

use think\Model;
use app\common\traits\ModelTrait;
class UserRepeat extends Model
{
    use ModelTrait;

    public static function getCreatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',trim($data));
        }
        return '';
    }

    public static function setCreatedAtAttr($data): string
    {
        return time();
    }
}