<?php
// +----------------------------------------------------------------------
// | 插件安装逻辑处理
// +----------------------------------------------------------------------
// | Copyright (c) 2020~2030 https://www.x.com All rights reserved
// +----------------------------------------------------------------------
// | Licensed TT[管理系统]并不是自由软件，未经许可不能去掉TT相关版权及二次开发
// +----------------------------------------------------------------------
// | Author: TT <wechat:office1680>
// +----------------------------------------------------------------------
namespace utils;
use think\facade\Db;
use think\facade\Config;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
class Addons
{
    const copyDirs = [
        'app',    // 此文件夹中所有文件会覆盖到根目录的/app文件夹
        'public', // 此文件夹中所有文件会覆盖到根目录的/public文件夹
    ];
    /**
     * 获得本地插件列表
     * @return array
     */
    public static function localList()
    {
        $plugins = scandir(root_path() . 'addons');
        $list = [];
        foreach ($plugins as $name) {
            if ($name === '.' or $name === '..')
                continue;
            if (is_file(root_path() . 'addons' .DIRECTORY_SEPARATOR . $name))
                continue;
            $addonDir = root_path() . 'addons' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
            if (!is_dir($addonDir))
                continue;

            $object = self::getInstance($name);
            if ($object) {
                // 获取插件基础信息
                $info = self::getPluginInfo($name);
                // 增加右侧按钮组
                $str = '';
                if (isset($info['install'])&&$info['install'] == 1) {
                    // 已安装，增加配置按钮
                    $str .= '<a class="layui-btn layui-btn-normal layui-btn-xs" href="javascript:void(0)" data-name="'.$name.'" lay-event="config"><i class="fa fa-edit"></i> 配置</a> ';
                    $str .= '<a class="layui-btn layui-btn-danger layui-btn-xs" href="javascript:void(0)" data-name="'.$name.'" lay-event="uninstall"><i class="fa fa-edit"></i> 卸载</a> ';

                } else {
                    // 未安装，增加安装按钮
                    $str = '<a class="layui-btn layui-btn-normal layui-btn-xs" href="javascript:void(0)" data-name="'.$name.'" lay-event="install"><i class="fa fa-edit"></i> 安装</a>';
                }

                $info['button'] = $str;

                $list[] = $info;
            }
        }
        return $list;
    }

