<?php
/**
 * Created by PhpStorm.
 * Explain: 模块安装逻辑处理
 */
namespace think;
use app\admin\model\Module as ModuleModel;
use app\admin\model\AuthRule;
use think\facade\Db;
use think\Dir;
class Module
{
    // 应用模块目录
    protected $appPath = '';
    // 模板目录
    protected $templatePath ;
    // 静态资源目录
    protected $extresPath;
    // 错误信息
    public $error = '';
    // 插件配置
    protected $config = array();
    // 当前模块名称
    protected $moduleName = '';

    public function __construct()
    {
        $this->appPath = base_path();
        $this->extresPath = public_path().'statics/extend/';
        $this->templatePath = public_path().'template/';
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 设置当前模块名称
     * @param string $name 模块名
     * @return $this
     */
    public function setName($name = '')
    {
        $this->moduleName = $name;
        return $this;
    }

    /**
     * 获取模块缓存
     */
    public static function module_cache(){
        $module_list = cache('Module');
        if(!$module_list || !is_array($module_list)){
            $module_list = ModuleModel::module_cache();
        }
        if(is_array($module_list)){
            return $module_list;
        }
        return false;
    }


    /**
     * 获取模块基本配置信息
     */
    public function config($moduleName = '')
    {
        if (!empty($this->config) && empty($moduleName)) {
            return $this->config;
        }
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        $config = array(
            // 模块目录
            'module' => $moduleName,
            // 模块名称
            'module_name' => $moduleName,
            // 管理入口
            'admin_url' => '',
            // 全端访问入口
            'web_url' => '',
            // 图标地址
            'icon' => '',
            'is_core'=>0,// 内置模块1是0否
            // 模块简介
            'introduce' => '',
            // 模块作者
            'author' => '',
            'version' => '',
            // 依赖模块
            'depend' => [],
            // 模块配置
            'setting' => []
        );
        // 加载安装配置文件
        if (file_exists($this->appPath . $moduleName . '/install.config.php')) {
            // 加载
            try {
                $moduleConfig = include $this->appPath . $moduleName . '/install.config.php';
                $config = array_merge($config, $moduleConfig);
            } catch (\Exception $exc) {}
        }
        // 检查是否安装，如果安装了，加载模块安装后的相关配置信息
        if ($this->isInstall($moduleName)) {
            $moduleList = self::module_cache();
            if(is_array($moduleList) && count($moduleList) > 0){
                unset($config['icon']);
                unset($config['setting']);
                $config = array_merge($moduleList[$moduleName], $config);
            }
        }
        $this->config = $config;
        return $config;
    }

    /**
     * 是否已经安装
     */
    public function isInstall($moduleName = '')
    {
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        $moduleList = self::module_cache();
        return (isset($moduleList[$moduleName]) && $moduleList[$moduleName]) ? true : false;
    }


    /**
     * 执行模块安装
     */
    public function install($moduleName = '')
    {
        defined('install') or define("INSTALL", true);
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '请选择需要安装的模块！';
                return false;
            }
        }
        // 已安装模块列表
        $moduleList = self::module_cache();
        // 设置脚本最大执行时间
        set_time_limit(0);
        if ($this->competence($moduleName) !== true) {
            return false;
        }
        // 加载模块基本配置
        $config = $this->config($moduleName);
        // 依赖模块检测
        if (!empty($config['depend']) && is_array($config['depend'])) {
            foreach ($config['depend'] as $mod) {
                if (!isset($moduleList[$mod])) {
                    $this->error = "安装该模块，需要安装依赖模块 {$mod} !";
                    return false;
                }
            }
        }

        // 检查模块是否已经安装
        if ($this->isInstall($moduleName)) {
            $this->error = '该模块已经安装，无法重复安装！';
            return false;
        }

