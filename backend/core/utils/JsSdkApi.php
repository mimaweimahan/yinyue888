<?php
// +----------------------------------------------------------------------
// | TT[ 管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020~2030 https://www.x.com All rights reserved
// +----------------------------------------------------------------------
// | Licensed TT[管理系统]并不是自由软件，未经许可不能去掉TT相关版权及二次开发
// +----------------------------------------------------------------------
// | Author: TT
// +----------------------------------------------------------------------
namespace core\utils;
use function cache;

class JsSdkApi {
    /**
     * 微信网页JSSDK 获取签名字符串
     * @param string $app_id
     * @param string $app_secret
     * @param string $url //页面地址
     * @return array
     */
    public static function init($app_id='',$app_secret='',$url=''){
        if(!$app_id || !$app_secret){
            return [];
        }
        if(!$url){
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url  = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }
        $argu = [];
        $argu['jsApiList'] = ['openAddress', 'updateTimelineShareData', 'updateAppMessageShareData', 'onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone', 'startRecord', 'stopRecord', 'onVoiceRecordEnd', 'playVoice', 'pauseVoice', 'stopVoice', 'onVoicePlayEnd', 'uploadVoice', 'downloadVoice', 'chooseImage', 'previewImage', 'uploadImage', 'downloadImage', 'translateVoice', 'getNetworkType', 'openLocation', 'getLocation', 'hideOptionMenu', 'showOptionMenu', 'hideMenuItems', 'showMenuItems', 'hideAllNonBaseMenuItem', 'showAllNonBaseMenuItem', 'closeWindow', 'scanQRCode', 'chooseWXPay', 'openProductSpecificView', 'addCard', 'chooseCard', 'openCard'];
        $argu['appId']     = $app_id;
        $argu['beta']      = false;
        $argu['debug']     = false;
        $argu['url']       = $url;
        $argu['nonceStr']  = self::createNonceStr();
        $argu['timestamp'] = time();
        $access_token = self::getAccessToken($app_id, $app_secret);
        $argu['jsapi_ticket'] = self::getJsApiTicket($access_token);
        $string = "jsapi_ticket=".$argu['jsapi_ticket']."&noncestr=".$argu['nonceStr']."&timestamp=".$argu['timestamp']."&url=".$argu['url'];
        $argu['signature'] = sha1(trim($string));
        return $argu;
    }
    /**
     * php curl 请求链接
     * 当$post_data为空时使用GET方式发送
     * @param string $url
     * @param string $post_data
     * @return mixed
     */
    public static function curlSend($url ='',$post_data=""){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        if($post_data != ""){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    /**
     * 调用接口获取 $access_token
     * 微信缓存 7200 秒，这里使用thinkphp的缓存方法
     * @return string Ambigous <mixed, Thinkmixed, object>
     */
    public static function getAccessToken($app_id='',$app_secret=''){
        if(!$app_id || !$app_secret){
            return false;
        }
        $access_token = false;
        if($access_token == false){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$app_id."&secret=".$app_secret;
            $json = self::curlSend($url);
            $data = json_decode($json,true);
            if(isset($data['access_token'])){
                $access_token = $data['access_token'];
            }
        }
        return $access_token;
    }

    /**
     * 微信网页JSSDK  调用接口获取 $jsapi_ticket
     * 微信缓存 7200 秒，这里使用thinkphp的缓存方法
     * @param string $access_token
     * @return mixed
     */
    public static function getJsApiTicket($access_token=''){
        $jsapi_ticket = cache($access_token);
        if(!$jsapi_ticket){
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$access_token."&type=jsapi";
            $json = self::curlSend($url);
            $data = json_decode($json,true);
            if(isset($data['ticket'])){
                cache($access_token,$data['ticket'],7000);
                $jsapi_ticket = cache($access_token);
            }
        }
        return $jsapi_ticket;
    }

    /**
     * 获取随机字符串
     * @param int $length
     * @return string
     */
    public static function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
}