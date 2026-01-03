<?php
namespace app\sms\services;
use think\facade\Config;
use app\sms\model\SmsLog;
use app\sms\model\SmsTemplate;
use core\utils\Tools;
/**
 * 赛邮云通信
 * www.mysubmail.com
 * Class SMSService
 * @package crmeb\services
 */
class SmsService
{
    // 短信账号
    private static $APP_ID = '55605';

    // 短信token
    private static $APP_KEY = '88cf38da59cd3919375da62dd33d511a';

    public static $status;

    // 短信接口
    private static $API_URL = 'https://api.mysubmail.com/message/send';

    // 短信模板发送接口
    private static $API_TPL_Url = 'https://api.mysubmail.com/message/xsend';

    // 余额查询接口
    private static $NUM_URL = 'https://api.mysubmail.com/balance/sms';

    public function __construct()
    {
        self::$status = strlen(Config::get('sms_account')) != 0 ?? false && strlen(Config::get('sms_token')) != 0  ?? false;
        if(Config::get('sms_account')){
            self::$APP_ID = Config::get('sms_account');
        }
        if(Config::get('sms_token')){
            self::$APP_KEY = Config::get('sms_token');
        }
    }

    /**
     * 发送短信
     * @param $phone
     * @param int $template
     * @param array $param
     * @return array
     */
    public static function send($phone, $template, array  $param)
    {
        $content = self::getSmsTpl($template,$param);
        if(!$content){
            return ['status'=>400,'msg'=>'获取短信模板失败'];
        }
        $_result = Tools::httpRequest('POST', self::$API_URL,['appid'=>self::$APP_ID,'signature'=>self::$APP_KEY,'to'=>$phone,'content'=>$content]);
        $result  = json_decode($_result,true);
        $status = 0;
        if (isset($result['status'])&&($result['status'] == 'success')) {
            $status = 1;
        }
        // 记录
        SmsLog::create([
            'phone'=>$phone,
            'content'=>$content,
            'status'=>$status,
            'result'=>isset($result['msg'])?$result['msg']:$status,
            'create_time'=>time()
        ]);
        if($status){
            return ['status'=>1,'msg'=>'发送成功！'];
        }
        $msg = isset($result['msg'])?$result['msg']:'发送失败';
        return ['status'=>0,'msg'=>$msg];
    }

    /**
     * 发送短信（非模板）
     * @param string $tel
     * @param string $content
     * @return array
     */
    public static function send2($tel,$content){
        $_result = Tools::httpRequest('POST', self::$API_URL,[
            'appid'=>self::$APP_ID,
            'signature'=>self::$APP_KEY,
            'to'=>$tel,
            'content'=>$content
        ]);
        $result  = json_decode($_result,true);
        $status = 0;
        if (isset($result['status'])&&($result['status'] == 'success')) {
            $status = 1;
        }
        // 记录
        SmsLog::create([
            'phone'=>$tel,
            'content'=>$content,
            'status'=>$status,
            'result'=>isset($result['msg'])?$result['msg']:$status,
            'create_time'=>time()
        ]);
        if($status){
            return ['status'=>1,'msg'=>'发送成功！'];
        }
        $msg = isset($result['msg'])?$result['msg']:'发送失败';
        return ['status'=>0,'msg'=>$msg];
    }

    /**
     * 获取短信模板
     * @param int $template
     * @param array $param
     * @return string
     */
    public static function getSmsTpl($template,array $param){
        $content = (new SmsTemplate())->where(['template_id'=>$template])->value('content');
        if(!$content){
            return '';
        }
        foreach($param as $key => $value) {
            $content = str_replace('{$'."$key".'}',$value,$content);
        }
        return $content;
    }

    /**
     * 账号余额信息
     * @return mixed
     */
    public static function count()
    {
        $result = Tools::httpRequest('POST', self::$NUM_URL,[
            'appid'=>self::$APP_ID,
            'signature'=>self::$APP_KEY
        ]);
        $_data  = json_decode($result,true);
        if(isset($_data['status']) && $_data['status'] == 'success'){
            return $_data;
        }
        return ['balance'=>0,'transactional_balance'=>0];
    }
}