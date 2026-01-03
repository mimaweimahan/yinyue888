<?php
/**
 * Explain: 产品模块
 */
namespace app\goods\controller;
use app\common\traits\ControllerTrait;
use app\goods\model\Goods;
use app\goods\model\Type;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\response\Json;
use think\Tree;
use function input;
use function str2arr;
use function thumb;
use function validate;

class Index extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new Goods();
    }
    use ControllerTrait;
    /**
     * 列表
     * @return string|Json
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function index() {
        $where = [];
        $params   = $this->request->param();
        $keys     = $this->request->param('keys','','trim');
        $type_id  = $this->request->param('type_id',0,'intval');
        $limit    = $this->request->param('limit',10,'intval');
        $mall     = $this->request->param('mall','','trim');
        if($this->request->isAjax()){
            if($keys){
                $where[] = ["title","LIKE","%{$keys}%"];
            }
            if($type_id>0){
                $type_id_s = Type::where('id',$type_id)->value('child_ids');
                if($type_id_s){
                    $where[] = ['type_id','IN',$type_id_s];
                }else{
                    $where[] = ['type_id','=',$type_id];
                }
            }
            if($mall){
                $where[] = ['mall','=',$mall];
            }
            $data = Goods::with(['type'])
                ->where($where)
                ->withAttr('image',function ($value){
                    if(trim($value)){
                        $value  = thumb($value);
                    }
                    return $value;
                })
                ->order(['is_top'=>'DESC','sort'=>'DESC','status'=>'ASC','add_time'=>'DESC'])
                ->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();
            return self::result_layui($data);
        }
        $type_list = Type::allData($type_id);
        $this->assign("keys", $keys);
        $this->assign("url", url('index'));
        $this->assign("limit", $limit);
        $this->assign("type_id", $type_id);
        $this->assign('type_list', self::getType($type_id,0));
        $this->assign('goods_type', json_encode($type_list));
        return $this->fetch();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        $type_id = $this->request->param('type_id',0,'intval');
        $params  = $this->request->param();
        if ($this->request->isPost()) {
            // 数据验证
            $validate = validate('Goods',[],false,false);
            if (!$validate->check($params)) {
                return self::error($validate->getError());
            }
            $_model = Goods::create($params);
            if ($_model->id) {
                return self::success('添加成功！');
            }
            return self::error('添加失败！');
        }
        $this->assign("type_id", $type_id);
        $this->assign('type_list', self::getType($type_id,1));
        return $this->fetch();
    }

    /**
     * 编辑
     */
    public function edit()
    {
        $goods_id = input('param.id', 0, 'intval');
        if ($goods_id == 0) {
            return self::error('缺少ID！');
        }
        $params  = $this->request->param();
        if ($this->request->isPost()) {

            // 数据验证
            $validate = validate('Goods',[],false,false);
            if (!$validate->check($params)) {
                return self::error($validate->getError());
            }
            if ( Goods::update($params,['id'=>$goods_id]) ) {
                return self::success('编辑成功！');
            }
            return self::error('编辑失败！');
        }
        $result = Goods::with(['type'])->where(['id'=>$goods_id])->find();
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $data = $result->toArray();
        $this->assign($data);
        $this->assign('type_list', self::getType($data['type_id']),1);
        return $this->fetch();
    }

    /**
     * 移动
     */
    public function move(){
        $ids = input('param.ids', '', 'trim');
        if (empty($ids)) {
            return self::error('请选择需要操作的商品');
        }
        if ($this->request->isPost()) {
            $type_id = input('param.type_id', 0, 'intval');
            if ($type_id==0) {
                return self::error('请选择转移分类');
            }
            $ids = str2arr($ids);
            $rt = Goods::update(['type_id'=>$type_id],[['id','IN',$ids]]);
            if($rt){
                return self::success("操作成功！");
            }
            return self::error('操作失败');
        }
        $this->assign('ids',$ids);
        $this->assign('type_list', self::getType());
        return $this->fetch();
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
        if (Goods::whereIn('id', $_ids)->delete()) {
            return self::success("操作成功！");
        }
        return self::error('执行失败');
    }
    /**
     * 批量更新
     */
    public function config(){
        if ($this->request->isPost()) {
            $prices      = $_POST['price']; // 售价
            $daily_sale  = $_POST['daily_sale'];
            $total_sales = $_POST['total_sales'];
            $incr_rate   = $_POST['incr_rate'];
            if(empty($stock) && empty($daily_sale) && empty($total_sales)&& empty($incr_rate)) return self::error("缺少必要数据");
            foreach ($prices as $id => $price) {
                $data = [];
                $data['price'] = $price;
                if(isset($daily_sale)){
                    $data['daily_sale'] = $daily_sale[$id];
                }
                if(isset($total_sales)){
                    $data['total_sales'] = $total_sales[$id];
                }
                if(isset($incr_rate)){
                    $data['incr_rate'] = $incr_rate[$id];
                }
                Goods::update($data,['id'=>$id]);
            }
            return self::success('操作成功！');
        }
        return self::error("选择你要更新的信息");
    }


    /**
     * 获取产品分类
     */
    private static function getType($pid=0,$disabled=0){
        /*
        $type_list = cache('goods_type');
        if(!$type_list){
            $type_list = Type::typeCache();
        }
        */
        $map = [];
        $type_list = Type::getList($map,0,['sort'=>'ASC', "id" => "ASC"]);
        if(!$type_list){
            return false;
        }
        foreach ($type_list as $k=>$r) {
            $type_list[$k]['disabled'] = '';
            $type_list[$k]['selected'] = false;
            if($r['id'] == $pid && $pid > 0){
                $type_list[$k]['selected'] = 'selected';
            }
            if($r['child'] == 1 && $disabled==1){
                $type_list[$k]['disabled'] = 'disabled';
            }
        }
        $tree = new Tree();
        $tree->parent = "pid";
        $tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;';
        $str  = "<option value='\$id' \$disabled \$selected> \$spacer \$type_name</option>";
        $tree->init($type_list);
        return $tree->get_tree(0, $str);
    }

    /**
     * 复制
     */
    public function copy(){
        $id = input('param.id', 0,'intval');
        if ($id == 0) {
            return self::error("缺少复制对象");
        }
        $goods = Goods::getToArray(['id' => $id]);
        if(!$goods){
            return self::error("复制对象不存在");
        }
        unset($goods['id']);
        Goods::create($goods);
        return self::success("操作成功！");
    }
}