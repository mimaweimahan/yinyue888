<?php
/**
 * Explain: 代理业务员
 */
namespace app\agent\controller\admin;
use app\agent\model\Agent;
use app\agent\model\AgentAddress;
use app\agent\model\AgentAddressType;
use app\agent\model\AgentLog;
use app\agent\model\Recharge as RechargeModel;
use app\agent\model\Salesman;
use app\common\model\user\UserWallet;
use app\common\traits\ControllerTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Recharge extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new RechargeModel();
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
        $params    = $this->request->param();
        $keys      = $this->request->param('keys','','trim');
        $agent_id  = $this->request->param('agent_id',0,'intval');
        $worker_id = $this->request->param('worker_id',0,'intval');
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status',0,'intval');

        // 账号类型
        // 0TRC，1ERC ，2BSC
        $address_type = $this->request->param('address_type',0,'intval');
        $limit     = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            // 开始时间
            $start_time = $this->request->param('start_time','');
            // 结束时间
            $end_time   = $this->request->param('end_time','');
            $_date = [];
            if (!empty($start_time)) {
                $_date = ['created_at','>=', strtotime($start_time)];
            }
            if (!empty($end_time)) {
                $_date = ['created_at','<=', strtotime($end_time)];
            }
            if ($end_time && $start_time ) {
                $_date = [ ['created_at','>=', strtotime($start_time)], ['created_at','<=', strtotime($end_time)] ];
            }
            if($_date){
                $where[] = $_date;
            }
            //++++++++++++++++++
            if($agent_id>0){
                $where[] = ["agent_id","=",$agent_id];
            }
            if($worker_id){
                $where[] = ["worker_id","=",$worker_id];
            }
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if($user_type){
                $where[] = ["user_type","=",$user_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($address_type){
                $where[] = ["address_type","=",$address_type-1];
            }
            if($status){
                $where[] = ["status","=",$status-1];
            }
            $data = RechargeModel::where($where)
                ->order(['created_at'=>'DESC'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();

            $attach = [
                'all_total'=>count($data['data']),
                'all_balance'=>RechargeModel::where($where)->sum('balance')
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("keys", $keys);
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        $this->assign("agent_list", Agent::getList());
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch();
    }

    /**
     * 充值审批
     * @return string
     */
    public function approval(){
        $id = $this->request->param('id', 0, 'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        if ($this->request->isPost()) {
            $status = $this->request->param('status', 0, 'intval');
            $remark = $this->request->param('remark', '', 'trim');
            if(!$status){
                return self::error('请选择审批结果！');
            }
            // if(!$remark){
            //     return self::error('请填写审批说明！');
            // }
            $_data = RechargeModel::getToArray(['id'=>$id]);
            if(!$_data){
                return self::error('充值信息不存在！');
            }

            if($_data['status']==1){
                return self::error('已经处理过了不能重复处理！');
            }

            $f_data = ['actype'=> 0];

            if($status == 1){
                $_type = 2;
                //如果是后台充值，则类型设置为上方
                $is_sys = $this->model->where('id', $id)->value('is_sys');
                if($is_sys==1){
                    $_type = 54;
                }
                // 更新用户钱包
                $rt = UserWallet::updateAc($_data['uid'],['balance'=>$_data['balance']],$_type,'充值到账', $f_data);
                if($rt['code']==0){
                    return self::error($rt['msg']);
                }
            }
            
            $do = $this->model::update([
                'status'=>$status,
                'remark'=>$remark,
                'updated_at'=>time(),
            ],['id'=>$id]);

            if ($do) {
                return self::success('操作成功！');
            }
            return self::error('操作失败！');
        }
        $result = $this->model::getToArray(['id'=>$id]);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $this->assign($result);
        if($result['status']==1){
            return $this->fetch('approval_complete');
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
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            // 数据验证
            $validate = validate('Agent',[],false,false);
            if (!$validate->check($params)) {
                return self::error($validate->getError());
            }
            $pk = $this->model->getPk();
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
        return $this->fetch();
    }

    /**
     * 充值地址
     * @return string|\think\response\Json
     * @throws DbException
     */
    public function address(){
        $where = [];
        $params   = $this->request->param();
        $keys     = $this->request->param('keys','','trim');
        $limit    = $this->request->param('limit',10,'intval');
        $type     = $this->request->param('type',0,'intval');
        $agent_id = $this->request->param('agent_id',0,'intval');
        if($this->request->isAjax()){
            if($keys){
                $where[] = ["title","LIKE","%{$keys}%"];
            }
            if($type>0){
                $where[] = ["type","=",$type];
            }
            if($agent_id>0){
                $where[] = ["agent_id","=",$agent_id];
            }
            $data = AgentAddress::with(['type'])->where($where)
                ->order(['agent_id'=>'ASC','sort'=>'ASC'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("agent_list", Agent::getList());
        $this->assign("limit", $limit);
        return $this->fetch();
    }

    /**
     * 添加
     * @return mixed
     */
    public function adddz()
    {
        if ($this->request->isPost()) {
            // 数据验证
            $name     = $this->request->param('name', '','trim');
            $icon     = $this->request->param('icon', '','trim');
            $address  = $this->request->param('address', '','trim');
            $agent_id = $this->request->param('agent_id', 0,'intval');
            $type_id  = $this->request->param('type_id', 0,'intval');
            if(!$agent_id){
                return self::error('请设置代理ID！');
            }

            if(!$type_id){
                return self::error('设置所属网络！');
            }
            if(!$name){
                return self::error('请填写名称！');
            }
            if(!$icon){
                return self::error('请设置图标！');
            }
            if(!$address){
                return self::error('请填写地址！');
            }

            $data = [
                'name'=>$name,
                'icon'=>$icon,
                'address'=>$address,
                'agent_id'=>$agent_id,
                'type_id'=>$type_id,
                'created_at'=>time()
            ];
            if (AgentAddress::create($data)) {
                return self::success('添加成功！');
            }
            return self::error('添加失败！');
        }
        $this->assign("agent_list", Agent::getList());
        $this->assign("type_list", AgentAddressType::getList([],0,'sort ASC'));
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function editdz()
    {
        $id = $this->request->param('id', 0, 'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            // 数据验证
            $name     = $this->request->param('name', '','trim');
            $icon     = $this->request->param('icon', '','trim');
            $address  = $this->request->param('address', '','trim');
            $agent_id = $this->request->param('agent_id', 0,'intval');
            $type_id  = $this->request->param('type_id', 0,'intval');
            if(!$agent_id){
                return self::error('请设置代理ID！');
            }
            if(!$name){
                return self::error('请填写名称！');
            }
            if(!$type_id){
                return self::error('请设置所属网络！');
            }
            if(!$icon){
                return self::error('请设置图标！');
            }
            if(!$address){
                return self::error('请填写地址！');
            }
            $data = [
                'name'=>$name,
                'icon'=>$icon,
                'address'=>$address,
                'type_id'=>$type_id,
                'agent_id'=>$agent_id
            ];
            if ( AgentAddress::update($data,['id'=>$id]) ) {
                return self::success('编辑成功！',$data);
            }
            return self::error('编辑失败！');
        }
        $result = AgentAddress::getToArray(['id'=>$id]);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $this->assign($result);
        $this->assign("agent_list", Agent::getList());
        $this->assign("type_list", AgentAddressType::getList([],0,'sort ASC'));
        return $this->fetch();
    }

    public function deldz()
    {
        $_ids =  $this->request->param('id/a', '');
        if (empty($_ids)) {
            return self::error("选择你要删除的信息");
        }
        if (AgentAddress::whereIn('id', $_ids)->delete()) {
            return self::success("操作成功！");
        }
        return self::error('执行失败');
    }

    /**
     * 排序
     */
    public function sort()
    {
        if ($this->request->isPost()) {
            if(isset($_POST['sort'])){
                foreach ($_POST['sort'] as $id => $sort) {
                    AgentAddress::update(['sort'=>$sort],['id'=>$id]);
                }
            }
            return self::success('操作成功！');
        }
        return self::error("选择你要更新的信息");
    }
}