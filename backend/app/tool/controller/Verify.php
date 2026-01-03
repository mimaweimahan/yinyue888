<?php
// +----------------------------------------------------------------------
// | 验证码处理
// | author: TT
// +----------------------------------------------------------------------
namespace app\tool\controller;
use think\captcha\facade\Captcha;
use think\facade\Config;
class Verify {
    public function index() {
        $imageW   = input('get.w',120,'intval');
        $imageH   = input('get.h',50,'intval');
        $length   = input('get.l',4,'intval');
        $fontSize = input('get.f',20,'intval');
        $type     = input('get.type',0,'intval'); // 1-字母加数字 0 - 纯数组验证码
        $cfg = [
            'fontSize' => $fontSize, // 字体大小
            'length'   => $length,// 验证码位数
            'imageW'   => $imageW,
            'imageH'   => $imageH,
            'useNoise' => false, // 关闭验证码杂点
            'useCurve' => false
        ];
        if($type==0){
            $cfg['codeSet'] = '0123456789';
        }
        Config::set($cfg,'captcha');
        return Captcha::create();
    }
}
