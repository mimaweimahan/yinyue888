<?php
/**
 * Explain: 推荐关系
 */
namespace app\admin\controller\user;
use app\city\model\City;
use app\common\model\user\UserData;
use app\common\model\user\UserGrade;
use think\db\exception\DbException;
use app\common\model\User;
use app\common\traits\ControllerTrait;
use app\api\model\Relation as RelationModel;
use app\api\model\RelationTeam;
class Relation extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new RelationModel();
    }
    use ControllerTrait;
    /**
     * 关系列表
     * @return string|\think\response\Json
     * @throws DbException
     */
    public function index(){
        $keys  = $this->request->get('keys','');
        $param = $this->request->param();
        $limit = $this->request->param('limit',20,'intval');
        $grade_id = $this->request->param('grade_id',0,'intval');
        $export  = $this->request->param('export',0,'intval');
        if($this->request->isAjax()){
            $where = [];
            if($keys){
                $where[] = ['account|nickname|mobile','LIKE',"%$keys%"];
            }
            if($grade_id){
                $where[] = ['user.grade_id','=',$grade_id];
            }
            //数据导出
            if($export){
                $data = RelationModel::ListDb()
                    ->where($where)
                    ->order('relation.id desc')
                    ->select()
                    ->toArray();
                $export_data = [];
                foreach ($data as $r){
                    //'ID','姓名','手机号','等级ID','等级名称','推荐人','推荐人手机号'
                    $referee_phone = '';
                    $referee_name = '';
                    if($r['referee_id']>0){
                        $_referee = User::getToArray(['id'=>$r['referee_id']]);
                        if(isset($_referee['nickname']) && $_referee['nickname']){
                            $referee_name  = $_referee['nickname'];
                            $referee_phone = $_referee['mobile'];
                        }
                    }
                    $export_data[] = [
                        $r['uid'],
                        $r['nickname'],
                        $r['mobile'],
                        $r['grade_id'],
                        $r['grade_name'],
                        $referee_name,
                        $referee_phone,
                    ];
                }
                return app('json')->success($export_data);
            }else{
                $data = RelationModel::ListDb()
                    ->where($where)
                    ->order('relation.id desc')
                    ->paginate(['list_rows' => $limit,'query' =>$param], false)
                    ->toArray();
                foreach ($data['data'] as $k=>$r){
                    $data['data'][$k]['referee_name'] = User::where(['id'=>$r['referee_id']])->value('nickname');
                    $data['data'][$k]['team'] = 0;
                    if($r['team_id']){
                        $team = str2arr($r['team_id'],',');
                        $data['data'][$k]['team'] = count($team);
                    }
                    $data['data'][$k]['agent_area_str'] = '';
                    if($r['agent_area']){
                        $agent_area = str2arr($r['agent_area']);
                        $data['data'][$k]['agent_area'] = City::whereIn('id',$agent_area)->column('area_name');
                    }
                    $data['data'][$k]['referee_time'] = date('Y-m-d H:i:s',$r['referee_time']);
                }
                return self::result_layui($data);
            }
        }
        $this->assign('keys',$keys);
        $this->assign('url',url('index'));
        $this->assign('limit',$limit);
        $this->assign("grade_id", $grade_id);
        $this->assign('grade_list',UserGrade::getList([],0,'id asc'));
        return $this->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $nickname      = $this->request->post('nickname','','trim');
            $account       = $this->request->post('account','','trim');
            $referee_phone = $this->request->post('referee_phone','','trim');
            $referee_time  = $this->request->post('referee_time','','trim');
            if(!$nickname){
                return self::error('请填写被推荐人的姓名');
            }
            if(!$account){
                return self::error('请填写被推荐人的账号或手机号');
            }
            if(!$referee_phone){
                return self::error('请填写推荐人账号');
            }
            $referee_id  = User::where(['account|mobile'=>$referee_phone])->value('id');
            if(!$referee_id){
                return self::error('推荐人账号不存在');
            }
            /*
            if(!validMobile($phone)){
                return self::error('请填写正确的，用户手机号及推荐人手机号');
            }
            */
            $phone = '';
            if(validMobile($account)){
                $phone = $account;
            }
            #1.获取用户的ID
            $uid  = User::where(['account'=>$account])->value('id');
            if($uid){
                // 更新真实名称
                User::update(['nickname'=>$nickname],['id'=>$uid]);
            }else{
                $uid = User::register($account,'321321',$phone,'',$nickname);
            }
            if(!$uid){
                return self::error('未知错误');
            }
            #2.判断是否已经操作了推荐关系
            $referee = RelationModel::where(['uid'=>$uid])->value('id');
            if($referee){
                return self::success('会员已经被推荐过了');
            }
            #3.获取推荐人ID
            if($uid == $referee_id){
                return self::error('自己不能推荐自己！');
            }
            #4.处理团队数据
            // 获取团队数据
            $team_id = RelationModel::where(['uid'=>$referee_id])->value('team_id');
            if($team_id){
                $team_id = $team_id.','.$uid;
            }else{
                $team_id = $referee_id.','.$uid;
            }
            $be = RelationModel::insertGetId([
                'uid'=>$uid,
                'referee_id'=>$referee_id,
                'team_id'=>$team_id,
                'referee_time'=>strtotime($referee_time)
            ]);
            #5.创建团层级关系
            $team_id_arr = str2arr($team_id,',');
            // 更新会员类别
            User::update(['type_id'=>2],[['id','IN',$team_id_arr]]);
            $team_id_arr = array_reverse($team_id_arr,true);
            $level = 1;
            foreach ($team_id_arr as $rf_id){
                if($rf_id != $uid){
                    $being = RelationTeam::where(['uid'=>$uid,'parent_id'=>$rf_id])->value('id');
                    if(!$being){
                        RelationTeam::create(['uid'=>$uid,'parent_id'=>$rf_id,'level'=>$level]);
                    }
                    $level++;
                }
            }
            if ($be) {
                return self::success('添加成功');
            }
            return self::error('添加失败');
        }else{
            return $this->fetch();
        }
    }

    /**
     * 删除
     */
    public function delete()
    {
        $_ids = input('param.id/a', '');
        if (empty($_ids)) {
            return self::error("选择你要删除的信息");
        }
        $lists = RelationModel::getList([['id','IN',$_ids]],0,'id asc');
        if (RelationModel::whereIn('id', $_ids)->delete()) {
            foreach ($lists as $r){
                RelationTeam::destroy(['uid' => $r['uid']]);
                RelationTeam::destroy(['parent_id' => $r['uid']]);
                RelationModel::destroy(['referee_id' => $r['uid']]);
            }
            return self::success("操作成功");
        }
        return self::error('执行失败');
    }

    /**
     * 代理区域设置
     * @return string
     */
    public function agentarea(){
        $uid = $this->request->param('uid',0,'intval');
        if($this->request->isPost()){
            $area_id = $this->request->param('area_id',0,'intval');
            if($area_id == 0){
                return self::error('缺少area_id');
            }
            $rt = UserData::update(['agent_area'=>$area_id],['uid' => $uid]);
            if($rt){
                return self::success("操作成功");
            }
            return self::error('操作失败');
        }
        $province_id   = $this->request->param('province_id',0,'intval');
        $city_id       = $this->request->param('city_id',0,'intval');
        $area_id       = $this->request->param('area_id',0,'intval');
        $province_list = City::getList(['pid'=>0,'level'=>1],0,'first_py asc,id desc');

        $city_list = [];
        $area_list = [];
        if($province_id>0){
            $city_list = City::getList(['pid'=>$province_id],0,'first_py asc,id desc');
        }
        if($city_id>0){
            $area_list = City::getList(['pid'=>$city_id],0,'first_py asc,id desc');
        }
        $this->assign('uid',$uid);
        $this->assign('province_list',$province_list);
        $this->assign('city_list',$city_list);
        $this->assign('area_list',$area_list);
        $this->assign('province_id',$province_id);
        $this->assign('city_id',$city_id);
        $this->assign('area_id',$area_id);
        return $this->fetch();
    }
}