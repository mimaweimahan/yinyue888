<?php

namespace app\admin\controller;

use app\common\model\Event as EventModel;
use app\common\traits\ControllerTrait;

class Event extends \app\AdminInit
{
    protected $model;
    
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new EventModel();
    }
    
    use ControllerTrait;

    /**
     * 事件列表
     * @return string|\think\response\Json
     */
    public function index() {
        $params   = $this->request->param();
        $limit    = $this->request->param('limit',20,'intval');
        
        if($this->request->isAjax()){
            $data = EventModel::order(['id'=>'desc'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();
            
            return self::result_layui($data);
        }
        
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        return $this->fetch();
    }

    /**
     * 添加事件
     * @return mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            // 数据验证
            $content = $this->request->param('content', '','trim');

            if(!$content){
                return self::error('请填写事件内容！');
            }
            
            $data = [
                'content'=>$content
            ];
            
            $result = EventModel::create($data);
            if($result){
                return self::success('添加成功！');
            }
            return self::error('添加失败！');
        }
        
        $data = [
            'content'=>''
        ];
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 编辑事件
     * @return mixed
     */
    public function edit()
    {
        $id = $this->request->param('id', 0,'intval');
        if(!$id){
            return self::error('参数错误！');
        }
        
        if ($this->request->isPost()) {
            // 数据验证
            $content = $this->request->param('content', '','trim');

            if(!$content){
                return self::error('请填写事件内容！');
            }
            
            $data = [
                'content'=>$content
            ];
            
            $result = EventModel::where('id', $id)->update($data);
            if($result){
                return self::success('修改成功！');
            }
            return self::error('修改失败！');
        }
        
        $data = EventModel::getToArray(['id'=>$id]);
        if(!$data){
            return self::error('事件不存在！');
        }
        $data['id'] = $id; // 确保传递 id
        $this->assign($data);
        return $this->fetch('add');
    }

    /**
     * 删除事件
     * @return mixed
     */
    public function del()
    {
        $id = $this->request->param('id', 0,'intval');
        $ids = $this->request->param('ids', []);
        
        // 支持批量删除
        if(!empty($ids) && is_array($ids)){
            $result = EventModel::destroy($ids);
            if($result){
                return self::success('批量删除成功！');
            }
            return self::error('批量删除失败！');
        }
        
        if(!$id){
            return self::error('参数错误！');
        }
        
        $result = EventModel::destroy($id);
        if($result){
            return self::success('删除成功！');
        }
        return self::error('删除失败！');
    }
}

