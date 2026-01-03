<?php

namespace app\tool\controller;
use app\Request;
use core\utils\KuaiDi;
use think\facade\View;
use core\utils\BDExpress;
class Express
{

    public function test(){
        $url = "https://acs.m.taobao.com/h5/mtop.taobao.logisticstracedetailservice.queryalltrace/1.0/?jsv=2.6.1&appKey=12574478&t=1727278541721&sign=eaf7be930f06d5aa1817e3dd25f74647&v=1.0&dataType=json&AntiCreep=true&dangerouslySetAlipayParams=%5Bobject%20Object%5D&api=mtop.taobao.logisticstracedetailservice.queryalltrace&encode=1&type=originaljson&data=%7B%22mailNo%22%3A%22434140608395331%22%2C%22orderCode%22%3A%22%22%2C%22cpCode%22%3A%22%22%2C%22appName%22%3A%22GUOGUO%22%2C%22actor%22%3A%22RECEIVER%22%2C%22isAccoutOut%22%3Atrue%2C%22isShowConsignDetail%22%3Atrue%2C%22ignoreInvalidNode%22%3Atrue%2C%22isUnique%22%3Atrue%2C%22isStandard%22%3Atrue%2C%22isShowItem%22%3Atrue%2C%22isShowTemporalityService%22%3Atrue%2C%22isShowCommonService%22%3Atrue%2C%22isStandardActionCode%22%3Atrue%2C%22isOrderByAction%22%3Atrue%2C%22isShowExpressMan%22%3Atrue%2C%22isShowProgressbar%22%3Atrue%2C%22isShowLastOneService%22%3Atrue%2C%22isShowServiceProvider%22%3Atrue%2C%22isShowDeliveryProgress%22%3Atrue%7D";
        $headers = get_headers($url,1);


        if(isset($headers['Set-Cookie'])){
            $headers = $headers['Set-Cookie'];
            if(is_array($headers)){
                $_cookie2  = explode(';',$headers[0])[0];
                $_m_h5_tk  = explode(';',$headers[1])[0];
                $_m_h5_tk  = substr($_m_h5_tk, strripos($_m_h5_tk, "=") + 1);
                dump($_m_h5_tk);
                dump($_cookie2);
            }else{
                $x5secdata = explode(';',$headers)[0];
                dump($x5secdata);
            }
        }else{
            var_dump($headers);
        }
        var_dump($headers);
        $aa = str2arr(';',$headers);
        var_dump($aa);

        //cookie2=1d66c5a0bc80d995e9b22951b7d1bdb3;

    }

    public function detail(Request $request)
    {
        $mailNo = input('mailNo');
        if(empty($mailNo)){
            return app('json')->fail('缺少快递单号',[$mailNo]);
        }

        //  $type = $request->param('type','baidu');
//        if($type == 'baidu'){
//            //View::assign('mailNo',$mailNo);
//            //return View::fetch('view');
//            $res = BDExpress::searchExpress($mailNo);
//          var_dump($res);
//        }

        $data = (new KuaiDi(['number'=>$mailNo]))->query();
//        if($data['msg']=='FAIL_SYS_USER_VALIDATE'){
//            View::assign('url',$data['data']['url']);
//            return View::fetch('yz');
//        }
        if($data['code']==1){
            $data['data']['mailNo'] = $mailNo;
        }
        if(!isset($data['data']['fullTraceDetail'])){
            $data = (new KuaiDi(['number'=>$mailNo]))->query();
            if($data['code']==1){
                $data['data']['mailNo'] = $mailNo;
            }
        }
        $packageStatus = ['newStatusDesc'=>'请长按复制单号'];
        $list = [];
        $express = [
            'cpLogUrl'=>'',
            'webUrl'=>'#',
            'tpName'=>'快递单号',
            'tpContact'=>'',
        ];
        if(isset($data['data']['fullTraceDetail'])){
            $list = $data['data']['fullTraceDetail'];
            $packageStatus = $data['data']['packageStatus'];
        }
        if(isset($data['data']['express'])){
            $express = $data['data']['express'];
        }
        View::assign('express',$express);
        View::assign('data',$list);
        View::assign('mailNo',$mailNo);
        View::assign('packageStatus',$packageStatus);
        return View::fetch();
    }
}