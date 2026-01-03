<?php
/**
 * Created by PhpStorm.
 * Explain: swiper模块
 */
namespace app\swiper\controller;
use app\swiper\model\Swiper;
use app\common\traits\ControllerTrait;
class Index extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new Swiper();
    }
    use ControllerTrait;
    /**
     * 列表
     */
    public function index()
    {
        $keys    = $this->request->param('keys','','trim');
        $limit   = $this->request->param('limit',20,'intval');
        $params  = $this->request->param();
        if($this->request->isAjax()){
            $map = [];
            if($keys){
                $map[] = ["title|tag","LIKE", "%{$keys}%"];
            }
            $data = Swiper::getListPage($map,$limit,'id desc',$params);
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("limit", $limit);
        $this->assign("url", url('index'));
        return $this->fetch();
    }

    /**
     * 编辑
     * @return mixed
     */
    public function view(){
        $id = input('param.id', 0, 'intval');
        if($id == 0){
            return self::error('缺少ID');
        }
        $param = $this->request->param();
        $this->assign($param);
        $data = Swiper::get(['id'=>$id]);
        if(!$data){
            return self::error('数据不存在！');
        }
        $this->assign($data->toArray());
        return $this->fetch();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $param  = $this->request->param();
            $swiper = $param['swiper'];
            $data = [];
            if(count($swiper)>0 && isset($swiper['pic']) && $swiper['pic']){
                foreach ($swiper['pic'] as $k=>$v){
                    $data[] = [
                        'name'=>$swiper['name'][$k],
                        'num'=>$swiper['num'][$k],
                        'pic'=>$swiper['pic'][$k],
                        'url'=>$swiper['url'][$k],
                    ];
                }
            }
            $swiper_data = serialize($data);
            if($swiper_data){
                $param['swiper'] = $swiper_data;
            }else{
                $param['swiper'] = '';
            }
            // 数据验证
            $validate = validate('Swiper',[],false,false);
            if (!$validate->check($param)) {
                return self::error($validate->getError());
            }
            if(Swiper::create($param)){
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
        $id = input('param.id', 0, 'intval');
        if ($id == 0) {
            return self::error('缺少ID！');
        }
        if ($this->request->isPost()) {
            $param  = $this->request->param();
            $swiper = $param['swiper'];
            $data = [];
            if(count($swiper)>0 && isset($swiper['pic']) && $swiper['pic']){
                foreach ($swiper['pic'] as $k=>$v){
                    $data[] = [
                        'name'=>$swiper['name'][$k],
                        'num'=>$swiper['num'][$k],
                        'pic'=>$swiper['pic'][$k],
                        'url'=>$swiper['url'][$k],
                    ];
                }
            }
            $swiper_data = serialize($data);
            if($swiper_data){
                $param['swiper'] = $swiper_data;
            }else{
                $param['swiper'] = '';
            }
            // 数据验证
            $validate = validate('Swiper',[],false,false);
            if (!$validate->check($param)) {
                return self::error($validate->getError());
            }
            if(Swiper::update($param,['id'=>$id])){
                return self::success('编辑成功！');
            }
            return self::error('编辑失败！');
        }
        $result = Swiper::get($id);
        if(!isset($result)){
            return self::error('信息不存在！');
        }
        $data = $result->toArray();
        $this->assign($data);
        return $this->fetch();
    }
}