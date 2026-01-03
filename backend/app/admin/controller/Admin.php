<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 管理员管理
 */
namespace app\admin\controller;
use app\admin\model\Admin as AdminUser;
use app\common\traits\ControllerTrait;
use app\common\model\User;
use RobThree\Auth\TwoFactorAuth;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\facade\Db;
use think\Tree;
use app\admin\model\Group;
class Admin extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new AdminUser();
    }
    use ControllerTrait;
    
    public function index()
    {
        $key   = $this->request->get('key','');
        $param = $this->request->param();
        $limit = $this->request->param('limit',20,'intval');
        if($this->request->isAjax()){
            $where = [];
            if($key){
                $where[] = ['user.phone|user.nickname','LIKE',"%$key%"];
            }
            $where[] = ['admin.uid','>',1];
            $data = Db::view('admin','*')
                ->view('user','nickname,phone,email','user.id=admin.uid')
                ->view('auth_group_access','group_id','auth_group_access.uid=admin.id')
                ->view('auth_group','title','auth_group.id=auth_group_access.group_id')
                ->where($where)
                ->order('admin.id desc')
                ->paginate(['list_rows' => $limit,'query' =>$param], false)->toArray();
            return self::result_layui($data);
        }
        $this->assign('key',$key);
        $this->assign('url',url('index',['key'=>$key]));
        $this->assign('limit',$limit);
        return $this->fetch();
    }

    /**
     * 新增
     * @return string
     * @throws DbException
     */
    public function add()
    {
        $param = $this->request->param();
        if( $this->request->isPost() ){
            //验证数据
            $validate = validate('Admin',[],false,false);
            if( !$validate->check($param) ){
                return self::error($validate->getError());
            }
            $param['email'] = $param['phone'].'@w.com';
            $result = AdminUser::register($param);
            if($result['error'] == 1){
                return self::success('新增成功！');
            }
            return self::error($result['error']);
        }
        $result = Group::getList(['status'=>1],0,'sort asc,id desc');
        $tree   = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ', '&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str = "<option value='\$id'> \$spacer \$title</option>";
        $tree->init($result);
        $list = $tree->get_tree(0, $str);
        $this->assign("list", $list);
        $this->assign($param);
        return $this->fetch();
    }


    /**
     * 编辑
     */
    public function edit()
    {
        $param = $this->request->param();
        $admin_id = $this->request->param('id',0,'');
        if($admin_id == 0){
            return self::error('缺少id！');
        }
        $uid = AdminUser::where(['id'=>$admin_id])->value('uid');
        if( $this->request->isPost() ){
            $validate = validate('Admin',[],false,false);
            if( !$validate->scene('edit')->check($param) ){
                return self::error($validate->getError());
            }
            $user = [
                'nickname'=>$param['nickname'],
                'update_time'=>time()
            ];
            if(isset($param['phone']) && $param['phone'] ){
                $user['phone'] = $param['phone'];
            }
            if(isset($param['email']) && $param['email'] ){
                $user['email'] = $param['email'];
            }
            if($param['password']){
                $user['password'] = $param['password'];
            }
            $result_1 = User::update($user,['id'=>$uid]);
            $result_2 = Db::name('auth_group_access')->where(['uid'=>$admin_id])->save( ['group_id'=>$param['group_id']] );
            if($result_1 || $result_2){
                return self::success('更新成功');
            }
            return self::error('更新失败');
        }

        $group_id = Db::name('auth_group_access')->where(['uid'=>$admin_id])->value('group_id');
        $result   = Group::getList(['status'=>1],0,'sort asc,id desc');
        foreach ($result as $k=>$r) {
            $result[$k]['selected'] = '';
            if( ($result[$k]['id'] == $group_id) && ($group_id > 0) ){
                $result[$k]['selected'] = 'selected';
            }
        }
        $tree   = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ', '&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str  = "<option value='\$id' \$selected > \$spacer \$title</option>";
        $tree->init($result);
        $list = $tree->get_tree(0, $str);
        $this->assign("list", $list);

        $data = Db::view('admin','*')
            ->view('user','phone,email,nickname','user.id=admin.uid')
            ->view('auth_group_access','group_id','auth_group_access.uid=admin.id')
            ->view('auth_group','title','auth_group.id=auth_group_access.group_id')
            ->where(['admin.id'=>$admin_id])
            ->find();

        if(!$data){
            return self::error('数据不存在');
        }
        $this->assign($data);
        $this->assign($param);
        return $this->fetch();
    }

    /**
     * 更新个人资料
     * @return string
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function update(){
        $param = $this->request->param();
        if( $this->request->isPost() ){
            $validate = validate('Admin',[],false,false);
            if( !$validate->scene('edit')->check($param) ){
                return self::error($validate->getError());
            }
            $user = [
                'nickname'=>$param['nickname'],
                'phone'=>$param['phone'],
                'update_time'=>time()
            ];
            if($param['password']){
                $user['password'] = $param['password'];
            }
            if($param['email']){
                $user['email'] = $param['email'];
            }
            $result_1 = User::update($user,['id'=>$this->uid]);
            $result_2 = Db::name('auth_group_access')->where(['uid'=>$this->admin_id])->save( ['group_id'=>$param['group_id']] );
            if($result_1 || $result_2 ){
                return self::success('更新成功');
            }
            return self::error('更新失败');
        }

        $group_id = Db::name('auth_group_access')->where(['uid'=>$this->admin_id])->value('group_id');
        $result   = Group::getList(['status'=>1],0,'sort asc,id desc');
        foreach ($result as $k=>$r) {
            $result[$k]['selected'] = '';
            if( ($result[$k]['id'] == $group_id) && ($group_id > 0) ){
                $result[$k]['selected'] = 'selected';
            }
        }
        $tree   = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ', '&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str  = "<option value='\$id' \$selected > \$spacer \$title</option>";
        $tree->init($result);
        $list = $tree->get_tree(0, $str);
        $this->assign("list", $list);

        $data = Db::view('admin','*')
            ->view('user','email,phone,nickname','user.id=admin.uid')
            ->view('auth_group_access','group_id','auth_group_access.uid=admin.uid')
            ->view('auth_group','title','auth_group.id=auth_group_access.group_id')
            ->where(['admin.uid'=>$this->uid])
            ->find();

        if(!$data){
            return self::error('数据不存在');
        }
        $this->assign($data);
        $this->assign($param);
        return $this->fetch();
    }

    /**
     * 绑定谷歌验证
     */
    public function binding(){
        $id = $this->request->param('id','');
        $app_name = config('app.app_name');
        if(!$id){
            return self::error('参数错误！');
        }
        if($this->request->isPost()){
            $secret_key = $this->request->param('secret_key','','trim');
            if(!$secret_key){
                return self::error('参数错误！');
            }
            $rt = AdminUser::update(['secret_key'=>$secret_key,'is_bind'=>1],['id'=>$id]);
            if($rt){
                return self::success('绑定成功！');
            }
            return self::error('绑定失败！');
        }

        $user = AdminUser::getToArray(['id'=>$id],'',['users']);
        // 创建一个 TwoFactorAuth 实例，设置应用名称、认证码长度以及每个认证码的有效时间
        $auth  = new TwoFactorAuth($app_name);
        if($user['is_bind']&&$user['secret_key']){
            $secret_key = $user['secret_key'];
        }else{
            // 生成一个随机的密钥
            $secret_key = $auth->createSecret();
        }
        // 生成一个供用户扫描的二维码，其中包含用户名和密钥
        $qrCodeUrl = $auth->getQRCodeImageAsDataUri($user['email'], $secret_key);
        $this->assign([
            'id' => $id,
            'qrCodeUrl' => $qrCodeUrl,
            'secret_key'=>$secret_key,
            'user'=>$user,
        ]);
        return $this->fetch();
    }

    /**
     * 解绑谷歌验证
     */
    public function unbinding(){
        $id = $this->request->param('id','');
        if(!$id){
            return self::error('参数错误！');
        }
        $rt = AdminUser::update(['secret_key'=>'', 'is_bind'=>0],['id'=>$id]);
        if($rt){
            return self::success('解绑成功！');
        }
        return self::error('解绑失败！');
    }
}
