<?php
namespace app\api\controller\v1;
use app\agent\model\WalletLog;
use app\common\service\UserService;
use app\Request;
use app\common\model\User;
use app\api\model\Relation;
use app\api\model\RelationTeam;
use think\db\exception\DbException;
use think\facade\Db;
use app\agent\model\Recharge;
use app\agent\model\Withdrawal;
class Team
{
    public function index(Request $request){
        $uid  = $request->uid();
        $team_ids = UserService::getReferralUserIds($uid,3,true);
        $data = [
            'team_members'  => RelationTeam::where(['parent_id'=>$uid])->count(),
            'team_performance' => Recharge::whereIn('uid',$team_ids)->where('status',1)->sum('balance'),
            'team_withdraw'  => Withdrawal::whereIn('uid',$team_ids)->where('status',1)->sum('balance'),
            'team_invested'  => WalletLog::where(['uid'=>$uid,'actype'=>0,'is_hide'=>0])->where('from_user_level','>',0)->sum('balance'),
            'level1_rate'   => getConfig('level1_rate'),
            'level2_rate'   => getConfig('level2_rate'),
            'level3_rate'   => getConfig('level3_rate'),
            'level1_num'    => User::where(['referee_id'=>$uid])->count(),
            'level2_num'    => User::level2list($uid,2),
            'level3_num'    => User::level3list($uid,2),
            'level1_bonus'  => WalletLog::where(['uid'=>$uid,'actype'=>0,'is_hide'=>0,'from_user_level'=>1])->sum('balance'),
            'level2_bonus'  => WalletLog::where(['uid'=>$uid,'actype'=>0,'is_hide'=>0,'from_user_level'=>2])->sum('balance'),
            'level3_bonus'  => WalletLog::where(['uid'=>$uid,'actype'=>0,'is_hide'=>0,'from_user_level'=>3])->sum('balance'),
        ];
        return app('json')->success($data);
    }

    /**
     * 获取指定层级团队成员
     * @param Request $request
     * @return mixed
     */
    public function lst(Request $request){
        $uid   = $request->uid();
        $level = $request->param('level',1,'intval');
        $limit = $request->param('limit',20,'intval');
        $param = $request->param();
        $data = ['data'=>[]];
        if($level == 1){
            $data = User::getListPage(['referee_id'=>$uid],$limit,'id desc',$param,[],'id,email');
        }
        if ($level == 2){
            $data = User::level2list($uid,1,$limit,$param,'id,email');
        }
        if ($level == 3){
            $data = User::level3list($uid,1,$limit,$param,'id,email');
        }
        if(isset($data['data'])){
            foreach ($data['data'] as $k=>$r){
                $data['data'][$k]['account']  = '['.$r['id'].']'.$r['email'];
                $data['data'][$k]['reward']   = WalletLog::where('from_user_id',$r['id'])->sum('balance');
                $data['data'][$k]['recharge'] = Recharge::where('uid',$r['id'])->where('status',1)->sum('balance');
            }
        }
        return app('json')->success($data);
    }

