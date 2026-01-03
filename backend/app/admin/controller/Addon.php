<?php
declare (strict_types = 1);
namespace app\admin\controller;
use think\facade\Request;
use think\facade\Db;
use think\facade\Config;
use utils\Addons;
use utils\FormBuilder;
/**
 * 插件控制器
 */
class Addon extends \app\AdminInit
{
    private $AddonPath = '';
    public function initialize()
    {
        parent::initialize();
        $this->AddonPath = base_path().'addons';
    }

    /**
     * 插件列表
     */
    public function index()
    {
        $limit = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            $addon_lst = Addons::localList();
            return self::result_layui($addon_lst);
        }
        $this->assign('limit',$limit);
        $this->assign('url',url('index'));
        return $this->fetch();
    }

    // 插件配置信息预览
    public function config(string $name)
    {
        $config = Addons::loadConfig($name);
        // 如果插件自带配置模版的话加载插件自带的，否则调用表单构建器
        $file   = app()->getRootPath() . 'addons' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'config.html';
        if (file_exists($file)) {
            $this->assign([ 'config' => $config ]);
            return $this->fetch($file);
        } else {
            // 获取字段数据
            $columns = self::makeAddColumns($config);
            // 判断是否分组
            $group   = Addons::checkConfigGroup($config);
            // 构建页面
            $builder = FormBuilder::getInstance();
            $builder->setFormUrl(url('configSave'))->addHidden('id', $name);
            $group ? $builder->addGroup($columns) : $builder->addFormItems($columns);
            try {
                return $builder->fetch();
            } catch (\Exception $e) {
                return self::error($e->getMessage());
            }
        }
    }

    // 插件配置信息保存
    public function configSave()
    {
        if (Request::isPost()) {
            $result = Addons::configPost(Request::except(['file'], 'post'));
            if ($result['code'] == 1) {
                return self::success($result['msg'], 'index');
            }
            return self::error($result['msg']);
        }
    }

    /**
     * 更改插件状态 [启用/禁用]
     * @param string $id
     * @return array
     */
    public function state(string $id)
    {
        return Addons::state($id);
    }

    /**
     * 安装插件
     * @param string $id
     * @return array
     */
    public function install(string $id)
    {
        return Addons::install($id);
    }

    /**
     * 卸载插件
     * @param string $id
     * @return array
     */
    public function uninstall(string $id)
    {
        return Addons::uninstall($id);
    }

    /**
     * 获取插件源资源文件夹
     * @param string $name 插件名称
     * @return  string
     */
    protected static function getSourceAssetsDir($name)
    {
        return app()->getRootPath() . 'addons/' . $name . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR;
    }


    // 生成表单信息
    private static function makeAddColumns(array $config)
    {
        // 判断是否开启了分组
        if (Addons::checkConfigGroup($config) === false) {
            // 未开启分组
            return self::makeAddColumnsArr($config);
        } else {
            $columns = [];
            // 开启分组
            foreach ($config as $k => $v) {
                $columns[$k] = self::makeAddColumnsArr($v);
            }
            return $columns;
        }
    }

    // 生成表单返回数组
    private static function makeAddColumnsArr(array $config)
    {
        $columns = [];
        foreach ($config as $k => $field) {
            // 初始化
            $field['name'] = $field['name'] ?? $field['title'];
            $field['field'] = $k;
            $field['tips'] = $field['tips'] ?? '';
            $field['required'] = $field['required'] ?? 0;
            $field['group'] = $field['group'] ?? '';
            if (!isset($field['setup'])) {
                $field['setup'] = [
                    'default' => $field['value'] ?? '',
                    'extra_attr' => $field['extra_attr'] ?? '',
                    'extra_class' => $field['extra_class'] ?? '',
                    'placeholder' => $field['placeholder'] ?? '',
                ];
            }

            if ($field['type'] == 'text') {
                $columns[] = [
                    $field['type'],                // 类型
                    $field['field'],               // 字段名称
                    $field['name'],                // 字段别名
                    $field['tips'],                // 提示信息
                    $field['setup']['default'],    // 默认值
                    $field['group'],               // 标签组，可以在文本框前后添加按钮或者文字
                    $field['setup']['extra_attr'], // 额外属性
                    $field['setup']['extra_class'],// 额外CSS
                    $field['setup']['placeholder'],// 占位符
                    $field['required'],            // 是否必填
                ];
            }
            elseif ($field['type'] == 'textarea' || $field['type'] == 'password') {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['setup']['default'],           // 默认值
                    $field['setup']['extra_attr'],        // 额外属性
                    $field['setup']['extra_class'] ?? '', // 额外CSS
                    $field['setup']['placeholder'] ?? '', // 占位符
                    $field['required'],                   // 是否必填
                ];
            }
            elseif ($field['type'] == 'radio' || $field['type'] == 'checkbox') {
                $columns[] = [
                    $field['type'],                // 类型
                    $field['field'],               // 字段名称
                    $field['name'],                // 字段别名
                    $field['tips'],                // 提示信息
                    $field['options'],             // 选项（数组）
                    $field['setup']['default'],    // 默认值
                    $field['setup']['extra_attr'], // 额外属性 extra_attr
                    '',                            // 额外CSS extra_class
                    $field['required'],            // 是否必填
                ];
            }
            elseif ($field['type'] == 'select' || $field['type'] == 'select2' ) {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['options'],                    // 选项（数组）
                    $field['setup']['default'],           // 默认值
                    $field['setup']['extra_attr'],        // 额外属性
                    $field['setup']['extra_class'] ?? '', // 额外CSS
                    $field['setup']['placeholder'] ?? '', // 占位符
                    $field['required'],                   // 是否必填
                ];
            }
            elseif ($field['type'] == 'number') {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['setup']['default'],           // 默认值
                    '',                                   // 最小值
                    '',                                   // 最大值
                    $field['setup']['step'],              // 步进值
                    $field['setup']['extra_attr'],        // 额外属性
                    $field['setup']['extra_class'],       // 额外CSS
                    $field['setup']['placeholder'] ?? '', // 占位符
                    $field['required'],                   // 是否必填
                ];
            }
            elseif ($field['type'] == 'hidden') {
                $columns[] = [
                    $field['type'],                      // 类型
                    $field['field'],                     // 字段名称
                    $field['setup']['default'] ?? '',    // 默认值
                    $field['setup']['extra_attr'] ?? '', // 额外属性 extra_attr
                ];
            }
            elseif ($field['type'] == 'date' || $field['type'] == 'time' || $field['type'] == 'datetime') {
                // 使用每个字段设定的格式
                if ($field['type'] == 'time') {
                    $field['setup']['format'] = str_replace("HH", "h", $field['setup']['format']);
                    $field['setup']['format'] = str_replace("mm", "i", $field['setup']['format']);
                    $field['setup']['format'] = str_replace("ss", "s", $field['setup']['format']);
                    $format = $field['setup']['format'] ?? 'H:i:s';
                } else {
                    $field['setup']['format'] = str_replace("yyyy", "Y", $field['setup']['format']);
                    $field['setup']['format'] = str_replace("mm", "m", $field['setup']['format']);
                    $field['setup']['format'] = str_replace("dd", "d", $field['setup']['format']);
                    $field['setup']['format'] = str_replace("hh", "h", $field['setup']['format']);
                    $field['setup']['format'] = str_replace("ii", "i", $field['setup']['format']);
                    $field['setup']['format'] = str_replace("ss", "s", $field['setup']['format']);
                    $format = $field['setup']['format'] ?? 'Y-m-d H:i:s';
                }
                $field['setup']['default'] = $field['setup']['default'] > 0 ? date($format, $field['setup']['default']) : '';
                $columns[] = [
                    $field['type'],                // 类型
                    $field['field'],               // 字段名称
                    $field['name'],                // 字段别名
                    $field['tips'],                // 提示信息
                    $field['setup']['default'],    // 默认值
                    $field['setup']['format'],     // 日期格式
                    $field['setup']['extra_attr'], // 额外属性 extra_attr
                    '',                            // 额外CSS extra_class
                    $field['setup']['placeholder'],// 占位符
                    $field['required'],            // 是否必填
                ];
            }
            elseif ($field['type'] == 'daterange') {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['setup']['default'],           // 默认值
                    $field['setup']['format'],            // 日期格式
                    $field['setup']['extra_attr'] ?? '',  // 额外属性
                    $field['setup']['extra_class'] ?? '', // 额外CSS
                    $field['required'],                   // 是否必填
                ];
            }
            elseif ($field['type'] == 'tag') {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['setup']['default'],           // 默认值
                    $field['setup']['extra_attr'] ?? '',  // 额外属性
                    $field['setup']['extra_class'] ?? '', // 额外CSS
                    $field['required'],                   // 是否必填
                ];
            }
            elseif ($field['type'] == 'image' || $field['type'] == 'images' || $field['type'] == 'file' || $field['type'] == 'files') {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['setup']['default'],           // 默认值
                    $field['setup']['size'],              // 限制大小（单位kb）
                    $field['setup']['ext'],               // 文件后缀
                    $field['setup']['extra_attr'] ?? '',  // 额外属性
                    $field['setup']['extra_class'] ?? '', // 额外CSS
                    $field['setup']['placeholder'] ?? '', // 占位符
                    $field['required'],                   // 是否必填
                ];
            }
            elseif ($field['type'] == 'editor') {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['setup']['default'],           // 默认值
                    $field['setup']['heidht'] ?? 0,       // 高度
                    $field['setup']['extra_attr'] ?? '',  // 额外属性
                    $field['setup']['extra_class'] ?? '', // 额外CSS
                    $field['required'],                   // 是否必填
                ];
            }
            elseif ($field['type'] == 'color') {
                $columns[] = [
                    $field['type'],                       // 类型
                    $field['field'],                      // 字段名称
                    $field['name'],                       // 字段别名
                    $field['tips'],                       // 提示信息
                    $field['setup']['default'],           // 默认值
                    $field['setup']['extra_attr'] ?? '',  // 额外属性
                    $field['setup']['extra_class'] ?? '', // 额外CSS
                    $field['setup']['placeholder'] ?? '', // 占位符
                    $field['required'],                   // 是否必填
                ];
            }
        }
        return $columns;
    }

    // 生成列表页额外JS
    private function makeExtraJs()
    {
        $js = '<script type="text/javascript">
                // 安装
                $.operate.pluginInstall = function(id) {
                    var url = \''.url('install').'\';
                    $.modal.confirm("确认要安装?", function () {
                        var data = {"id": id};
                        $.operate.submit(url, "post", "json", data);
                    });
                }
                // 卸载
                $.operate.pluginUninstall = function(id) {
                    var url = \''.url('uninstall').'\';
                    $.modal.confirm("确认要卸载?", function () {
                        var data = {"id": id};
                        $.operate.submit(url, "post", "json", data);
                    });
                }
            </script>';
        return $js;
    }
}
