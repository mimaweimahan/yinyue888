<?php
/**
 * Created by PhpStorm.
 * Explain: 文件库
 */
namespace app\admin\controller;
use think\facade\Db;
use app\admin\model\File as thisModel;
use app\admin\model\FileType;
use think\Tree;

class File extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new thisModel();
    }

    public function index() {
        $param   = $this->request->param();
        $keys    = $this->request->param('keys','');
        $type_id = $this->request->param('type_id',0,'intval');
        $limit   = $this->request->param('limit',21,'intval');
        if($this->request->isAjax()){
            $where = [];
            if($keys){
                $where[] = ['name','like',"%{$keys}%"];
            }
            if($type_id>0){
                $where[] = ['type_id','=',$type_id];
            }
            $data = thisModel::getListPage($where,$limit,["create_time"=>"DESC","id" => "DESC"],$param);
            foreach ($data['data'] as $k=>$r){
               // $data['data'][$k]['thumb'] = thumb($r['url'],100,100);
            }
            return self::result_layui($data);
        }
        $this->assign($param);
        $this->assign('keys',$keys);
        $this->assign('limit',$limit);
        $this->assign('url',url('index',$param));
        return $this->fetch();
    }

    /**
     * @return string
     */
    public function api(){
        $type_id = $this->request->param('type_id',0,'intval');
        $is_val = input('val','');
        $is_fun = input('fun','');
        $obj_id = input('obj_id','');
        $edit   = input('edit',0,'intval');
        $type   = input('type',0,'intval');
        $num    = input('num',0,'intval');
        $this->assign('is_val',$is_val);
        $this->assign('val',$is_val);
        $this->assign('is_fun',$is_fun);
        $this->assign('fun',$is_fun);
        $this->assign('obj_id',$obj_id);
        $this->assign('edit',$edit);
        $this->assign('type',$type);
        $this->assign('num',$num);
        $this->assign('type_id',$type_id);
        $type_list = FileType::getList([],0,['sort' => 'ASC', 'id' => 'DESC']);
        $type_list_json = json_encode(FileType::allData($type_id));
        $this->assign('type_list', $type_list);
        $this->assign('type_list_json', $type_list_json);
        return $this->fetch();
    }

    /**
     * 移动分类
     */
    public function move(){
        $ids = input('ids','');
        if(!$ids){
            $this->error('请选择需要移动的文件！');
        }
        $type_id = input('type_id',0,'intval');
        $status  = thisModel::update(['type_id'=>$type_id],[['id','IN',$ids]]);
        if($status){
            return self::success("操作成功！");
        }
        return self::error('执行失败');
    }

    /**
     *  删除(同时删除文件)
     * @return string
     */
    public function delete()
    {
        $_ids = input('param.id/a', '');
        $idsStr = input('param.idsStr/a', '');
        if (empty($_ids) && empty($idsStr)) {
            return self::error("选择你要删除的信息");
        }
        if(empty($_ids) && $idsStr){
            $_ids = $idsStr;
        }
        $status = [];
        if (is_array($_ids)) {
            foreach ($_ids as $id){
                $data = thisModel::get(['id'=>$id]);
                if( thisModel::destroy(['id'=>$id]) && $data ){
                    // 删除源文件
                    if($data['driver'] == 'public'){
                        $this->unlink(public_path().$data['savename']);
                    }
                }
                $status[] = $id;
            }
        }
        if (count($status)) {
            // 更新分类缓存
            return self::success("操作成功！");
        }
        return self::error('执行失败'.is_array($_ids));
    }

    /**
     * 判断文件是否存在后，删除
     * @param $path
     * @return bool
     * @author byron sampson <xiaobo.sun@qq.com>
     * @return boolean
     */
    private function unlink($path)
    {
        return is_file($path) && unlink($path);
    }

    /**
     * 获取文件分类
     */
    public function type(){
        $map = [];
        $pid    = $this->request->param('pid',0,'intval');
        $keys   = $this->request->param('keys',0,'intval');
        $limit  = $this->request->param('limit',20,'intval');
        $params = $this->request->param();
        $p_name = '';
        if($pid > 0) {
            $map['pid'] = $pid;
            $p_name = FileType::where('id',$pid)->value('type_name');
        }else{
            $map['pid'] = 0;
        }
        if($this->request->isPost()){

            if($keys){
                $map["name"] = ["LIKE","%{$keys}%"];
            }
            $data = FileType::getListPage($map,$limit,['sort' => 'ASC', 'id' => 'DESC'],$params);
            return self::result_layui($data);
        }
        $this->assign("pid", $pid);
        $this->assign("p_name", $p_name);
        $this->assign("limit", $limit);
        return $this->fetch();
    }

    /**
     * 添加分类
     */
    public function type_add(){
        $pid = $this->request->param('pid',0,'intval');
        if($this->request->isPost()){
            $names = explode("\n", $_POST['name']);
            $data  = [];
            if($pid){
                //如果存在父级
                $data["pid"] = $pid;
            }
            if(empty($names)) {
                return self::error("信息不完整");
            }
            foreach ($names as $name) {
                $data["type_name"] = self::strSpace($name);
                if($data["type_name"]){
                    $db = FileType::create($data);
                    FileType::update(['sort'=>$db->id],['id'=>$db->id]);
                }
            }
            return self::success("添加成功！");
        }
        //获取数据
        $result = FileType::getList([],0,["sort" => "ASC","id" => "ASC"]);
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
        $this->assign('type_list',$lists);
        $this->assign('pid',$pid);
        return $this->fetch();
    }

    /**
     * 过滤空格回车
     * @param string $str
     * @return mixed
     */
    public static function strSpace($str = ''){
        $str = preg_replace("/ /","",$str);
        $str = preg_replace("/&nbsp;/","",$str);
        $str = preg_replace("/　/","",$str);
        $str = preg_replace("/\r\n/","",$str);
        $str = str_replace(chr(13),"",$str);
        $str = str_replace(chr(10),"",$str);
        $str = str_replace(chr(9),"",$str);
        return $str;
    }

    /**
     * 编辑分类
     */
    public function type_edit()
    {
        $id = $this->request->param('id',0,'intval');
        if($id == 0){
            return self::error('缺少ID');
        }
        if($this->request->isPost()){
            $name = $this->request->param('name','','trim');
            $pid  = $this->request->param('pid',0,'intval');
            if(!$name){
                return self::error('请填写分类名称');
            }
            $_return = FileType::update(['type_name'=>$name,'pid'=>$pid],['id'=>$id]);
            if($_return){
                return self::error('更新成功');
            }
            return self::error('更新失败');
        }

        $data = FileType::getToArray($id);
        if (!$data) {
            return self::error("该信息不存在！");
        }
        //获取数据
        $result = FileType::getList([],0,["sort" => "ASC","id" => "ASC"]);
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
        $this->assign('type_list',$lists);
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 删除分类
     */
    public function type_delete()
    {
        $_ids = input('param.id/a', '');

        if (empty($_ids)) {
            return self::error("选择你要删除的信息");
        }

        if (is_array($_ids)) {
            $_ids = arr2str($_ids);
        }

        $status = Db::name('file_type')->where(['id' => ['in', $_ids]])->delete();
        if ($status) {
            return self::success("操作成功！");
        }
        return self::error('执行失败');
    }

    /**
     * 排序
     */
    public function type_sort()
    {
        if ($this->request->isPost()) {
            if(isset($_POST['sort'])){
                foreach ($_POST['sort'] as $id => $sort) {
                    $this->model->update(['sort'=>$sort],['id'=>$id]);
                }
            }
            return self::success('操作成功！');
        }
        return self::error("选择你要更新的信息");
    }
}