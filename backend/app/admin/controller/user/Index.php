<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 用户管理
 */
namespace app\admin\controller\user;
use app\agent\model\Agent;
use app\agent\model\Orders;
use app\agent\model\Recharge;
use app\agent\model\WalletLog;
use app\agent\model\Withdrawal;
use app\agent\model\Salesman;
use app\common\model\user\UserWallet;
use app\common\traits\ControllerTrait;
use app\common\model\User;
use app\common\model\user\UserData;
use app\common\model\user\UserRecord;
use core\utils\CountryCode;
use core\utils\ip2region\Ip2Region;
use think\facade\Db;
class Index extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new User();
    }
    use ControllerTrait;
    /**
     * 列表
     * @return string|\think\response\Json
     * @throws \think\db\exception\DbException
     */
    public function index()
    {
        $param = $this->request->param();
        $page = $this->request->param('page',1,'intval');
        $limit = $this->request->param('limit',20,'intval');
        $where = [];
        $wallet =  UserWallet::alias('w')
            ->join('user u','u.id = w.uid','left')
            ->where('del_time','=',0)
            ->where('type_id','=',1)
            ->field([
                // 统计多个字段的和，并重命名
                'sum(balance) as balance',
                'sum(in_balance) as in_balance',
                'sum(freeze_balance) as freeze_balance',
                'sum(frozen_balance) as frozen_balance',
                'sum(give_balance) as give_balance',
                'sum(out_balance) as out_balance',
                'sum(give_balance) as give_balance'
            ])
            ->find()->toArray();

        $ud =  UserData::alias('w')
            ->join('user u','u.id = w.uid','left')
            ->where('del_time','=',0)
            ->where('type_id','=',1)
            ->field([
                // 统计多个字段的和，并重命名
                'sum(trade_bonus) as trade_bonus',
                'sum(trade_profit) as trade_profit',
                'sum(trade_invite_balance) as trade_invite_balance',
                'sum(trade_invite_receive) as trade_invite_receive',
                'sum(trade_invite_remainder) as trade_invite_remainder',
            ])
            ->find()->toArray(); // 获取一条记录（统计结果只有一条）
        $attach = [
            'total'=>User::where('del_time',0)->where('type_id',1)->count(),
            'total_balance'=>floatval($wallet['balance']),
            'balance'=>floatval($wallet['balance']),
            'freeze_balance'=>floatval($wallet['freeze_balance']),
            'frozen_balance'=>floatval($wallet['frozen_balance']),
            'in_balance'=>floatval($wallet['in_balance']),
            'out_balance'=>floatval($wallet['out_balance']),
            'give_balance'=>floatval($wallet['give_balance']),
            'trade_profit'=>floatval($ud['trade_profit']),
            'trade_bonus'=>floatval($ud['trade_bonus']),
            'trade_invite_balance'=>floatval($ud['trade_invite_balance']),
            'trade_invite_remainder'=>floatval($ud['trade_invite_remainder']),
            'diff_balance'=>0
        ];
        if($this->request->isAjax()){
            $keys  = $this->request->param('keys','');
            if($keys){
                $where[] = ['user.mobile|user.nickname','LIKE',"%{$keys}%"];
            }
            $where[] = ['user.type_id','=',1];//只查询普通用户
            // 开始时间
            $start_time = $this->request->param('start_time','');
            // 结束时间
            $end_time   = $this->request->param('end_time','');
            $_date = [];
            if (!empty($start_time)) {
                $_date = ['user.reg_time','>=', strtotime($start_time)];
            }
            if (!empty($end_time)) {
                $_date = ['user.reg_time','<=', strtotime($end_time)];
            }
            if ($end_time && $start_time ) {
                $_date = [ ['user.reg_time','>=', strtotime($start_time)], ['user.reg_time','<=', strtotime($end_time)] ];
            }
            if($_date){
                $where[] = $_date;
            }

            $agent_id  = $this->request->param('agent_id',0,'intval');
            $worker_id = $this->request->param('worker_id',0,'intval');
            $user_type = $this->request->param('user_type',0,'intval');
            $uid       = $this->request->param('uid',0,'intval');
            $status    = $this->request->param('status',0,'intval');
            $is_online = $this->request->param('is_online',0,'intval');
            $is_task   = $this->request->param('is_task',0,'intval');
            $referee_id = $this->request->param('referee_id',0,'intval');
            $country_code = $this->request->param('country_code',0,'intval');
            $phone     = $this->request->param('phone','','trim');
            $email     = $this->request->param('email','','trim');
            $ip        = $this->request->param('ip','','trim');
            $remark    = $this->request->param('remark','','trim');
            $_whereRaw = '';
            if($agent_id){
                $where[] = ['user.agent_id','=',$agent_id];
            }
            if($worker_id){
                $where[] = ['user.worker_id','=',$worker_id];
            }
            if($user_type){
                $where[] = ['user.user_type','=',$user_type-1];
            }
            if($uid){
                $where[] = ['user.id','=',$uid];
            }
            if($status){
                $where[] = ['user.status','=',$status-1];
            }
            if($is_online){
                $where[] = ['user.is_online','=',$is_online-1];
            }
            if($is_task){
                switch ($is_task) {
                    case 1://已开启
                        $where[] = ['user.is_task','=',1];
                        break;
                    case 2://进行中
                        $where[] = ['user.is_task','=',1];
                        $where[] = ['user.task_done','>',0];
                        break;
                    case 3://未开启
                        $where[] = ['user.is_task','=',0];
                        break;
                    case 4://已开启未开始
                        $where[] = ['user.is_task','=',1];
                        $where[] = ['user.task_done','=',0];
                        break;
                    case 5://已完成
                        $where[] = ['user.is_task','=',1];
                        $_whereRaw = 'user.task_num=user.task_done';
                    break;
                }
            }
            if($referee_id){
                $where[] = ['user.referee_id','=',$referee_id];
            }
            if($phone){
                $where[] = ['user.phone','=',$phone];
            }
            if($email){
                $where[] = ['user.email','=',$email];
            }
            if($ip){
                $where[] = ['user.ip','=',$ip];
            }
            if($remark){
                $where[] = ['user.remark','LIKE', "%{$remark}%"];
            }
            if($country_code){
                $where[] = ['user.country_code','=',$country_code];
            }

            $order = 'user.is_top desc,user.id desc';

            $db  = Db::view('user','*')
                ->view('user_wallet','*','user_wallet.uid=user.id')
                ->view('user_data','*','user_data.uid=user.id')
                ->where($where);
            if($_whereRaw){
                $db->whereRaw($_whereRaw);
            }
            $count = $db->count();

            $last_page = ceil($count/$limit);
            if($page>$last_page){
                $page=1;
            }
            $data  = $db->order($order)->page($page,$limit)->select()->toArray();
            foreach ($data as $k=>$r){
                if(isEmptyString($r['last_area'])){
                    $last_area = '';
                    // 优先使用登录IP解析地区
                    if($r['last_login_ip']){
                        $ip2region = new Ip2Region();
                        $arr = $ip2region->get($r['last_login_ip']);
                        if($arr && is_array($arr) && count($arr) > 0){
                            // 过滤空值并拼接
                            $arr = array_filter($arr);
                            $last_area = trim(implode(' ', $arr));
                        }
                    }
                    // 如果登录IP解析失败，尝试使用注册IP解析
                    if(!$last_area && $r['reg_ip']){
                        $ip2region = new Ip2Region();
                        $arr = $ip2region->get($r['reg_ip']);
                        if($arr && is_array($arr) && count($arr) > 0){
                            $arr = array_filter($arr);
                            $last_area = trim(implode(' ', $arr));
                        }
                    }
                    // 如果IP解析都失败，使用国家代码
                    if(!$last_area && $r['country_code']){
                        $last_area = CountryCode::get(intval($r['country_code']));
                    }
                    if($last_area){
                        User::update(['last_area'=>$last_area],['id'=>$r['id']]);
                        $data[$k]['last_area'] = $last_area;
                    }
                }
                $balance = floatval($r['balance']);
                if ($balance<0){
                    $data[$k]['frozen']  = $balance;
                    $order_balance = Orders::where(['uid'=>$r['id'],'status'=>0])->value('total_price');
                    $data[$k]['balance'] = $order_balance + $balance;
                }
                $data[$k]['reg_time']     = date('Y-m-d H:i:s',$r['reg_time']);
                $data[$k]['last_login_time'] = $r['last_login_time'] ? date('Y-m-d H:i:s',$r['last_login_time']) : '-';
                $data[$k]['in_balance']   = Recharge::where(['uid'=>$r['id'],'status'=>1])->sum('balance');
                $data[$k]['out_balance']  = Withdrawal::where(['uid'=>$r['id'],'status'=>1])->sum('balance');
                $data[$k]['trade_profit'] = WalletLog::where(['uid'=>$r['id']])->where('change_type',4)->sum('balance');
            }

            return json([
                'code'=>0,
                'data'=>$data,
                'count'=>$count,
                'page'=>$page,
                'last_page'=>$last_page,
                'limit'=>$limit,
                'attach'=>$attach,
                'map'=>$where
            ]);
        }
        $this->assign($param);
        $this->assign('url',url('index'));
        $this->assign('limit',$limit);
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch();
    }
    /**
     * 新增
     * @return string
     */
    public function add()
    {
        $params = $this->request->param();
        if( $this->request->isPost() ){

            //验证数据
            $validate = validate('User',[],false,false);
            if( !$validate->scene('add')->check($params) ){
                return self::error($validate->getError());
            }

            $referee_id = $this->request->param('referee_id',0,'intval');
            $worker_id  = $this->request->param('worker_id',0,'intval');
            $user_type  = $this->request->param('user_type',0,'intval');

            if(!$worker_id && !$referee_id){
                return self::error('请选择业务员或设置推荐人ID');
            }
            if($worker_id){
                $params['agent_id'] = Salesman::where('worker_id',$worker_id)->value('agent_id');
            }
            $uid = User::register($params,$user_type,$referee_id);
            if( $uid>0 ){
                return self::success('成功');
            }
            return self::error( User::showRegError($uid),$params );
        }
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch();
    }

    /**
     * 编辑
     * @return string
     */
    public function edit()
    {
        $id = $this->request->param('id',0,'intval');
        if($id == 0){
            return self::error('缺少ID');
        }
        $param = $this->request->param();
        unset($param['id']);
        if( $this->request->isPost() ){
            //验证数据
            $validate = validate('User',[],false,false);
            if( !$validate->scene('edit')->check($param) ){
                return self::error($validate->getError());
            }
            if(empty($param['password']) ){
                unset($param['password']);
            }
            if(empty($param['trans_password']) ){
                unset($param['trans_password']);
            }
            $param['update_time'] = time();
            if(User::update($param,['id'=>$id])){
                return self::success('更新成功');
            }
            return self::error('更新失败');
        }
        $data = $this->model->with('userInfo')->find(['id'=>$id]);
        if($data){
            $data = $data->toArray();
        }
        $this->assign("salesman_list", Salesman::getList());
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 账户配置
     * @throws \think\db\exception\DbException
     */
    public function account(){
        $id = $this->request->param('id',0,'');
        if($id == 0){
            return self::error('缺少id！');
        }
        if( $this->request->isPost() ){
            $amount   = $this->request->param('amount',0,'floatval');//余额（扩展备用）
            $bi = $this->request->param('bi',0,'floatval');//虚拟币金额
            $integral = $this->request->param('integral',0,'floatval');//积分（扩展备用）
            $note     = $this->request->param('note','','trim');
            $rt = '';
            if($amount){
                $rt = UserWallet::where(['uid'=>$id])->inc('amount',$amount)->save();
            }
            if($bi){
                $rt = UserWallet::where(['uid'=>$id])->inc('bi',$bi)->save();
            }
            if($integral){
                $rt = UserWallet::where(['uid'=>$id])->inc('integral',$integral)->save();
            }
            if($rt){
                // 新增账户记录
                UserRecord::create([
                    'uid'=>$id,
                    'type'=>2,
                    'note'=>$note,
                    'amount'=>$amount,
                    'bi'=>$bi,
                    'integral'=>$integral,
                    'admin_id'=>$this->uid,
                    'admin_name'=>$this->admin_info['nickname'],
                    'data'=>serialize([
                        'type'=>2,
                        'amount'=>$amount,
                        'bi'=>$bi,
                        'integral'=>$integral,
                        'admin_id'=>$this->uid
                    ]),
                    'add_time'=>time()
                ]);
                return self::success('更新成功');
            }
            return self::error('更新失败');
        }
        $data = UserWallet::where(['uid'=>$id])->find();
        $this->assign('id',$id);
        $this->assign($data);
        return $this->fetch();
    }

    public function view(){
        $id    = $this->request->param('id',0,'intval');
        $limit = $this->request->param('limit',10,'intval');
        if($this->request->isAjax()){
            $params = $this->request->param();
            $data = UserRecord::getListPage(['uid'=>$id],$limit,'add_time desc',$params);
            foreach ($data['data'] as $k=>$r){
                $data['data'][$k]['type_name'] = UserRecord::type($r['type'],1);
            }
            return self::result_layui($data);
        }
        if($id == 0){
            return self::error('缺少ID');
        }
        $data = $this->model->with(['userInfo','wallet'])->find(['id'=>$id]);
        if($data){
            $data = $data->toArray();
        }
        $this->assign('url',url('view',['id'=>$id]));
        $this->assign('limit',$limit);
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 用户选择
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function choose(){
        $where = [];
        if($this->request->isAjax()){
            $keys  = $this->request->param('keys','');
            if($keys){
                $where[] = ['user.username|user.mobile|user_data.nickname','like',"$keys"];
            }
            $page     = input('page',1,'intval');
            $pageSize = input('limit',20,'intval');
            $data     = Db::view('user','id,username,grade_id,status,mobile')
                ->view('user_data','nickname','user_data.uid=user.id')
                ->view('user_account','amount,bi','user_account.uid=user.id')
                ->where($where)
                ->limit(($page - 1) * $pageSize, $pageSize)
                ->order('user.id desc')
                ->select();
            if($data){
                $data = $data->toArray();
            }
            return self::result_layui($data);
        }
        $this->assign('val',$this->request->get('val','user_ids'));
        $this->assign('fun',$this->request->get('fun',''));
        $this->assign('choose_num',$this->request->get('num',1,'intval'));
        return $this->fetch();
    }

    /**
     * 删除用户
     * @return string
     * @throws \think\db\exception\DbException
     */
    public function delete()
    {
        $_ids = input('param.id/a', '');
        if (empty($_ids)) {
            return self::error("选择你要删除的信息");
        }
        //判断删除用户里面是否包含第一个用户，第一个用户不能被删除，一个用户为超级管理员
        if(in_array(1,$_ids)){
            $key = array_search(1 ,$_ids); array_splice($_ids,$key,1);
            if(count($_ids) == 0){
                return self::error("超级管理员不能被删除");
            }
        }
        if (User::del($_ids)) {
            return self::success("操作成功！");
        }
        return self::error('执行失败');
    }


    public function xj()
    {
        $param  = $this->request->param();
        $page   = $this->request->param('page',1,'intval');
        $limit  = $this->request->param('limit',20,'intval');
        $pid    = $this->request->param('pid',0,'intval');
        if($pid==0){
            return self::error('缺少参数'.$pid);
        }
        $where  = [];
        $wallet =  UserWallet::alias('w')
            ->join('user u','u.id = w.uid','left')
            ->where('del_time','=',0)
            ->where('type_id','=',1)
            ->where('u.referee_id','=',$pid)
            ->field([
                // 统计多个字段的和，并重命名
                'sum(balance) as balance',
                'sum(in_balance) as in_balance',
                'sum(freeze_balance) as freeze_balance',
                'sum(frozen_balance) as frozen_balance',
                'sum(give_balance) as give_balance',
                'sum(out_balance) as out_balance',
                'sum(give_balance) as give_balance'
            ])
            ->find()->toArray();

        $ud =  UserData::alias('w')
            ->join('user u','u.id = w.uid','left')
            ->where('del_time','=',0)
            ->where('type_id','=',1)
            ->where('u.referee_id','=',$pid)
            ->field([
                // 统计多个字段的和，并重命名
                'sum(trade_bonus) as trade_bonus',
                'sum(trade_profit) as trade_profit',
                'sum(trade_invite_balance) as trade_invite_balance',
                'sum(trade_invite_receive) as trade_invite_receive',
                'sum(trade_invite_remainder) as trade_invite_remainder',
            ])
            ->find()->toArray(); // 获取一条记录（统计结果只有一条）

        $attach = [
            'total'=>User::where('del_time',0)
                ->where('referee_id','=',$pid)
                ->where('type_id',1)
                ->count(),
            'total_balance'=>floatval($wallet['balance']),
            'balance'=>floatval($wallet['balance']),
            'freeze_balance'=>floatval($wallet['freeze_balance']),
            'frozen_balance'=>floatval($wallet['frozen_balance']),
            'in_balance'=>floatval($wallet['in_balance']),
            'out_balance'=>floatval($wallet['out_balance']),
            'give_balance'=>floatval($wallet['give_balance']),
            'trade_profit'=>floatval($ud['trade_profit']),
            'trade_bonus'=>floatval($ud['trade_bonus']),
            'trade_invite_balance'=>floatval($ud['trade_invite_balance']),
            'trade_invite_remainder'=>floatval($ud['trade_invite_remainder']),
            'diff_balance'=>0
        ];
        if($this->request->isAjax()){
            $keys  = $this->request->param('keys','');
            if($keys){
                $where[] = ['user.mobile|user.nickname','LIKE',"%{$keys}%"];
            }
            $where[] = ['user.type_id','=',1];//只查询普通用户
            // 开始时间
            $start_time = $this->request->param('start_time','');
            // 结束时间
            $end_time   = $this->request->param('end_time','');
            $_date = [];
            if (!empty($start_time)) {
                $_date = ['user.reg_time','>=', strtotime($start_time)];
            }
            if (!empty($end_time)) {
                $_date = ['user.reg_time','<=', strtotime($end_time)];
            }
            if ($end_time && $start_time ) {
                $_date = [ ['user.reg_time','>=', strtotime($start_time)], ['user.reg_time','<=', strtotime($end_time)] ];
            }
            if($_date){
                $where[] = $_date;
            }

            $worker_id = $this->request->param('worker_id',0,'intval');
            $user_type = $this->request->param('user_type','','intval');
            $uid       = $this->request->param('uid',0,'intval');
            $status    = $this->request->param('status','','intval');
            $is_online = $this->request->param('is_online','','intval');
            $is_task   = $this->request->param('is_task','','intval');
            $country_code = $this->request->param('country_code','','intval');
            $phone     = $this->request->param('phone','','trim');
            $email     = $this->request->param('email','','trim');
            $ip        = $this->request->param('ip','','trim');
            $remark    = $this->request->param('remark','','trim');
            $where[] = ['user.referee_id','=',$pid];
            if($worker_id){
                $where[] = ['user.worker_id','=',$worker_id];
            }
            if($user_type){
                $where[] = ['user.user_type','=',$user_type];
            }
            if($uid){
                $where[] = ['user.user_type','=',$user_type];
            }
            if($status){
                $where[] = ['user.status','=',$status];
            }
            if($is_online){
                $where[] = ['user.is_online','=',$is_online];
            }
            if($is_task){
                $where[] = ['user.is_task','=',$is_task];
            }
            if($phone){
                $where[] = ['user.phone','=',$phone];
            }
            if($email){
                $where[] = ['user.email','=',$email];
            }
            if($ip){
                $where[] = ['user.ip','=',$ip];
            }
            if($remark){
                $where[] = ['user.remark','LIKE', "%{$remark}%"];
            }
            if($country_code){
                $where[] = ['user.country_code','=',$country_code];
            }

            $order = 'user.id desc';

            $db  = Db::view('user','*')
                ->view('user_wallet','*','user_wallet.uid=user.id')
                ->view('user_data','*','user_data.uid=user.id')
                ->where($where);
            $count = $db->count();

            $last_page = ceil($count/$limit);
            if($page>$last_page){
                $page=1;
            }
            $data  = $db->order($order)->page($page,$limit)->select()->toArray();
            foreach ($data as $k=>$r){
                if(isEmptyString($r['last_area'])){
                    $last_area = '';
                    // 优先使用登录IP解析地区
                    if($r['last_login_ip']){
                        $ip2region = new Ip2Region();
                        $arr = $ip2region->get($r['last_login_ip']);
                        if($arr && is_array($arr) && count($arr) > 0){
                            // 过滤空值并拼接
                            $arr = array_filter($arr);
                            $last_area = trim(implode(' ', $arr));
                        }
                    }
                    // 如果登录IP解析失败，尝试使用注册IP解析
                    if(!$last_area && $r['reg_ip']){
                        $ip2region = new Ip2Region();
                        $arr = $ip2region->get($r['reg_ip']);
                        if($arr && is_array($arr) && count($arr) > 0){
                            $arr = array_filter($arr);
                            $last_area = trim(implode(' ', $arr));
                        }
                    }
                    // 如果IP解析都失败，使用国家代码
                    if(!$last_area && $r['country_code']){
                        $last_area = CountryCode::get(intval($r['country_code']));
                    }
                    if($last_area){
                        User::update(['last_area'=>$last_area],['id'=>$r['id']]);
                        $data[$k]['last_area'] = $last_area;
                    }
                }
                $data[$k]['reg_time'] = date('Y-m-d H:i:s',$r['reg_time']);
            }
            return json([
                'code'=>0,
                'data'=>$data,
                'count'=>$count,
                'page'=>$page,
                'last_page'=>$last_page,
                'limit'=>$limit,
                'attach'=>$attach,
                'map'=>$where
            ]);
        }
        $this->assign($param);
        $this->assign('url',url('xj',['pid'=>$pid]));
        $this->assign('limit',$limit);
        $this->assign("salesman_list", Salesman::getList());
        return $this->fetch();
    }

    public function ontask(){
        $id  = $this->request->param('id',0,'intval');
        $val = $this->request->param('val',0,'intval');
        if(!$id){
            return self::error('缺少ID');
        }
        $update = ['is_task'=> $val];
        $user   = User::getToArray(['id'=>$id],'task_num,task_done,task_rate,task_batch');
        if(!$user){
            return self::error('操作失败');
        }
        if($val==1){
            $rs  = io_cache('TaskCfg');
            $task_rate = $rs['task_rate'] ?? 0;
            $task_num  = $rs['task_num'] ?? 0;
            $update['task_num']   = $task_num;
            $update['task_rate']  = $task_rate;
            $update['task_done']  = 0;
            $update['task_batch'] = $user['task_batch']+1;
        }
        $rt = User::update($update,['id'=>$id]);
        if($rt){
            return self::success('操作成功');
        }else{
            return self::error('操作失败');
        }
    }

}