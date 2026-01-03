<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 日志管理模型
 */
namespace app\admin\model;
use app\common\model\BaseModel;
class Log extends BaseModel
{
    protected $name = 'log';
    protected $pk   = 'id';
    protected $auto = ['time'];
    // 处理update_time数据
    protected function setTimeAttr()
    {
        return time();
    }

    /**
     * 记录日志
     * @param string $message 说明
     * @param int $status
     * @param int $uid 用户ID
     * @return bool
     */
    public function record($message='', $status = 0,$uid=0) {
        $fangs = 'GET';
        $request = request();
        if ($request->isAjax()) {
            $fangs = 'AJAX';
        } else if ($request->isPost()) {
            $fangs = 'POST';
        }
        $_module  = $request->module();
        $_module .= '-'.$request->controller();
        $_module .= '-'.$request->action();
        $_uid     = 0;
        $_admin = new \app\admin\logic\Admin();
        $admin = $_admin->loginInfo();

        $_user_id = $admin['admin_id'];
        if( $uid>0 ){
            $_uid = $uid;
        }else if( $_user_id>0 ){
            $_uid = $_user_id;
        }
        $request_data = input('param.');
        if($_uid){
            $data = array(
                'uid' =>$_uid,
                'status' => $status,
                'nickname'=> $admin['nickname'],
                'info' => "操作提示：{$message} <br/>请求方式：{$fangs}",
                'url' => $_SERVER['REQUEST_URI'],
                'ip'=>$request->ip(),
                'data'=>array2string($request_data)
            );
            //$this->create($data);
            return $this->create($data) !== false ? true : false;
        }else{
            return false;
        }

    }

    /**
     * 删除一个月前的日志
     * @return boolean
     */
    public function deleteAMonthago() {
        $map['time'] = ['lt', time() - (86400 * 30) ];
        $status = db('log')->where($map)->delete();
        return $status !== false ? true : false;
    }
}