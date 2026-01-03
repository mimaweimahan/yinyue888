<?php
/**
 * Explain: 模块管理
 */
namespace app\admin\controller;
use app\admin\model\Module as thisModel;
use think\Module as ModuleLogic;
use think\facade\Db;
use app\common\traits\ControllerTrait;
class Module extends \app\AdminInit
{
    protected $module = '';
    // 系统模块，隐藏
    protected $systemModuleList = array('api', 'install','pay','tool','jobs', 'common', 'extra', 'addons', 'admin', 'index');
    // 模块所处目录路径
    protected $appPath = '';
    // 已安装模块列表
    protected $moduleList = array();
    protected $model;
    // 初始化
    public function initialize()
    {
        parent::initialize();
        # 初始化模块安装逻辑
        $this->module  = new ModuleLogic();
        $this->model   = new thisModel();
        $this->appPath = base_path();
    }
    use ControllerTrait;
    //卸载及停用已安装模块
    public function index() {
        $params = $this->request->param();
        $page   = $this->request->param('page',0,'intval');
        if($this->request->isAjax()){
            $dirs_arr   = $this->modules_arr();
            $moduleList = [];
            if($dirs_arr){
                //把一个数组分割为新的数组块
                $dirs_arr = array_chunk($dirs_arr, 10, true);
                //当前分页
                $_page = max($page,1);
                //根据分页取到对应的模块列表数据
                $directory = $dirs_arr[intval($_page - 1)];
                foreach ($directory as $r) {
                    if(isset($r['install_time']) && $r['install_time']){
                        $r['install_time'] = date('Y-m-d',$r['install_time']);
                    }
                    $moduleList[$r['module']] = $r;
                }
            }
            return self::result_layui($moduleList);
        }
        $this->assign($params);
        $this->assign('url',url('index',$params));
        return $this->fetch();
    }

    /**
     * 安装模块列表
     */
    public function modules(){
        $data = thisModel::getList([]);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 取得模块的配置数据
     */
    private function modules_arr(){
        //取得模块目录名称
        $dirs     = glob($this->appPath . '*');
        $dirs_arr = $moduleList = array();
        foreach ($dirs as $path) {
            if (is_dir($path)) {
                //目录名称
                $path = basename($path);
                //系统模块及已经安装的模块隐藏
                if (in_array($path, $this->systemModuleList)) {
                    continue;
                }
                $dirs_arr[] = $path;
            }
        }
        //取得已安装模块列表
        $this->moduleList = thisModel::getList([]);
        $install_module   = [];
        foreach($this->moduleList as $r){
            $install_module[$r['module']] = $r;
        }
        foreach ($dirs_arr as $module) {
            $data = $this->module->config($module);
            if(isset($install_module[$module]) && $install_module[$module]){
                $data = $install_module[$module];
            }
            $moduleList[$module] = $data;
        }
        return $moduleList;
    }
    /**
     * 模块商店 未安装的模块
     */
    public function shop() {
        //取得模块目录名称
       if($this->request->isAjax()){
            $dirs = glob($this->appPath . '*');
            $dirs_arr = array();
            foreach ($dirs as $path) {
                if (is_dir($path)) {
                    //目录名称
                    $path = basename($path);
                    //取得已安装模块列表
                    $this->moduleList = Db::name('module')->field('module')->select();
                    $install_module  = array();
                    foreach($this->moduleList as $r){
                        $install_module[] = $r['module'];
                    }
                    //系统模块及已经安装的模块隐藏
                    if (in_array($path, $this->systemModuleList)||in_array($path, $install_module)) {
                        continue;
                    }
                    $dirs_arr[] = $path;
                }
            }
            $moduleList = array();
            if($dirs_arr){
                //把一个数组分割为新的数组块
                $dirs_arr = array_chunk($dirs_arr, 10, true);
                //当前分页
                $page = max(input('get.page', 0, 'intval'),1);
                //根据分页取到对应的模块列表数据
                $directory = $dirs_arr[intval($page - 1)];
                foreach ($directory as $module) {
                    $data = $this->module->config($module);
                    $install_time = thisModel::where(['module'=>$module])->value('install_time');
                    $data['install_time'] = $install_time?date('Y-m-d',$data['install_time']):'未安装';
                    $moduleList[$module] = $data;
                }
            }
            return self::result_layui($moduleList);
        }
        $this->assign('url',url('shop'));
        return $this->fetch();
    }

    /**
     * 安装模块
     */
    public function install() {
        if ($this->request->isPost()) {
            $post = input('post.');
            $module = $post['module'];
            if (empty($module)) {
                return self::error('请选择需要安装的模块！');
            }
            if ($this->module->install($module)) {
                thisModel::module_cache();//更新缓存
                return self::success('模块安装成功！', url('admin/Module/modules'));
            }
            $error = $this->module->error;
            return self::error($error ? $error : '模块安装失败！');
        }
        $module = input('module', '', 'trim');
        if (empty($module)) {
            return self::error('请选择需要安装的模块！'.$module);
        }
        //检查是否已经安装过
        if ($this->module->isInstall($module) !== false) {
            return self::error('该模块已经安装！');
        }
        $config = $this->module->config($module);
        //版本检查
        if ( isset($config['adaptation']) && $config['adaptation'] ) {
            $version = version_compare(2.0, $config['adaptation'], '>=');
            $this->assign('version', $version);
        }
        $this->assign('config', $config);
        return $this->fetch();
    }

    // 模块卸载
    public function uninstall() {
        $module = input('get.module', '', 'trim');
        if (empty($module)) {
            return self::error('请选择需要安装的模块！');
        }
        if ($this->module->uninstall($module)) {
            // 更新缓存
            thisModel::module_cache();
            return self::success("模块卸载成功！");
        }
        $error = $this->module->error;
        return self::error($error ? $error : "模块卸载失败！");
    }
    //清除模块缓存
    function public_cache(){
        thisModel::module_cache();
        $this->success("更新成功！");
    }
}