<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * User: TT
 * Explain: 账户记录
 */
namespace app\admin\controller\user;
use app\common\traits\ControllerTrait;
use app\common\model\user\UserRecord;
use think\db\exception\DbException;
use think\facade\Db;
use think\response\Json;

class Record extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new UserRecord();
    }
    use ControllerTrait;
    /**
     * 列表
     * @return string|Json
     * @throws DbException
     */
    public function index()
    {
        $param = $this->request->param();
        $limit = $this->request->param('limit',20,'intval');
        $where = [];
        if($this->request->isAjax()){
            $keys  = $this->request->param('keys','','trim');
            if($keys){
                $where[] = ["user.account|user.id|user.nickname|user_record.order_number", "LIKE", "%{$keys}%"];
            }
            // 开始时间
            $start_time = $this->request->param('start_time','');
            // 结束时间
            $end_time   = $this->request->param('end_time','');

            $type   = $this->request->param('type',0,'intval');
            $_date = [];
            if (!empty($start_time)) {
                $_date = ['user_record.add_time','>=', strtotime($start_time)];
            }
            if (!empty($end_time)) {
                $_date = ['user_record.add_time','<=', strtotime($end_time)];
            }
            if ($end_time && $start_time ) {
                $_date = [ ['user_record.add_time','>=', strtotime($start_time)], ['user_record.add_time','<=', strtotime($end_time)] ];
            }
            if($_date){
                $where[] = $_date;
            }

            if($type){
                $where[] = ['type','=',$type];
            }

            $data  = Db::view('user_record','*')
                ->view('user','account,nickname','user.id = user_record.uid')
                ->where($where)
                ->order('user_record.add_time desc')
                ->paginate(['list_rows' => $limit,'query' =>$param], false)->toArray();

            foreach ($data['data'] as $k=>$r){
                $data['data'][$k]['add_time'] = date('Y-m-d H:i:s',$r['add_time']);
                $data['data'][$k]['type_name'] = UserRecord::type($r['type']);
            }
            return self::result_layui($data);
        }
        $this->assign($param);
        $this->assign('url',url('index'));
        $this->assign('limit',$limit);
        return $this->fetch();
    }
}