    /**
     * 邀请列表
     * @param Request $request
     * @return mixed
     * @throws DbException
     */
    public function query(Request $request){
        $uid = $request->param('uid',0,'intval');
        $type = $request->param('type',1,'intval');
        $keys = $request->param('keys','','trim');
        $total = $request->param('total',0,'intval');
        if($uid == 0){
            $uid = $request->uid();
        }
        $map = [];
        if($keys){
            $map[] = ["mobile|nickname","LIKE", "%{$keys}%"];
        }
        $limit = $request->param('limit',10,'intval');
        if($type == 2){
            $map[] = ['level','=',2];
            $map[] = ['parent_id','=',$uid];
            $list  = Db::view('relation_team','*')
                ->view('user','grade_id,nickname,mobile,reg_time','user.id = relation_team.uid','LEFT')
                ->view('relation','referee_time','relation.uid = user.id','LEFT')
                ->view('user_grade','grade_name','user_grade.id = user.grade_id')
                ->where($map)
                ->order('relation_team.date_time DESC')
                ->paginate(['list_rows' => $limit,'query' =>['limit'=>$limit]], false)
                ->toArray();
        }else{
            $map[] = ['referee_id','=',$uid];
            $list = Db::view('relation', 'id,uid,referee_id,referee_time')
                ->view('user', 'grade_id,mobile,nickname,reg_time,last_login_time','user.id = relation.uid')
                ->view('user_data', 'avatar', 'user_data.uid = relation.uid')
                ->view('user_grade', 'grade_name,growth,discount', 'user_grade.id = user.grade_id')
                ->where($map)
                ->order('relation.referee_time DESC')
                ->paginate(['list_rows' => $limit,'query' =>['limit'=>$limit]], false)
                ->toArray();
        }
        foreach ($list['data'] as $k=>$r){
            if(empty($r['avatar'])){
                $list['data'][$k]['avatar'] = getConfig('config_app_url').url('tool/avatar/index',['uid'=>$r['uid']]);
            }
            $list['data'][$k]['referee_time'] = date('Y-m-d H:i:s',$r['referee_time']);
            if($total == 1){
                $list['data'][$k]['total_amount'] = WalletLog::where(['uid'=>$r['uid'],'actype'=>0,'is_hide'=>0,'pay_status'=>1])->count();
                $list['data'][$k]['friends'] = Relation::where(['referee_id'=>$r['uid']])->count();
            }
        }
        if($total == 1){
            $list['total_user'] = Relation::where(['referee_id'=>$uid])->count();
        }
        return app('json')->success($list);
    }

    /**
     * 团队列表
     * @param Request $request
     * @return mixed
     * @throws DbException
     */
    public function team(Request $request){
        $keys  = $request->get('keys','');
        $param = $request->param();
        $limit = $request->param('limit',20,'intval');
        $type  = $request->param('type','','trim');
        $uid   = $request->param('uid',0,'intval');
        $where = [];
        if($uid == 0){
            return app('json')->fail('缺少参数');
        }
        $where['parent_id'] = $uid;
        if($type=='zt'){
            $where['level'] = 1;
        }
        if($keys){
            $where['username|mobile|nickname|referee_name'] = $keys;
        }
        $data = RelationTeam::teamDb()
            ->where($where)
            ->order('level asc')
            ->paginate(['list_rows' => $limit,'query' =>$param], false)
            ->toArray();

        foreach ($data['data'] as $k=>$r){
            $my_team_ids = RelationTeam::where( ['parent_id'=>$r['uid']] )->column('uid');
            $my_team_ids[] = $r['uid'];
            $data['data'][$k]['avatar']   = getConfig('config_app_url').url('tool/avatar/index',['uid'=>$r['uid']]);
            $data['data'][$k]['my_team']  = RelationTeam::where([ ['parent_id','=',$r['uid']],['level','>',1] ])->count();
            $data['data'][$k]['zt_team']  = RelationTeam::where(['parent_id'=>$r['uid'],'level'=>1])->count();
            $data['data'][$k]['my_order_num']   = Order::where(['uid'=>$r['uid']])->count();
            $data['data'][$k]['team_order_num'] = Order::where([['uid','IN',$my_team_ids]])->count();
            $data['data'][$k]['referee_time'] = date('Y-m-d H:i:s',$r['referee_time']);
        }
        return app('json')->success($data);
    }

    /**
     * 获取推广海报
     * @return void
     */
    public function poster(Request $request){
        //是否更新海报 1是，0否
        $update = $request->param('update',0,'intval');
        $uid    = $request->uid();
        $data = Relation::poster($uid,$update);
        if($update==1){
            $data = $data.'?t='.time();
            return app('json')->success(['poster'=>$data]);
        }
        return app('json')->success(['poster'=>$data]);
    }
}