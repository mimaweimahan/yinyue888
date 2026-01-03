<?php

namespace app\admin\controller;

use app\common\model\Notice as NoticeModel;
use app\common\traits\ControllerTrait;

class Notice extends \app\AdminInit
{
    protected $model;
    
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new NoticeModel();
    }
    
    use ControllerTrait;

    /**
     * 公告列表
     * @return string|\think\response\Json
     */
    public function index() {
        $where = [];
        $params   = $this->request->param();
        $keys     = $this->request->param('keys','','trim');
        $limit    = $this->request->param('limit',20,'intval');
        
        if($this->request->isAjax()){
            if($keys){
                $where[] = ["title","LIKE","%{$keys}%"];
            }
            $data = NoticeModel::where($where)
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
     * 添加公告
     * @return mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            // 数据验证
            $title = $this->request->param('title', '','trim');
            $content = $this->request->param('content', '','trim');
            $status = $this->request->param('status', 0,'intval');
            $sort = $this->request->param('sort', 0,'intval');
            $show_home = $this->request->param('show_home', 0,'intval');

            if(!$title){
                return self::error('请填写公告标题！');
            }
            if(!$content){
                return self::error('请填写公告内容！');
            }
            
            $data = [
                'title'=>$title,
                'content'=>$content,
                'status'=>$status,
                'sort'=>$sort,
                'show_home'=>$show_home,
                'create_time'=>time(),
                'update_time'=>time()
            ];
            
            $result = NoticeModel::create($data);
            if($result){
                return self::success('添加成功！');
            }
            return self::error('添加失败！');
        }
        
        $data = [
            'title'=>'',
            'content'=>'',
            'status'=>1,
            'sort'=>0,
            'show_home'=>0,
        ];
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 编辑公告
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
            $title = $this->request->param('title', '','trim');
            $content = $this->request->param('content', '','trim');
            $status = $this->request->param('status', 0,'intval');
            $sort = $this->request->param('sort', 0,'intval');
            $show_home = $this->request->param('show_home', 0,'intval');

            if(!$title){
                return self::error('请填写公告标题！');
            }
            if(!$content){
                return self::error('请填写公告内容！');
            }
            
            $data = [
                'title'=>$title,
                'content'=>$content,
                'status'=>$status,
                'sort'=>$sort,
                'show_home'=>$show_home,
            ];
            
            // 手动设置更新时间
            $data['update_time'] = time();
            
            $result = NoticeModel::where('id', $id)->update($data);
            if($result){
                return self::success('修改成功！');
            }
            return self::error('修改失败！');
        }
        
        $data = NoticeModel::getToArray(['id'=>$id]);
        if(!$data){
            return self::error('公告不存在！');
        }
        $data['id'] = $id; // 确保传递 id
        $this->assign($data);
        return $this->fetch('add');
    }

    /**
     * 删除公告
     * @return mixed
     */
    public function del()
    {
        $id = $this->request->param('id', 0,'intval');
        $ids = $this->request->param('ids', []);
        
        // 支持批量删除
        if(!empty($ids) && is_array($ids)){
            $result = NoticeModel::destroy($ids);
            if($result){
                return self::success('批量删除成功！');
            }
            return self::error('批量删除失败！');
        }
        
        if(!$id){
            return self::error('参数错误！');
        }
        
        $result = NoticeModel::destroy($id);
        if($result){
            return self::success('删除成功！');
        }
        return self::error('删除失败！');
    }

    /**
     * 用户专属公告（保留原有功能）
     * @return mixed
     */
    public function userSave()
    {
        $uid   = $this->request->param('uid', 0,'intval');
        if(!$uid){
            return self::error('缺少用户ID！');
        }

        if ($this->request->isPost()) {
            // 使用原有的用户专属公告模型
            $userNoticeModel = new \app\agent\model\Notice();
            // 数据验证
            $title = $this->request->param('title', '','trim');
            $nid   = $this->request->param('nid', 0,'intval');
            $status= $this->request->param('status', 0,'intval');
            $note  = $this->request->param('note', '','trim');

            if(!$title){
                return self::error('请填写名称！');
            }
            if(!$note){
                return self::error('请填写内容！');
            }
            $data = [
                'uid'=>$uid,
                'title'=>$title,
                'status'=>$status,
                'nid'=>$nid,
                'note'=>$note
            ];
            $be = $userNoticeModel::getToArray(['uid'=>$uid]);
            if($be){
                $userNoticeModel::update($data,['uid'=>$uid]);
            }else{
                $userNoticeModel::create($data);
            }
            return self::success('操作成功！');
        }
        $userNoticeModel = new \app\agent\model\Notice();
        $data = [
            'uid'=>$uid,
            'title'=>'',
            'status'=>0,
            'note'=>'',
        ];
        $re = $userNoticeModel::getToArray(['uid'=>$uid]);
        if($re){
            $data = $re;
        }
        $this->assign($data);
        return $this->fetch('save');
    }
}