<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 角色岗位 
 */
namespace app\admin\controller;
use app\Admin;
use think\Tree;
use app\common\traits\ControllerTrait;
use app\admin\model\Group as GroupModel;
use think\facade\Db;
use app\admin\model\AuthRule;
class Group extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new GroupModel();
    }
    use ControllerTrait;
    /**
     * 列表
     */
    public function index()
    {
        $params = $this->request->param();
        $where = [];
        $pid = input('get.pid', 0, 'intval');
        $where['pid'] = $pid;
        if($this->request->isAjax()){
            $data = GroupModel::getList($where,20,'sort asc,id desc');
            return self::result_layui($data);
        }
        $this->assign($params);
        $this->assign('url',url('index',$params));
        return $this->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $param = $this->request->post();
            // 数据验证
            $validate = validate('Group',[],false,false);
            if (!$validate->check($param)) {
                return self::error($validate->getError());
            }
            if (GroupModel::create($param)) {
                return self::success("添加成功！");
            }
            return self::error('添加失败');

        } else {
            // 获取数据
            $pid    = input('get.pid', 0, 'intval');
            $result = GroupModel::getList('',0,["sort" => "ASC", "id" => "ASC"]);
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
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $id = input('param.id', 0, 'intval');
        if ($id == 0) {
            $this->error('缺少id！');
        }
        if (request()->isPost()) {
            $param = $this->request->param();
            // 数据验证
            $validate = validate('Group');
            if (!$validate->check($param)) {
                return self::error($validate->getError());
            }
            if (GroupModel::update($param, ['id' => $id])) {
                return self::success("更新成功！");
            }
        } else {
            $data = GroupModel::get(['id'=>$id]);
            if (!$data) {
                return self::error("该信息不存在！");
            }
            $data = $data->toArray();

            // 获取数据
            $result = GroupModel::getList('',0,["sort" => "ASC", "id" => "ASC"]);
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
    }

    /**
     * 权限设置
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function auth()
    {
        $id = input('param.id', 0, 'intval');
        if ($id == 0) {
            return self::error("缺少岗位ID");
        }
        if (request()->isPost()) {
            $rules = $_POST['ids'];
            if ($rules) {
                $rules = arr2str($rules);
                GroupModel::update(['rules'=>$rules],['id'=>$id]);
                return self::success('设置成功！');
            }
            return self::error("没有选择任何权限！");
        }
        $rule_ids = GroupModel::where(["id"=>$id])->value("rules");
        $data = AuthRule::allData($rule_ids);
        $this->assign('data',json_encode($data));
        $this->assign('id',$id);
        return $this->fetch();
    }

}