        $model = new ModuleModel();
        // 启动事务
        $model->startTrans();
        try{
            // 数据验证
            $validate = validate('Module',[],false,false);
            if (!$validate->check($config)) {
                $this->error = $validate->getError();
                return false;
            }
            //01写入模块表
            if(isset($config['setting']) && $config['setting']){
                $config['setting'] = serialize($config['setting']);
            }
            unset($config['depend']);
            $config['install_time'] = time();
            $config['update_time']  = time();

            if ( !ModuleModel::create($config) ) {
                $this->error = '安装失败！';
                return false;
            }
            //02执行安装脚本
            if (!$this->runInstallScript($moduleName)) {
                $this->installRollback($moduleName);
                return false;
            }
            //03执行数据库脚本安装
            $this->runSQL($moduleName);

            //04执行菜单项安装
            if ($this->installMenu($moduleName) !== true) {
                $this->installRollback($moduleName);
                return false;
            }
            // 提交事务
            $model->commit();
        } catch (\Exception $e) {
            // 回滚事务
            $this->error = '安装失败！';
            $model->rollback();
            return false;
        }

        $Dir = new Dir('');
        // 前台模板
        if (file_exists($this->appPath . "{$moduleName}/install/template/")) {
            //拷贝模板到前台模板目录中去
            $Dir->copyDir($this->appPath . "{$moduleName}/install/template/", $this->templatePath);
        }

