<?php
/**
 * User: TT
 * Explain: 信息表单
 */
namespace app\admin\controller;
use app\admin\model\Forms as FormsModel;
use app\common\traits\ControllerTrait;
class Forms extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new FormsModel();
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
                $map[] = ["nickname","LIKE", "%{$keys}%"];
            }
            $data = FormsModel::getListPage($map,$limit,'id desc',$params);
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("limit", $limit);
        $this->assign("url", url('index'));
        return $this->fetch();
    }

}