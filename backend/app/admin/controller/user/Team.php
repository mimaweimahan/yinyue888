<?php
/**
 * Explain: 报单用户
 */
namespace app\admin\controller\user;
use app\city\model\City;
use think\facade\Db;
use app\common\traits\ControllerTrait;
use app\common\model\User;
use app\common\model\user\UserGrade;
use app\api\model\Relation;
use app\api\model\RelationTeam;
use app\order\model\Order;

class Team extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new Relation();
    }
    use ControllerTrait;

    /**
     * 用户列表
     */
    public function index(){
        $keys  = $this->request->get('keys','');
        $param = $this->request->param();
        $limit = $this->request->param('limit',20,'intval');
        $referee_id = $this->request->param('referee_id',0,'intval');
        $grade_id = $this->request->param('grade_id',0,'intval');
        if($this->request->isAjax()){
            $where = [];
            if($referee_id > 0){
                $where[] = ['referee_id','=',$referee_id ];
            }
            if($keys){
                $where[] = ['user.account|user.mobile|user.nickname','LIKE',"$keys"];
            }
            if($grade_id > 0){
                $where[] = ['user.grade_id','=',$grade_id];
            }
            $data = RelationTeam::ListDb()
                ->where($where)
                ->order('id desc,referee_time desc')
                ->paginate(['list_rows' => $limit,'query' =>$param], false)
                ->toArray();

            foreach ($data['data'] as $k=>$r){
                $my_team_ids = RelationTeam::where( ['parent_id'=>$r['uid']] )->column('uid');
                $my_team_ids[] = $r['uid'];
                $data['data'][$k]['agent_area_str'] = '';
                if($r['agent_area']){
                    $agent_area = str2arr($r['agent_area']);
                    $agent_area_str = City::whereIn('id',$agent_area)->column('area_name');
                    if($agent_area_str){
                        $data['data'][$k]['agent_area'] = arr2str($agent_area_str);
                    }
                }
                $data['data'][$k]['my_team']  = RelationTeam::where(['parent_id'=>$r['uid']])->count();
                $data['data'][$k]['zt_team']  = RelationTeam::where(['parent_id'=>$r['uid'],'level'=>1])->count();
                $data['data'][$k]['my_order_num']   = Order::where(['uid'=>$r['uid'],'pay_status'=>1])->count();
                $data['data'][$k]['team_order_num'] = Order::where([['uid','IN',$my_team_ids],['pay_status','=',1]])->count();
                $data['data'][$k]['referee_name'] = User::where(['id'=>$r['referee_id']])->value('nickname');
            }
            return self::result_layui($data);
        }
        $this->assign('keys',$keys);
        $this->assign('url',url('index'));
        $this->assign('limit',$limit);
        $this->assign("grade_id", $grade_id);
        $this->assign('grade_list',UserGrade::getList([],0,'id asc'));
        return $this->fetch();
    }

    /**
     * 设置等级
     * @return mixed
     */
    public function grade(){
        if($this->request->isPost()){
            $_ids = input('param.id/a', '');
            $grade_id = input('post.grade_id', 1, 'intval');
            if (empty($_ids)) {
                $this->error("选择你要设置的信息");
            }
            if(User::update(['grade_id'=>$grade_id],[['id','IN',$_ids]])){
                return self::success('操作成功');
            }
            return self::error('执行失败');
        }
        return self::error('执行失败');
    }

    /**
     * 用户详情
     */
    public function view(){
        $id = input('get.id',0,'intval');
        if($id == 0){
            return self::error('缺少id');
        }
        $data = Db::view('user', 'id,mobile,account,grade_id,nickname,type_id,status,reg_time,login,last_login_time,last_login_ip')
            ->view('relation', 'uid,referee_id,team_id,referee_name,referee_time', 'relation.uid = user.id')
            ->view('user_grade', 'grade_name', 'user_grade.id = user.grade_id','LEFT')
            ->view('user_wallet', 'freeze,amount,integral,bi', 'user_wallet.uid = user.id','LEFT')
            ->where(['uid.id'=>$id])->find();
        if(!$data){
            return self::error('信息不存在');
        }
        $this->assign("data", $data);
        return $this->fetch();
    }

    /**
     * 团队管理
     */
    public function team(){
        $param = $this->request->param();
        $limit = $this->request->param('limit',20,'intval');
        $keys  = $this->request->param('keys','');
        $type  = $this->request->param('type',1,'intval');
        $uid   = $this->request->param('uid',0,'intval');
        $grade_id = $this->request->param('grade_id',0,'intval');
        if($this->request->isAjax()){
            $where = [];
            // 1 直推，2 我的团队
            switch ($type){
                case 1:
                    $where['parent_id'] = $uid;
                    $where['level'] = 1;
                    break;
                case 2:
                    $where['parent_id'] = $uid;
                    break;
            }
            if($keys){
                $where['account|mobile|nickname|referee_name'] = $keys;
            }
            if($grade_id){
                $where['user.grade_id'] = $grade_id;
            }
            $data = Db::view('relation_team','*')
                ->view('user','mobile,account,nickname','user.id = relation_team.uid')
                ->view('user_wallet', 'freeze,amount,integral,bi', 'user_wallet.uid = user.id','LEFT')
                ->view('user_grade', 'grade_name', 'user_grade.id = user.grade_id','LEFT')
                ->where($where)
                ->order('level asc')
                ->paginate(['list_rows' => $limit,'query' =>$param], false)
                ->toArray();
            foreach ($data['data'] as $k=>$r){
                //最后报单时间
                $my_team_ids = RelationTeam::where( ['parent_id'=>$r['uid']] )->column('uid');
                $my_team_ids[] = $r['uid'];
                $data['data'][$k]['my_team']  = count($my_team_ids);
                $data['data'][$k]['zt_team']  = RelationTeam::where(['parent_id'=>$r['uid'],'level'=>1])->count();
                $data['data'][$k]['my_order_num']   = Order::where(['uid'=>$r['uid'],'pay_status'=>1])->count();
                $data['data'][$k]['team_order_num'] = Order::where([['uid','IN',$my_team_ids],['pay_status','=',1]])->count();
                $data['data'][$k]['referee_name'] = User::where(['id'=>$r['parent_id']])->value('nickname');
            }
            return self::result_layui($data);
        }
        $this->assign('url',url('team',['uid'=>$uid]));
        $this->assign('limit',$limit);
        $this->assign('type',$type);
        $this->assign('grade_list',UserGrade::getList([],0,'id asc'));
        return $this->fetch();
    }

    /**
     * 会员推广码（网页）
     */
    public function poster(){
        $uid = input('param.uid',0, 'intval');
        $q   = input('param.q', 0, 'intval');// 是否强制更新,1为是
        if($uid == 0){
            return self::error('缺少参数！');
        }
        $png = Relation::poster($uid,'mp',$q);
        $this->assign('png',$png.'?t='.time());
        $this->assign('uid',$uid);
        return $this->fetch();
    }
}