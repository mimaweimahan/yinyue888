<?php
/**
 * @Description : 短信
 * @Author : TT
 */
namespace app\common\service;
use think\facade\Config;
class SmsService
{
    // 短信账号
    private static $APP_ID = '556051';
    // 短信token
    private static $APP_KEY = 'x';
    public  static $status;
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
     * 发送短信（非模板）
     * @param string $tel
     * @param string $content
     * @return array
     */
    public static function send($tel,$content){
        $_result = http_post(self::$API_URL,[
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
       /*
           SmsLog::create([
                'phone'=>$tel,
                'content'=>$content,
                'status'=>$status,
                'result'=>isset($result['msg'])?$result['msg']:$status,
                'create_time'=>time()
            ]);
       */
        if($status){
            return ['status'=>1,'msg'=>'发送成功！'];
        }
        $msg = isset($result['msg'])?$result['msg']:'发送失败';
        return ['status'=>0,'msg'=>$msg];
    }

    /**
     * 账号余额信息
     * @return mixed
     */
    public static function count()
    {
        $result = http_post(self::$NUM_URL,[
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
