<?php

namespace app\agent\controller\admin;

use app\agent\model\AgentAddressType;
use app\common\traits\ControllerTrait;

class Network extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new AgentAddressType();
    }
    use ControllerTrait;

    public function index() {
        $where = [];
        $params   = $this->request->param();
        $keys     = $this->request->param('keys','','trim');
        $limit    = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            if($keys){
                $where[] = ["title","LIKE","%{$keys}%"];
            }
            $data = AgentAddressType::where($where)
                ->order(['sort'=>'ASC','id'=>'desc'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        return $this->fetch();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            // 数据验证
            $title = $this->request->param('title', '','trim');
            $sort = $this->request->param('sort', 0,'intval');
            $name  = $this->request->param('name', '','trim');
            if(!$title){
                return self::error('请填写名称！');
            }
            $data = [
                'title'=>$title,
                'name'=>$name,
                'sort'=>$sort
            ];
            if (AgentAddressType::create($data)) {
                return self::success('添加成功！');
            }
            return self::error('添加失败！');
        }
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            // 数据验证
            $title = $this->request->param('title', '','trim');
            $name  = $this->request->param('name', '','trim');
            $sort  = $this->request->param('sort', 0,'intval');
            if(!$title){
                return self::error('请填写名称！');
            }
            $data = [
                'title'=>$title,
                'name'=>$name,
                'sort'=>$sort
            ];
            if ( AgentAddressType::update($data,['id'=>$id]) ) {
                return self::success('编辑成功！',$params);
            }
            return self::error('编辑失败！');
        }
        $result = AgentAddressType::getToArray(['id'=>$id]);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $this->assign($result);
        return $this->fetch();
    }

    public function delete()
    {
        $_ids =  $this->request->param('id/a', '');
        if (empty($_ids)) {
            return self::error("选择你要删除的信息");
        }
        if (AgentAddressType::whereIn('id', $_ids)->delete()) {
            return self::success("操作成功！");
        }
        return self::error('执行失败');
    }
}