<?php
namespace app\common\traits;
/**
 * Explain: 公用控制器继承
 */
use think\App;
use app\common\service\Rule;
trait ControllerTrait
{
    protected $model;
    protected $pk='id';

    public function init(){ }

    public function index(){
        $params = $this->request->param();
        if($this->request->isAjax()){
            $list = $this->model->getListPage([],20,[$this->pk=>'desc'],$params);
            return self::result_layui($list);
        }
        $this->assign($params);
        $this->assign('url',url('index',$params));
        return $this->fetch();
    }
    /**
     * 获取纸目录
     * @return mixed
     */
    public function getSubNav(){
        $rule = $this->request->param('rule');
        $data = Rule::subNav($rule);
        return self::result_layui($data);
    }

    /**
     * 列表
     */
    public function lists(){
        try {
            $pk    = $this->model->getPk();
            $limit = $this->request->param('limit', 20, 'intval');
            $params = $this->request->param();
            if(isset($params['page'])){
                unset($params['page']);
            }
            if(isset($params['limit'])){
                unset($params['limit']);
            }
            if(isset($params['order'])){
                unset($params['order']);
            }
            if(isset($params['where'])){
                unset($params['where']);
            }
            $where = [];
            if(count($params)){
                $where = $params;
            }
            $order = $this->request->param('order',["sort" => "ASC", $pk => "ASC"]);
            $data  = $this->model->where($where)->order($order)->paginate(['list_rows' => $limit,'query' => $this->request->param()], false)->toArray();
            return self::result_layui($data);
        } catch(\Exception $e) {
            return self::result_layui([],'错误');
        }

    }

    /**
     * 新增
     * @return mixed
     */
    public function add(){
        $param = $this->request->param();
        if( $this->request->isPost() ){
            //验证数据
            $validate = validate($this->model->getName(),[],false,false);
            if( !$validate->check($param) ){
                return self::error($validate->getError());
            }
            if($this->model->create($param)){
                return self::success('新增成功！');
            }
            return self::error('新增失败！');
        }
        $this->assign($param);
        return $this->fetch();
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit(){
        $id = $this->request->param('id', 0, 'intval');
        if($id == 0){
            return self::error('缺少ID');
        }
        $pk = $this->model->getPk();
        if( $this->request->isPost() ){
            $data = $this->request->param();
            //验证数据
            $validate = validate($this->model->getName(),[],false,false);
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            if($this->model->update($data,[$pk=>$id])){
                return self::success('更新成功！');
            }
            return self::error('更新失败！');
        }
        //查询改条信息
        $data = $this->model->get([$pk=>$id]);
        if(!$data){
            return self::error('信息不存在！');
        }
        $param = $this->request->param();
        $this->assign($param);

        $data = $data->toArray();
        $this->assign('data',$data);
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
        $pk = $this->model->getPk();
        if ($this->model->whereIn($pk, $_ids)->delete()) {
            return self::success("操作成功");
        }
        return self::error('操作失败');
    }

    /**
     * 状态设置
     */
    public function status()
    {
        $_ids = input('param.id/a', '');
        $val  = input('param.val', 0, 'intval');
        if (empty($_ids)) {
            return self::error("选择你要设置的信息");
        }
        $pk = $this->model->getPk();
        if ( $this->model->whereIn($pk, $_ids)->update(['status'=>$val]) ) {
            return self::success("操作成功");
        }
        return self::error('操作失败');
    }

    /**
     * 状态设置
     */
    public function setField()
    {
        $_ids  = input('param.id/a', '');
        $val   = input('param.val', '', 'trim');
        $field = input('param.field', '', 'trim');
        if(is_numeric($val)){
            $val= intval($val);
        }
        if(!$field){
            return self::error("缺少参数");
        }
        if (empty($_ids)) {
            return self::error("选择你要设置的信息");
        }
        $pk  = $this->model->getPk();
        if ( $this->model->whereIn($pk,$_ids)->update([$field=>$val]) ) {
            return self::success("操作成功");
        }
        return self::error('操作失败');
    }

    /**
     * 排序
     */
    public function sort()
    {
        $pk = $this->model->getPk();
        if ($this->request->isPost()) {
            if(isset($_POST['sort'])){
                foreach ($_POST['sort'] as $id => $sort) {
                    $this->model->update(['sort'=>$sort],[$pk=>$id]);
                }
            }
            return self::success('操作成功！');
        }
        return self::error("选择你要更新的信息");
    }
}