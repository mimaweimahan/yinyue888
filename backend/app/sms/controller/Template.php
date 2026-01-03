<?php
/**
 * Created by PhpStorm.
 * Explain: 短信模块
 */
namespace app\sms\controller;
use app\sms\model\SmsTemplate;
use app\common\traits\ControllerTrait;
class Template extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new SmsTemplate();
    }
    use ControllerTrait;

    /**
     * 列表
     */
    public function index()
    {
        $map = [];
        $keys    = $this->request->param('keys',0,'intval');
        $tpl     = $this->request->param('tpl','index');
        $limit   = $this->request->param('limit',20,'intval');
        $params  = $this->request->param();
        if($this->request->isAjax()){
            if($keys){
                $map["content|template_name"] = ["LIKE", "%{$keys}%"];
            }
            $data = SmsTemplate::getListPage($map,$limit,'id desc',$params);
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("limit", $limit);
        $this->assign("url", url('index'));
        return $this->fetch($tpl);
    }

    /**
     * 新增
     * @return mixed
     */
    public function add(){
        $param = $this->request->param();
        if( $this->request->isPost() ){
            //验证数据
            $validate = validate('Template',[],false,false);
            if( !$validate->check($param) ){
                return self::error($validate->getError());
            }
            if(SmsTemplate::create($param)){
                return self::success('新增成功！');
            }
            return self::error('新增失败！');
        }
        $this->assign($param);
        return $this->fetch();
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit(){
        $id = input('param.id', 0, 'intval');
        if($id == 0){
            return self::error('缺少ID');
        }
        $param = $this->request->param();
        if( $this->request->isPost() ){
            //验证数据
            $validate = validate('Template',[],false,false);
            if( !$validate->check($param) ){
                return self::error($validate->getError());
            }
            if(SmsTemplate::update($param,['id'=>$id])){
                return self::success('更新成功');
            }
            return self::error('更新失败');
        }
        $this->assign($param);
        $data = SmsTemplate::get(['id'=>$id]);
        if(!$data){
            return self::error('数据不存在！');
        }
        $this->assign($data->toArray());
        return $this->fetch();
    }
}