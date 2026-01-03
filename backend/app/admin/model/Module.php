<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 模块安装处理模型
 */
namespace app\admin\model;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
class Module extends BaseModel
{
    // 表名
    protected $name = 'module';
    protected $module = '';
    public    $error='';
    use ModelTrait;

    /**
     * 获取安装模块缓存
     */
    public static function module_cache()
    {
        cache('Module', NULL);
        $data = self::getList(['disabled'=>0]);
        if (empty($data)) {
            return false;
        }
        $module = array();
        foreach ($data as $v) {
            $module[$v['module']] = $v;
        }
        cache('Module', $module);
        return $module;
    }

    /**
     * 模块状态转换
     */
    public function disabled($module = '')
    {
        if (empty($module)) {
            $this->error = '请选模块！';
            return false;
        }
        //取得该模块数据库中记录的安装信息
        $info = $this->where(['module'=>$module])->find();
        if (empty($info)) {
            $this->error = '该模块未安装，无需进行此操作！';
            return false;
        }
        if ($info['is_core']) {
            $this->error = '内置模块，不能禁用！';
            return false;
        }
        $disabled = $info['disabled'] ? 0 : 1;
        if ( false !== $this->where(['module'=>$module])->update(['disabled'=>$disabled]) ) {
            //更新缓存
            cache('Module', NULL);
            return true;
        } else {
            $this->error = '状态转换失败！';
            return false;
        }
    }
}
