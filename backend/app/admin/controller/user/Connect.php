<?php
declare (strict_types = 1);
namespace app\admin\controller\user;
use app\common\traits\ControllerTrait;
use app\common\model\user\UserConnect;
class Connect extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new UserConnect();
    }
    use ControllerTrait;

    public function index(){
        // 搜索类型
        $params = $this->request->param();
        $keys   = $this->request->param('keys','','trim');
        if($this->request->isAjax()){
            $where = [];
            if($keys){
                $where[] = ['nickname|openid','like',"$keys"];
            }
            $limit = $this->request->param('limit',20,'intval');
            $list  = UserConnect::getListPage($where,$limit,'id desc',$params,['user']);
            return self::result_layui($list);
        }
        $this->assign($params);
        $this->assign('url',url('index',$params));
        return $this->fetch();
    }
}