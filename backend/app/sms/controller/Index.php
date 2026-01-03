<?php
/**
 * Created by PhpStorm.
 * Explain: 短信模块
 */
namespace app\sms\controller;
use app\sms\model\SmsLog;
use app\sms\services\SmsService;
use app\common\traits\ControllerTrait;
use core\utils\Tools;
use app\Request;
class Index extends \app\AdminInit
{
    protected $model;
    // 初始化
    protected function initialize(){
        parent::initialize();
        $this->model = new SmsLog();
    }
    use ControllerTrait;
    /**
     * 列表
     */
    public function index()
    {

        $keys    = $this->request->param('keys','','trim');
        $limit   = $this->request->param('limit',20,'intval');
        $start_time = $this->request->param('start_time','','trim');
        $end_time   = $this->request->param('end_time','','trim');
        $params  = $this->request->param();
        if($this->request->isAjax()){
            $map = [];
            if($keys){
                $map[] = ["content|phone","LIKE", "%{$keys}%"];
            }
            $_date = [];
            if ($start_time) {
                $start_time = strtotime($start_time);
                $_date = ['mall_order.add_time','>=', $start_time];
            }
            if ($end_time) {
                $end_time = strtotime($end_time);
                $_date = ['mall_order.add_time','<=', $end_time];
            }
            if ($end_time && $start_time) {
                $_date = [['mall_order.add_time','>=', $start_time], ['mall_order.add_time','<=', $end_time]];
            }
            if($_date){
                $map[] = $_date;
            }
            $data = SmsLog::getListPage($map,$limit,'id desc',$params);
            return self::result_layui($data);
        }
        $this->assign("keys", $keys);
        $this->assign("limit", $limit);
        $this->assign("url", url('index'));
        // 剩余短信
        $sms = SmsService::count();
        if( !isset($sms['balance']) ){
            $sms['balance'] = 0;
            $sms['transactional_balance'] = 0;
        }
        $this->assign($sms);
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
        $data = SmsLog::get(['id'=>$id]);
        if(!$data){
            return self::error('数据不存在！');
        }
        $this->assign($data->toArray());
        return $this->fetch();
    }

    /**
     * 发送短信
     */
    public function send(){
        if($this->request->isAjax()){
            $phone   = $this->request->param('phone','','trim');
            $content = $this->request->param('content','','trim');
            if (!$phone){
                return self::error('请填写手机号！');
            }
            if (!$content){
                return self::error('请填写短信内容！');
            }
            $data = SmsService::send2($phone,$content);
            if($data['status'] == 1){
                return self::success($data['msg']);
            }
            return self::error($data['msg']);
        }
        return $this->fetch();
    }

    /**
     * 重新发送
     */
    public function reply(){
        $id = $this->request->param('id',0,'intval');
        if($id == 0){
            return self::error('缺少ID');
        }
        $data = SmsLog::get(['id'=>$id]);
        if(!$data){
            return self::error('数据不存在！');
        }
        $data = $data->toArray();
        return SmsService::send2($data['phone'],$data['content']);
    }
}