<?php
/**
 * Explain: 账户记录
 */
namespace app\worker\controller;
use app\agent\model\UserRepeat;
use app\common\traits\ControllerTrait;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Repeat extends \app\WorkerInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new UserRepeat();
    }
    use ControllerTrait;
    /**
     * 列表
     */
    /**
     * 列表
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function index() {
        $where = [];
        $params    = $this->request->param();
        $uid       = $this->request->param('uid',0,'intval');
        $user_type = $this->request->param('user_type','');
        //处理状态 0待处理，1已成功，2已取消
        $status    = $this->request->param('status','');

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
            $where[] = ["worker_id","=",$this->worker_id];
            if($uid){
                $where[] = ["uid","=",$uid];
            }
            if(!empty($user_type)){
                $where[] = ["user_type","=",intval($user_type)];
            }
            if(!empty($status)){
                $where[] = ["status","=",intval($status)];
            }
            $data = UserRepeat::getListPage($where,$limit,['id'=>'DESC'],$params);
            $attach = [
                'all_total'=>count($data['data'])
            ];
            return self::result_layui($data,$attach);
        }
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        return $this->fetch();
    }

    public function add(){
        $param = $this->request->param();
        $param['agent_id'] = $this->agent_id;
        $param['worker_id'] = $this->worker_id;
       //验证数据
        $validate = validate('UserRepeat',[],false,false);
        if( !$validate->check($param) ){
            return self::error($validate->getError());
        }
        //判断 字段 phone 是否存在
        $phone = $param['phone'];
        $user = UserRepeat::where('phone',$phone)->find();
        if($user){
            return self::error('账号已存在');
        }
        if(UserRepeat::create($param)){
            return self::success('新增成功！');
        }
        return self::error('新增失败！');
    }
}