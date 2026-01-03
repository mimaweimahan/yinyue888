<?php
declare (strict_types = 1);
namespace app\admin\model;
use think\Model;
use app\common\traits\ModelTrait;
class Forms extends Model
{
    use ModelTrait;
    /**
     * 获取文件分类名称
     * @return \think\model\relation\HasOne
     */
    public function type()
    {
        return $this->hasOne('FileType','id', 'type_id')->bind(['type_name']);
    }
}