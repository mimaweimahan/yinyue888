<?php
/**
 * Explain: 代理管理
 */
namespace app\agent\controller\admin;
use app\agent\model\Agent;
use app\agent\model\AgentLog;
use app\agent\model\AgentWithdrawal;
use app\common\traits\ControllerTrait;
use RobThree\Auth\TwoFactorAuth;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Index extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new Agent();
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
        if($this->request->isAjax()){
            if($keys){
                $where[] = ["username|nickname","LIKE","%{$keys}%"];
            }
            $data = Agent::where($where)
                ->order(['created_at'=>'DESC'])
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
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            $nickname = $this->request->param('nickname','','trim');
            if(!$nickname){
                return self::error('请输入昵称！');
            }

            $username = $this->request->param('username','','trim');
            if(!$username){
                return self::error('登陆账号');
            }

            $password = $this->request->param('password','','trim');
            if(!$password){
                return self::error('请输入密码！');
            }

            if (Agent::create($params)) {
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
            $nickname = $this->request->param('nickname','','trim');
            if(!$nickname){
                return self::error('请输入昵称！');
            }

            $username = $this->request->param('username','','trim');
            if(!$username){
                return self::error('请填写登陆账号');
            }

            $password = $this->request->param('password','','trim');
            if(!$password){
                return self::error('请输入密码！');
            }
            
            if(!$password){
                unset($params['password']);
            }
            if ( Agent::update($params,['agent_id'=>$id]) ) {
                return self::success('编辑成功！',$params);
            }
            return self::error('编辑失败！');
        }
        $result = Agent::where(['agent_id'=>$id])->find();
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $data = $result->toArray();
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 绑定谷歌验证
     */
    public function binding(){
        $agent_id = $this->request->param('agent_id','');
        $app_name = config('app.app_name');
        if(!$agent_id){
            return self::error('参数错误！');
        }
        if($this->request->isPost()){
            $secret_key = $this->request->param('secret_key','','trim');
            if(!$secret_key){
                return self::error('参数错误！');
            }
            $rt = Agent::update(['secret_key'=>$secret_key,'is_bind'=>1],['agent_id'=>$agent_id]);
            if($rt){
                return self::success('绑定成功！');
            }
            return self::error('绑定失败！');
        }

        $agent = Agent::getToArray(['agent_id'=>$agent_id]);
        // 创建一个 TwoFactorAuth 实例，设置应用名称、认证码长度以及每个认证码的有效时间
        $auth  = new TwoFactorAuth($app_name);
        if($agent['is_bind']&&$agent['secret_key']){
            $secret_key = $agent['secret_key'];
        }else{
            // 生成一个随机的密钥
            $secret_key = $auth->createSecret();
        }
        // 生成一个供用户扫描的二维码，其中包含用户名和密钥
        $qrCodeUrl = $auth->getQRCodeImageAsDataUri($agent['username'], $secret_key);
        $this->assign([
            'agent_id' => $agent_id,
            'qrCodeUrl' => $qrCodeUrl,
            'secret_key'=>$secret_key,
            'agent'=>$agent,
        ]);
        return $this->fetch();
    }

    /**
     * 解绑谷歌验证
     */
    public function unbinding(){
        $agent_id = $this->request->param('agent_id','');
        if(!$agent_id){
            return self::error('参数错误！');
        }
        $rt = Agent::update(['secret_key'=>'', 'is_bind'=>0],['agent_id'=>$agent_id]);
        if($rt){
            return self::success('解绑成功！');
        }
        return self::error('解绑失败！');
    }

    //代理提现管理
    public function withdraw() {
        $where = [];
        $params    = $this->request->param();
        $keys      = $this->request->param('keys','','trim');
        $agent_id  = $this->request->param('agent_id',0,'intval');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status','','intval');
        // 账号类型
        // 0TRC，1ERC ，2BSC
        $withdraw_type = $this->request->param('address_type','','intval');
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

            if($agent_id){
                $where[] = ["agent_id","=",$agent_id];
            }

            if($status){
                $where[] = ["status","=",$status-1];
            }
            $data = AgentWithdrawal::with(['agent'])->where($where)
                ->order(['created_at'=>'DESC'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();

            $attach = [
                'all_total'=>count($data['data']),
                'all_balance'=>AgentWithdrawal::where($where)->sum('balance')
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("keys", $keys);
        $this->assign("url", url('withdraw'));
        $this->assign("limit", $limit);
        $this->assign("agent_list", Agent::getList());
        return $this->fetch();
    }

    //代理提现审核
    public function approval() {
        $id = $this->request->param('id',0,'intval');
        if(!$id){
            return self::error('缺少ID');
        }
        if ($this->request->isPost()){
            $status = $this->request->param('status',0,'intval');
            $mark   = $this->request->param('mark',0,'trim');

            if(!$status){
                return self::error('缺少审批类型');
            }
            if(!$mark){
                return self::error('请填写审批说明');
            }
            $_data = [
                'status'=>$status,
                'mark'=>$mark
            ];
            if($status == 1){
                $_data['paid_at'] = time();
            }
            $rt = AgentWithdrawal::update($_data,['id'=>$id]);
            if($rt){
                return self::success('操作成功！');
            }
            return self::error('操作失败！');
        }
        $data = AgentWithdrawal::getToArray(['id'=>$id]);
        $this->assign($data);
        return $this->fetch();
    }

    // 上分管理
    public function rankup(){
        $agent_id = $this->request->param('agent_id',0,'intval');
        if(!$agent_id){
            return self::error('参数错误！');
        }
        if ($this->request->isPost()){
            $amount = $this->request->param('amount',0,'floatval');
            $_type   = $this->request->param('type',0,'intval');
            $remark = $this->request->param('remark',0,'trim');
            if(!$amount){
                return self::error('请填写操作金额！');
            }
            if (!$remark){
                return self::error('请填写操作说明！');
            }
            $amount = abs($amount);
            if($amount<0.001){
                return self::error('操作金额不能小于0.001！');
            }
            //如果是上分，则type为7，如果是下分，则type为8
            if($_type==1){
                $type = 7;
            }else{
                $type = 8;
                $amount = -$amount;
            }
            $rt = AgentLog::updateAc($agent_id,$amount,$type,$remark);
            if($rt['code']==1){
                return self::success('操作成功！');
            }
            return self::error($rt['msg']);
        }
        $this->assign('agent_id',$agent_id);
        return $this->fetch();
    }
}