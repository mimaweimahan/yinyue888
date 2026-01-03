<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 文件库分类
 */
namespace app\admin\model;
use think\Model;
use app\common\traits\ModelTrait;

class FileType extends Model
{
    public $error = '';
    use ModelTrait;
    protected $name ='file_type';

    /**
     * 获取数据
     * @return array
     */
    public static function allData($type_id=''){
        $_list = self::getList(['pid'=>0],0,'id desc');
        $data  = [];
        if(!$_list){
            return $data;
        }
        foreach ($_list as $r){
            $result = ($type_id == $r['id']) ? true : false;
            $_data  = [
                'id'=>$r['id'],
                'title'=>$r['type_name'],
                'checked'=>$result,
                'spread'=>$result
            ];
            $children = self::children($r['id'],$type_id);
            if($children){
                $_data['children'] = $children;
            }
            $data[] = $_data;
        }
        return $data;
    }

    /**
     * 获取子菜单
     * @param $pid
     * @param $type_id
     * @return array
     */
    public static function children($pid,$type_id){
        $_list = self::getList(['pid'=>$pid],0,'id desc');
        if($_list){
            $data =[];
            foreach ($_list as $v){
                $result = ($type_id == $v['id']) ? true : false;
                $_data = [
                    'id'=>$v['id'],
                    'title'=>$v['type_name'],
                    'checked'=>$result,
                    'spread'=>$result
                ];
                $children = self::children($v['id'],$type_id);
                if($children){
                    $_data['children'] = $children;
                }
                $data[] = $_data;
            }
            return $data;
        }
        return [];
    }
}