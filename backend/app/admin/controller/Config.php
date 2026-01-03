<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 系统配置
 */
namespace app\admin\controller;
use app\common\traits\ControllerTrait;
use app\admin\model\Config as Cfg;
class Config extends \app\AdminInit
{
    protected $model;
    protected function initialize(){
        parent::initialize();
        $this->model = new Cfg();
        $this->assign('config_group_list',$this->config['config_group_list']);
        $this->assign('config_type_list',$this->config['config_type_list']);
    }
    use ControllerTrait;

    /**
     *  系统配置
     */
    public function index(){
        $where = [];
        $id    = input('get.id', 1, 'intval');
        $where['group'] = $id;
        $lists = Cfg::getList($where,100,'sort asc,id desc');
        $this->assign('id',$id);
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    /**
     * 配置管理
     */
    public function config() {
        $param = $this->request->param();
        $id    = $this->request->param('id',0,'intval');
        $limit = $this->request->param('limit',20,'intval');
        if($this->request->isAjax()){
            $where = [];
            if($id > 0){
                $where['group'] = $id;
            }
            $key = $this->request->param('key','','string');
            if(isset($key) && $key){
                $where['name'] = ['like', '%'.$key.'%'];
            }
            $result = Cfg::getListPage($where,$limit,'sort asc,id desc',$param);

            foreach ($result['data'] as $k=>$r){
                $result['data'][$k]['type'] = get_config_type($r['type']);
                $result['data'][$k]['group'] = get_config_group($r['group']);
            }
            return self::result_layui($result);
        }
        $this->assign('config_group_list',get_config_group());
        $this->assign('limit',$limit);
        $this->assign('url',url('config',['id'=>$id]));
        $this->assign('id',$id);
        return $this->fetch();
    }

    /**
     * 保存配置
     */
    public function save(){
        $config = $this->request->post('config/a');
        if($config && is_array($config)){
            foreach ($config as $name => $value) {
                Cfg::update(['value'=>$value],['name'=>$name]);
            }
            return self::success('更新成功');
        }
        return self::error('更新失败');
    }
}