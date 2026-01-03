<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 菜单节点（权限）
 */
namespace app\admin\controller;
use app\common\traits\ControllerTrait;
use app\admin\model\AuthRule;
use think\Tree;
class Rule extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new AuthRule();
    }
    use ControllerTrait;
    public function index()
    {
        $pid = input('get.pid', 0, 'intval');
        $url = url('lists', ['pid'=>$pid] );
        $this->assign('pid',$pid);
        $this->assign('url',$url);
        return $this->fetch();
    }

    /**
     * 添加
     * @return string
     * @throws \Exception
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->param();
            if(isset($param['name'])){
                $rule  = explode('/',$param['name']);
                $param['module'] = $rule[0];
            }else{
                return self::error('请填写权限规则');
            }
            // 数据验证
            $validate = validate('AuthRule',[],false,false);
            if (!$validate->check($param)) {
                return self::error($validate->getError());
            }
            $param['name'] = strtolower($param['name']);
            $all_add = $param['all_add'];
            unset($param['all_add']);
            if ($_pid = AuthRule::insertGetId($param)) {
                if( $all_add ==1 ){
                    $data=[
                        //['title'=>'列表','module'=>$param['module'],'name'=>strtolower($param['module'].'/'.$rule[1].'/index'),'type'=>1,'show'=>1,'pid'=>$_pid],
                        ['title'=>'新增','module'=>$param['module'],'name'=>strtolower($param['module'].'/'.$rule[1].'/add'),'type'=>1,'show'=>0,'pid'=>$_pid],
                        ['title'=>'编辑','module'=>$param['module'],'name'=>strtolower($param['module'].'/'.$rule[1].'/edit'),'type'=>1,'show'=>0,'pid'=>$_pid],
                        ['title'=>'删除','module'=>$param['module'],'name'=>strtolower($param['module'].'/'.$rule[1].'/delete'),'type'=>1,'show'=>0,'pid'=>$_pid],
                        ['title'=>'状态设置','module'=>$param['module'],'name'=>strtolower($param['module'].'/'.$rule[1].'/status'),'type'=>1,'show'=>0,'pid'=>$_pid],
                        ['title'=>'排序','module'=>$param['module'],'name'=>strtolower($param['module'].'/'.$rule[1].'/sort'),'type'=>1,'show'=>0,'pid'=>$_pid]
                    ];
                    AuthRule::insertAll($data);
                }
                return self::success("添加成功！");
            }
            return self::error('添加失败');
        }

        $pid    = $this->request->get('pid', 0, 'intval');
        $result = AuthRule::getList('',0,["sort" => "ASC", "id" => "ASC"]);
        foreach ($result as $k => $r) {
            $result[$k]['selected'] = false;
            if ($result[$k]['id'] == $pid && $pid > 0) {
                $result[$k]['selected'] = 'selected';
            }
        }

        // 实现层级关系下拉选择
        $tree = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ', '&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str = "<option value='\$id' \$selected> \$spacer \$title</option>";
        $tree->init($result);
        $list = $tree->get_tree(0, $str);
        $this->assign("list", $list);
        $this->assign("pid", $pid);
        return $this->fetch();
    }

    /**
     * 编辑
     * @return string
     * @throws \Exception
     */
    public function edit()
    {
        $id = input('param.id', 0, 'intval');
        if ($id == 0) {
            $this->error('缺少id！');
        }

        if ($this->request->isPost()) {
            $param = $this->request->param();
            if(isset($param['name'])){
                $rule = explode('/',$param['name']);
                $param['module'] = $rule[0];
            }
            // 数据验证
            $validate = validate('AuthRule');
            if (!$validate->check($param)) {
                $this->error($validate->getError());
            }
            $param['name'] = strtolower($param['name']);
            if (AuthRule::update($param, ['id' => $id])) {
                return self::success("更新成功！");
            }
            return self::error('更新失败');
        }

        $data = AuthRule::get(['id'=>$id]);
        if (!$data) {
            return self::error("该信息不存在！");
        }
        $data = $data->toArray();
        // 获取数据
        $result = AuthRule::getList('',0,["sort" => "ASC", "id" => "ASC"]);
        $pid = $data['pid'];
        foreach ($result as $k => $r) {
            $result[$k]['selected'] = false;
            if ($result[$k]['id'] == $pid && $pid > 0) {
                $result[$k]['selected'] = 'selected';
            }
            $result[$k]['disabled'] = '';
            if ($result[$k]['id'] == $id) {
                $result[$k]['disabled'] = 'disabled = "disabled" ';
            }
        }
        $tree = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ', '&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str = "<option value='\$id' \$selected  \$disabled> \$spacer \$title</option>";
        $tree->init($result);
        $list = $tree->get_tree(0, $str);
        $this->assign("list", $list);
        $this->assign($data);
        return $this->fetch();
    }

    public function icon(){
        $id = input('param.id', 0, 'intval');
        if ($this->request->isPost()) {
            $icon = input('post.icon', '');
            if ($id == 0) {
                return self::error('缺少ID');
            }
            if (empty($icon)) {
                return self::error('缺少图标');
            }
            $icon = str_replace('&amp;', '', $icon);
            $icon = str_replace('&', '', $icon);
            if(AuthRule::update(['icon'=>$icon],['id'=>$id])){
                return self::success('设置成功');
            }
            return self::error('设置失败');
        }
        $this->assign("id", $id);
        return $this->fetch();
    }
}