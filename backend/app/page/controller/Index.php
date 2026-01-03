<?php
declare (strict_types = 1);
/**
 * Explain: 自定义单页
 */
namespace app\page\controller;
use app\common\traits\ControllerTrait;
use app\page\model\DiyPage;
class Index extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new DiyPage();
    }
    use ControllerTrait;
    /**
     * 列表
     */
    public function index()
    {
        $keys    = $this->request->param('keys','','trim');
        $limit   = $this->request->param('limit',20,'intval');
        $params  = $this->request->param();
        if($this->request->isAjax()){
            $map = [];
            if($keys){
                $map[] = ["title|label","LIKE", "%{$keys}%"];
            }
            $data = $this->model::getListPage($map,$limit,'sort asc,id desc',$params);
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("limit", $limit);
        $this->assign("url", url('index'));
        return $this->fetch();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $param  = $this->request->param();
            // 数据验证
            $validate = validate('DiyPage',[],false,false);
            if (!$validate->check($param)) {
                return self::error($validate->getError());
            }
            if($this->model::create($param)){
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
        $id = input('param.id', 0, 'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        if ($this->request->isPost()) {
            $param  = $this->request->param();
            // 数据验证
            $validate = validate('DiyPage',[],false,false);
            if (!$validate->check($param)) {
                return self::error($validate->getError());
            }

            if($this->model::update($param,['id'=>$id])){
                return self::success('编辑成功！');
            }
            return self::error('编辑失败！');
        }
        $result = $this->model::get($id);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $data = $result->toArray();
        $this->assign($data);
        return $this->fetch();
    }
}