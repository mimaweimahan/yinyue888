<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 系统配置模型
 */
namespace app\admin\model;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Config extends BaseModel
{
    public $error = '';
    use ModelTrait;

    /**
     * 配置
     * @throws DataNotFoundException
     * @throws DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function setConfig(){
        return self::setCache(true);
    }

    /**
     * 设置配置缓存
     * @param bool $update
     * @return array|mixed
     * @throws DataNotFoundException
     * @throws DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function setCache($update = false){
        if($update){
            cache('app_config' ,null);
        }
        $cache_config = cache('app_config');

        if($cache_config){
            return $cache_config;
        }else{
            cache('app_config',null);
            $data   = (new self())->where('status',1)->field('type,name,value')->select();
            if($data){
                $data = $data->toArray();
            }
            $config = array();
            foreach ($data as $value) {
                $config[$value['name']] = self::parse($value['type'], $value['value']);
            }
            cache('app_config',$config);
            return $config;
        }
    }

    /**
     * 根据配置类型解析配置
     * @param  integer $type  配置类型
     * @param  string  $value 配置值
     * @return array
     */
    private static function parse($type, $value){
        switch ($type) {
            case 3: //解析数组
                $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if(strpos($value,':')){
                    $value  = array();
                    foreach ($array as $val) {
                        list($k, $v) = explode(':', $val);
                        $value[$k]   = $v;
                    }
                }else{
                    $value =    $array;
                }
                break;
        }
        return $value;
    }

    /**
     * 获取单个参数配置
     * @param $name
     * @return bool|mixed
     * @throws DataNotFoundException
     * @throws DbException
     */
    public static function getConfigValue($name)
    {
        try {
            return self::where('name', $name)->value('value');
        } catch (DataNotFoundException $e) {
            return '';
        } catch (ModelNotFoundException $e) {
            return '';
        } catch (DbException $e) {
            return '';
        }
    }

    /**
     * 获得多个参数
     * @param $menus
     * @return array
     */
    public static function getMore($menus)
    {
        $menus = is_array($menus) ? implode(',', $menus) : $menus;
        $list = self::where('name', 'IN', $menus)->column('value', 'name') ?: [];
        foreach ($list as $menu => $value) {
            $list[$menu] = $value;
        }
        return $list;
    }

    /**
     * 获取全部
     * @return array
     */
    public static function getAllConfig()
    {
        $_list = self::column('value', 'name') ?: [];
        $list  = [];
        foreach ($_list as $key => $value) {
            $list[$key] = $value;
        }
        return $list;
    }




    /**
     * 获取一数据
     * @param $filed
     * @param $value
     * @return array|\think\Model|null
     * @throws DataNotFoundException
     * @throws DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getOneConfig($filed, $value)
    {
        $where[$filed] = $value;
        return self::where($where)->find();
    }
}