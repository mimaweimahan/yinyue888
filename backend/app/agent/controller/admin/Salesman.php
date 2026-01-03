<?php
/**
 * Explain: 代理业务员
 */
namespace app\agent\controller\admin;
use app\agent\model\Agent;
use app\agent\model\Salesman as SalesmanModel;
use app\common\traits\ControllerTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Salesman extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new SalesmanModel();
    }
    use ControllerTrait;
    /**
     * 列表
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function index() {
        $where = [];
        $params   = $this->request->param();
        $keys     = $this->request->param('keys','','trim');
        $limit    = $this->request->param('limit',10,'intval');
        $agent_id = $this->request->param('agent_id',0,'intval');
        if($this->request->isAjax()){
            if($keys){
                $where[] = ["worker_user|nickname","LIKE","%{$keys}%"];
            }
            if($agent_id){
                $where[] = ["agent_id","=",$agent_id];
            }
            $data = $this->model::where($where)
                ->order(['created_at'=>'DESC'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        $this->assign("agent_list", Agent::getList());
        return $this->fetch();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            // 数据验证
            $validate = validate('Salesman',[],false,false);
            if (!$validate->check($params)) {
                return self::error($validate->getError());
            }
            //判断账号是否存在
            $be = SalesmanModel::where('worker_user',$params['worker_user'])->count();
            if($be){
                return self::error('账号已存在！');
            }
            if ($this->model::create($params)) {
                return self::success('添加成功！');
            }
            return self::error('添加失败！');
        }
        $this->assign("agent_list", Agent::getList());
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
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            // 数据验证
            $validate = validate('Salesman',[],false,false);
            if (!$validate->check($params)) {
                return self::error($validate->getError());
            }
            $pk = $this->model->getPk();
            //判断账号是否存在
            $be = SalesmanModel::where('worker_user',$params['worker_user'])->where($pk,'<>',$id)->count();
            if($be){
                return self::error('账号已存在！');
            }
            if ( $this->model::update($params,[$pk=>$id]) ) {
                return self::success('编辑成功！');
            }
            return self::error('编辑失败！');
        }
        $result = $this->model::find($id);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $data = $result->toArray();
        $this->assign($data);
        $this->assign("agent_list", Agent::getList());
        return $this->fetch();
    }
}