    /**
     * 保存插件信息
     * @param array $data
     * @return array
     */
    public static function configPost(array $data = [])
    {
        $check = self::check($data['id']);
        if ($check !== true) {
            return [
                'code' => 0,
                'msg' => $check
            ];
        }
        // 实例化插件
        $object = self::getInstance($data['id']);
        if ($object) {
            // 获取插件配置信息
            $config = self::getAddonsConfig($data['id']);
            // 判断是否分组
            $group  = self::checkConfigGroup($config);
            if ($data) {
                if ($group) {
                    // 开启分组
                    foreach ($config as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            if (isset($data[$kk])) {
                                $value = is_array($data[$kk]) ? implode(',', $data[$kk]) : ($data[$kk] ?? $vv['value']);
                                $config[$k][$kk]['value'] = $value;
                            }
                        }
                    }
                } else {
                    // 未开启分组
                    foreach ($config as $k => $v) {
                        if (isset($data[$k])) {
                            $value = is_array($data[$k]) ? implode(',', $data[$k]) : ($data[$k] ?? $v['value']);
                            $config[$k]['value'] = $value;
                        }
                    }
                }
            }
            // 更新配置文件
            $result = self::setPluginConfig($data['id'], $config);
            if ($result['code'] == 1) {
                return [
                    'code' => 1,
                    'msg'  => '保存成功!'
                ];
            }
            return [
                'code' => 0,
                'msg'  => $result['msg']
            ];
        }
        return [
            'code' => 0,
            'msg' => '插件实例化失败'
        ];
    }

    /**
     * 安装插件
     * @param string $name
     * @return array
     */
    public static function install(string $name)
    {
        // 实例化插件
        $object = self::getInstance($name);
        // 获取插件基础信息
        $info = self::getPluginInfo($name);
        if (false !== $object->install()) {
            $info['status'] = 1;
            $info['install'] = 1;
            try {
                // 更新或创建插件的ini文件
                $result = self::setPluginIni($name, $info);
                if ($result['code'] == 0) {
                    return [
                        'code' => 0,
                        'msg'  => $result['msg'],
                    ];
                }
                // 复制文件
                self::copyDir($name);
                // 导入SQL
                self::importsql($name);
            } catch (\Exception $e) {
                return [
                    'code' => 0,
                    'msg'  => '安装失败：' . $e->getMessage(),
                ];
            }
        } else {
            return [
                'code' => 0,
                'msg'  => '插件实例化失败',
            ];
        }
        return [
            'code' => 1,
            'msg'  => '插件安装成功',
        ];
    }

    // 卸载插件
    public static function uninstall(string $name)
    {
        // 实例化插件
        $object = self::getInstance($name);
        // 获取插件基础信息
        $info   = self::getPluginInfo($name);
        if (false !== $object->uninstall()) {
            $info['status'] = 0;
            $info['install'] = 0;
            // 更新或创建插件的ini文件
            $result = self::setPluginIni($name, $info);
            if ($result['code'] == 0) {
                return [
                    'code' => 0,
                    'msg'  => $result['msg'],
                ];
            }
            //删除插件表信息
            return [
                'code' => 1,
                'msg'  => '插件卸载成功',
            ];
        }
        return [
            'code' => 0,
            'msg'  => '插件实例化失败',
        ];
    }

    /**
     * 获取插件信息
     * @param string $name
     * @return array|object
     */
    protected static function getPluginInfo(string $name)
    {
        $addon_info = "addon_{$name}_info";
        $addon_path =  root_path() . 'addons' .DIRECTORY_SEPARATOR. $name . DIRECTORY_SEPARATOR;

        $object = self::getInstance($name);
        // 文件属性
        $info = $object->info ?? [];
        // 文件配置
        $info_file = $addon_path . 'info.ini';
        if (is_file($info_file)) {
            $_info = parse_ini_file($info_file, true, INI_SCANNER_TYPED) ?: [];

            $_info['url'] = addons_url();
            $info = array_merge( $info,$_info);
        }
        Config::set($info, $addon_info);
        return isset($info) ? $info : [];
    }

    /**
     * 启用插件或禁用插件
     * @param string $name
     * @return array
     */
    public static function state(string $name)
    {
        $check = self::check($name);
        if ($check !== true) {
            return [
                'code' => 0,
                'msg' => $check
            ];
        }
        // 获取插件基础信息
        $info = self::getPluginInfo($name);
        if (!$info) {
            return [
                'code' => 0,
                'msg'  => '未找到该插件的信息'
            ];
        }
        // 请先安装
        if ($info['install'] != 1) {
            return [
                'code' => 0,
                'msg'  => '请先安装该插件',
            ];
        }
        return self::changeStatus($name);
    }

    /**
     * 执行插件启用/禁用插件
     * @param string $name
     * @return array
     */
    private static function changeStatus(string $name)
    {
        // 获取插件基础信息
        $info   = self::getPluginInfo($name);
        if ($info['install']==1) {
            $info['status'] = $info['status'] == 1 ? 0 : 1;
            try {
                // 更新或创建插件的ini文件
                $result = self::setPluginIni($name, $info);
                if ($result['code'] == 0) {
                    return [
                        'code' => 0,
                        'msg'  => $result['msg'],
                    ];
                }
            } catch (\Exception $e) {
                return [
                    'code' => 0,
                    'msg'  => '状态变动失败：' . $e->getMessage(),
                ];
            }
        } else {
            return [
                'code' => 0,
                'msg'  => '插件实例化失败',
            ];
        }
        return [
            'code' => 1,
            'msg'  => '状态变动成功',
        ];
    }

    // 插件进入应用插件首页
    public static function welcome(string $name)
    {
        // 实例化插件
        $object = self::getInstance($name);
        // 获取插件基础信息
        $info = self::getPluginInfo($name);
        if(!method_exists($object,'welcome')){
            return false;
        }else{
            $object->welcome();
            return true;
        }
    }

    /**
     * 判断插件配置文件是否进行了分组
     * @param array $config
     * @return bool
     */
    public static function checkConfigGroup(array $config)
    {
        // 获取第一个元素
        $arrayShift = array_shift($config);
        if (array_key_exists('title', $arrayShift) && array_key_exists('type', $arrayShift)) {
            // 未开启分组
            return false;
        } else {
            // 开启分组
            return true;
        }
    }

    /**
     * @param string $name
     * @return bool|string
     */
    private static function check(string $name)
    {
        $path = root_path() . 'addons' . DIRECTORY_SEPARATOR . $name;
        if (!is_dir( $path)) {
            return '未发现该插件,请先下载并放入到addons目录中';
        }
        return true;
    }

    /**
     * 获取插件实例
     * @param string $file
     * @return bool|object|\think\App
     */
    private static function getInstance(string $file)
    {
        $class = "\\addons\\{$file}\\Plugin";
        if (class_exists($class)) {
            // 容器类的工作由think\Container类完成，但大多数情况我们只需要通过app助手函数或者think\App类即可容器操作
            return app($class);
        }
        return false;
    }

    /**
     * 获取插件信息
     * @param string $name
     * @return array|bool|mixed
     */
    public static function loadConfig(string $name)
    {
        $check = self::check($name);
        if ($check !== true) {
            return [
                'code' => 0,
                'msg' => $check
            ];
        }
        return self::getAddonsConfig($name);
    }

    /**
     * 获取完整配置列表[config.php]
     * @param $addons
     * @return bool|mixed
     */
    protected static function getAddonsConfig($addons)
    {
        $file = root_path() . 'addons' . DIRECTORY_SEPARATOR . $addons . DIRECTORY_SEPARATOR . 'config.php';
        if (file_exists($file)) {
            return include $file;
        }
        return false;
    }

    /**
     * 更新插件的配置文件
     * @param string $name 插件名
     * @param array $array
     * @return array
     */
    private static function setPluginConfig(string $name, array $array = [])
    {
        $file =  root_path() . 'addons' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'config.php';
        if (!self::checkFileWritable($file)) {
            return [
                'code' => 0,
                'msg' => '文件没有写入权限',
            ];
        }
        if ($handle = fopen($file, 'w')) {
            fwrite($handle, "<?php\n\n" . "return " . var_export($array, TRUE) . ";\n");
            fclose($handle);
        } else {
            return [
                'code' => 0,
                'msg'  => '文件没有写入权限',
            ];
        }
        return [
            'code' => 1,
            'msg' => '文件写入完毕',
        ];
    }

    /**
     * 更新插件的ini文件
     * @param string $name 插件名
     * @param array $array
     * @return array
     */
    private static function setPluginIni(string $name, array $array = [])
    {
        $file =  root_path() . 'addons' . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'info.ini';
        if (!self::checkFileWritable($file)) {
            return [
                'code' => 0,
                'msg' => '文件没有写入权限',
            ];
        }
        // 拼接要写入的数据
        $str = '';
        foreach ($array as $k => $v) {
            $str .= $k . " = " . $v . "\n";
        }
        if ($handle = fopen($file, 'w')) {
            fwrite($handle, $str);
            fclose($handle);
        } else {
            return [
                'code' => 0,
                'msg'  => '文件没有写入权限',
            ];
        }
        return [
            'code' => 1,
            'msg' => '文件写入完毕',
        ];
    }

    /**
     * 判断文件或目录是否可写
     * @param    string $file 文件或目录
     * @return    bool
     */
    private static function checkFileWritable(string $file)
    {
        if (is_dir($file)) {
            // 判断目录是否可写
            return is_writable($file);
        } elseif (file_exists($file)) {
            // 文件存在则判断文件是否可写
            return is_writable($file);
        } else {
            // 文件不存在则判断当前目录是否可写
            $file = pathinfo($file, PATHINFO_DIRNAME);
            return is_writable($file);
        }
    }

    /**
     * 安装SQL
     * @param string $name
     * @return bool
     */
    private static function importSql(string $name)
    {
        $sqlFile =  root_path() . 'addons'. DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR . 'install.sql';
        if (is_file($sqlFile)) {
            $lines = file($sqlFile);
            $tpl = '';
            foreach ($lines as $line) {
                if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 2) == '/*')
                    continue;

                $tpl .= $line;
                if (substr(trim($line), -1, 1) == ';') {
                    // 不区分大小写替换前缀
                    $tpl = str_ireplace('__PREFIX__', Config::get('database.connections.mysql.prefix'), $tpl);
                    // 忽略数据库中已经存在的数据
                    $tpl = str_ireplace('INSERT INTO ', 'INSERT IGNORE INTO ', $tpl);
                    try {
                        Db::execute($tpl);
                    } catch (\PDOException $e) {
                        //$e->getMessage();
                        return false;
                    }
                    $tpl = '';
                }
            }
        }
        return true;
    }

    /**
     * 安装时需要复制的目录
     * @param string $name
     */
    private static function copyDir(string $name)
    {
        $addonDir =  root_path() . 'addons'. DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
        $lst = self::copyDirs;
        foreach ($lst as $k => $dir) {
            if (is_dir($addonDir . $dir)) {
                self::doCopyDir($addonDir . $dir, app()->getRootPath() . $dir);
            }
        }
    }

    /**
     * 复制文件夹到另一个文件夹
     * @param string $source 源文件夹
     * @param string $dest   目标文件夹
     */
    private static function doCopyDir($source, $dest)
    {
        if (!is_dir($dest)) {
            mkdir($dest, 0755, true);
        }
        foreach (
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            ) as $item
        ) {
            if ($item->isDir()) {
                $sontDir = $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
                if (!is_dir($sontDir)) {
                    mkdir($sontDir, 0755, true);
                }
            } else {
                copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }
}