        // 静态资源文件
        if (file_exists($this->appPath . "{$moduleName}/install/extend/")) {
            // 拷贝模板到前台模板目录中去
            $Dir->copyDir($this->appPath . "{$moduleName}/install/extend/", $this->extresPath . strtolower($moduleName) . '/');
        }
        // 安装结束，最后调用安装脚本完成
        $this->runInstallScriptEnd($moduleName);
        // 清除缓存
        cache('Module', NULL);
        return true;
    }

    /**
     * 模块卸载
     */
    public function uninstall($moduleName = '')
    {
        defined('uninstall') or define("UNINSTALL", true);
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '请选择需要卸载的模块！';
                return false;
            }
        }
        // 设置脚本最大执行时间
        set_time_limit(0);
        if ($this->competence($moduleName) !== true) {
            return false;
        }

        $model = new ModuleModel();
        // 取得该模块数据库中记录的安装信息
        $info = $model->where(['module'=>$moduleName])->find();
        if (empty($info)) {
            $this->error = '该模块未安装，无需卸载！';
            return false;
        }
        if (isset($info['is_core']) && $info['is_core']) {
            $this->error = '内置模块，不能卸载！';
            return false;
        }
        // 删除模块表中数据
        if ($model->where(['module'=>$moduleName])->delete() == false) {
            $this->error = '卸载失败！';
            return false;
        }
        // 移除菜单项和权限项
        AuthRule::destroy(['module'=>$moduleName]);

        // 删除菜单项
        $this->uninstallMenu($moduleName);

        // 执行卸载脚本
        if (!$this->runInstallScript($moduleName, 'uninstall')) {
            $this->installRollback($moduleName);
            return false;
        }

        // 执行数据库脚本安装
        $this->runSQL($moduleName, 'uninstall');
        $Dir = new Dir('');

        // 删除模块前台模板
        $Dir->delDir($this->templatePath . $moduleName . DIRECTORY_SEPARATOR);

        // 静态资源移除
        $Dir->delDir($this->extresPath . strtolower($moduleName) . DIRECTORY_SEPARATOR);

        // 卸载结束，最后调用卸载脚本完成
        $this->runInstallScriptEnd($moduleName, 'uninstall');
        // 删除缓存
        cache('Module', NULL);
        return true;
    }

    /**
     * 目录权限检查
     * @param string $moduleName 模块名称
     * @return bool
     */
    public function competence($moduleName = '')
    {
        // 模板目录权限检测
        if ($this->chechmod($this->templatePath) == false) {
            $this->error = '目录 ' . $this->templatePath . ' 没有可写权限！';
            return false;
        }

        if ($moduleName && file_exists($this->extresPath . $moduleName)) {
            if ($this->chechmod($this->extresPath . $moduleName) == false) {
                $this->error = '目录 ' . $this->extresPath . $moduleName . ' 没有可写权限！';
                return false;
            }
        }

        // 静态资源目录权限检测
        if (!file_exists($this->extresPath)) {
            // 创建目录
            if (mkdir($this->extresPath, 0777, true) == false) {
                $this->error = '目录 ' . $this->extresPath . ' 创建失败，请检查是否有可写权限！';
                return false;
            }
        }

        // 权限检测
        if ($this->chechmod($this->extresPath) == false) {
            $this->error = '目录 ' . $this->extresPath . ' 没有可写权限！';
            return false;
        }
        return true;
    }

    /**
     * 检查对应目录是否有相应的权限
     * @param  string $path 目录地址
     * @return boolean
     */
    protected function chechmod($path = '')
    {
        //检查模板文件夹是否有可写权限 TEMPLATE_PATH
        $tfile = "_test.txt";
        $fp = @fopen($path . $tfile, "w");
        if (!$fp) {
            return false;
        }
        fclose($fp);
        $rs = @unlink($path . $tfile);
        if (!$rs) {
            return false;
        }
        return true;
    }

    /**
     * 卸载菜单项项
     * @param string $moduleName
     * @return boolean
     */
    private function uninstallMenu($moduleName = '')
    {
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        AuthRule::destroy(['module'=>$moduleName]);
        return true;
    }

    /**
     * 安装菜单项
     * @param string $moduleName 模块名称
     * @param string $file 文件
     * @return boolean
     */
    private function installMenu($moduleName = '', $file = 'Menu')
    {
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        $path = $this->appPath . "{$moduleName}/install/{$file}.php";
        //检查是否有安装脚本
        if (!file_exists($path)) {
            return true;
        }

        $menu = include $path;
        if (empty($menu)) {
            return true;
        }

        $auth = new AuthRule();
        $status = $auth->installModule($menu, $moduleName);

        if ($status === true) {
            return true;
        } else {
            $this->error = $auth->error ?: '安装菜单项出现错误！';
            return false;
        }

    }

    /**
     * 执行安装脚本
     * @param string $moduleName 模块名(目录名)
     * @param string $Dir
     * @return bool
     */
    private function runInstallScript($moduleName = '', $Dir = 'install')
    {
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        //检查是否有安装脚本
        if (file_exists($this->appPath . "{$moduleName}/{$Dir}/{$Dir}.class.php") !== true) {
            return true;
        }

        // 文件目录名称
        $className = "\\{$moduleName}\\{$Dir}\\{$Dir}";
        // TODO 用行为来实现
        return true;
    }

    /**
     * 执行安装脚本
     * @param string $moduleName 模块名(目录名)
     * @param string $Dir
     * @return bool
     */
    private function runInstallScriptEnd($moduleName = '', $Dir = 'install')
    {
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        //检查是否有安装脚本
        if (file_exists($this->appPath . "{$moduleName}/{$Dir}/{$Dir}.class.php") !== true) {
            return true;
        }
        $className = "\\{$moduleName}\\{$Dir}\\{$Dir}";
        return true;
    }

    /**
     * 执行安装数据库脚本
     * @param string $moduleName 模块名(目录名)
     * @param string $Dir
     * @return bool
     */
    private function runSQL($moduleName = '', $Dir = 'install')
    {
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        $path = $this->appPath . "{$moduleName}/{$Dir}/{$moduleName}.sql";
        if (!file_exists($path)) {
            return true;
        }
        $sql = file_get_contents($path);

        $sql = $this->resolveSQL($sql, config("database.prefix"));
        if (!empty($sql) && is_array($sql)) {
            foreach ($sql as $sql_split) {
                if (trim($sql_split)) {
                    Db::execute($sql_split);
                }
            }
        }
        return true;
    }

    /**
     * 安装回滚
     * @param string $moduleName 模块名(目录名)
     * @return bool
     */
    private function installRollback($moduleName = '')
    {
        if (empty($moduleName)) {
            if ($this->moduleName) {
                $moduleName = $this->moduleName;
            } else {
                $this->error = '模块名称不能为空！';
                return false;
            }
        }
        //删除安装状态
        ModuleModel::destroy(['module'=>$moduleName]);
        //更新缓存
        cache('Module', NULL);
    }

    /**
     * 分析处理sql语句，执行替换前缀都功能。
     * @param string $sql 原始的sql
     * @param string $tablepre 表前缀
     * @return array
     */
    private function resolveSQL($sql = '', $tablepre = '')
    {
        if ($tablepre && $tablepre != "tp_") {
            $sql = str_replace("tp_", $tablepre, $sql);
        }
        $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=utf8", $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $sql) {
                $str1 = substr($sql, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $sql;
            }
            $num++;
        }
        return $ret;
    }
}