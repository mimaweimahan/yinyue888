<?php
/**
 * Explain: 产品分类
 */
namespace app\goods\controller;
use app\common\traits\ControllerTrait;
use app\goods\model\Type as TypeModel;
use core\utils\Tools;
use think\Tree;

class Type extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new TypeModel();
    }
    use ControllerTrait;
    /**
     * 列表
     */
    public function index()
    {
        $map = [];
        $pid    = $this->request->param('pid',0,'intval');
        $keys   = $this->request->param('keys',0,'intval');
        $limit  = $this->request->param('limit',20,'intval');
        $mall   = $this->request->param('mall','','trim');
        $params = $this->request->param();
        if($this->request->isPost()){
            if($pid > 0) {
                $map['pid'] = $pid;
            }else{
                $map['pid'] = 0;
            }
            if($mall){
                $map["mall"] = $mall;
            }
            if($keys){
                $map["name"] = ["LIKE","%{$keys}%"];
            }
            $data = TypeModel::getListPage($map,$limit,['mall' => 'ASC','sort' => 'ASC', 'add_time' => 'DESC'],$params);
            return self::result_layui($data);
        }
        $this->assign("pid", $pid);
        $this->assign("limit", $limit);
        $this->assign("mall", $mall);
        return $this->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        $pid  = $this->request->param('pid',0,'intval');
        $mall = $this->request->param('mall','','trim');
        if ($this->request->isPost()) {
            $names = explode("\n", $_POST['name']);
            $data  = [];
            if($pid){
                //如果存在父级
                $data["pid"] = $pid;
            }
            if($mall){
                $data["mall"] = $mall;
            }
            $data["image"] = $this->request->param('image','');
            if(!$data["image"]){
                unset($data["image"]);
            }
            $data["add_time"] = time();
            if(empty($names)) {
                return self::error("信息不完整");
            }
            foreach ($names as $name) {
                $data["type_name"] = Tools::strSpace($name);
                if($data["type_name"]){
                    $db = TypeModel::create($data);
                    TypeModel::update(['sort'=>$db->id],['id'=>$db->id]);
                }
            }
            return self::success("添加成功！");
        }
        //获取数据
        $result = TypeModel::getList([],0,['mall' => 'ASC',"sort" => "ASC","id" => "ASC"]);
        foreach ($result as $k=>$r) {
            $result[$k]['selected'] = false;
            if($result[$k]['id'] == $pid && $pid > 0){
                $result[$k]['selected'] = 'selected';
            }
        }
        $tree = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str  = "<option value='\$id' \$selected> \$spacer \$type_name</option>";
        $tree->init($result);
        $lists= $tree->get_tree(0, $str);
        $this->assign("lists", $lists);
        $this->assign("pid",$pid);
        $this->assign("mall", $mall);
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $id = input('param.id', 0, 'intval');
        $mall = $this->request->param('mall','','trim');
        if($id == 0){
            return self::error('缺少ID');
        }
        if ($this->request->isPost()) {
            $data = input('post.');
            $data["image"] = $this->request->param('image','');
            $data['type_name'] = Tools::strSpace(input('post.name', ''));
            if(!isset( $data['name'] ) || empty( $data['name'] )) {
                return self::error("信息不完整");
            }
            if (TypeModel::update($data,['id'=>$id])) {
               return self::success("更新成功！");
            }
            return self::error('更新失败！');
        }

        $data = TypeModel::get($id)->toArray();
        if (!$data) {
            return self::error("该信息不存在！");
        }
        //获取数据
        $result = TypeModel::getList([],0,['mall' => 'ASC',"sort" => "ASC","id" => "ASC"]);
        $pid    = $data['pid'];
        foreach ($result as $k=>$r) {
            $result[$k]['selected'] = false;
            if($result[$k]['id'] == $pid && $pid > 0){
                $result[$k]['selected'] = 'selected';
            }
            $result[$k]['disabled'] = '';
            if($result[$k]['id'] == $id){
                $result[$k]['disabled'] = 'disabled = "disabled" ';
            }
        }
        $tree = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str  = "<option value='\$id' \$selected  \$disabled> \$spacer \$type_name</option>";
        $tree->init($result);
        $lists= $tree->get_tree(0, $str);
        $this->assign("lists", $lists);
        $this->assign("mall", $mall);
        $this->assign($data);
        return $this->fetch();
    }


    /**
     * 删除
     */
    public function delete()
    {
        $_ids = input('param.id/a', '');
        if (empty($_ids)) {
            return self::error("选择你要删除的信息");
        }
        if (TypeModel::whereIn('id', $_ids)->delete()) {
             TypeModel::typeCache(); // 更新分类缓存
             return self::success("操作成功！");
        }
        return self::error('执行失败');
    }

    /**
     * 更新分类缓存
     */
    public function typeCache()
    {
        TypeModel::typeCache();
        return self::success('操作成功！');
    }
}