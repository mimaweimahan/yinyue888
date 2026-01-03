<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 用户等级（备用）
 */
namespace app\admin\controller\user;
use app\common\traits\ControllerTrait;
use app\common\model\user\UserGrade;
use core\utils\Tools;
use think\Tree;

class Grade extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new UserGrade();
    }
    use ControllerTrait;

    /**
     * 列表
     */
    public function index()
    {
        $map = [];
        $keys   = $this->request->param('keys',0,'intval');
        $limit  = $this->request->param('limit',20,'intval');
        $params = $this->request->param();
        if($this->request->isAjax()){
            if($keys){
                $map["grade_name"] = ["LIKE", "%{$keys}%"];
            }
            $data = UserGrade::getListPage($map,$limit,['sort' => 'ASC', 'id' => 'ASC'],$params);
            return self::result_layui($data);
        }
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        return $this->fetch();
    }

    /**
     * 批量更新
     */
    public function updates(){
        if ($this->request->isPost()) {
            $sort  = $_POST['sort']; // 库存
            $zt    = $_POST['zt']; // 直推
            $zj    = $_POST['jt'];// 间推
            $zc    = $_POST['zc']; // 消费门槛
            if(empty($sort)) return self::error("缺少必要数据");
            foreach ($sort as $id => $val) {
                $data = [];
                $data['sort']  = $val;
                $data['zt']    = $zt[$id];
                $data['jt']    = $zj[$id];
                $data['zc']    = $zc[$id];
                UserGrade::update($data, ['id'=>$id]);
            }
            return self::success('操作成功！');
        }
        return self::error("选择你要更新的信息");
    }
}