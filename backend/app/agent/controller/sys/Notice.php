<?php

namespace app\agent\controller\sys;

use app\agent\model\Notice as NoticeModel;
use app\common\traits\ControllerTrait;

class Notice  extends \app\AgentInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new NoticeModel();
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
     * 添加
     * @return mixed
     */
    public function save()
    {
        $uid   = $this->request->param('uid', 0,'intval');
        if(!$uid){
            return self::error('缺少用户ID！');
        }

        if ($this->request->isPost()) {
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
            $be = NoticeModel::getToArray(['uid'=>$uid]);
            if($be){
                NoticeModel::update($data,['uid'=>$uid]);
            }else{
                NoticeModel::create($data);
            }
            return self::error('操作成功！');
        }
        $data = [
            'uid'=>$uid,
            'title'=>'',
            'status'=>0,
            'note'=>'',
        ];
        $re = NoticeModel::getToArray(['uid'=>$uid]);
        if($re){
            $data = $re;
        }
        $this->assign($data);
        return $this->fetch();
    }
}