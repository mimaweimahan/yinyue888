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
/**
 * Explain: 工具
 */
class Tools {
    public static function getDate($timestamp) {
        $now = time();
        $diff = $now - $timestamp;
        if ($diff <= 60) {
            return $diff . '秒前';
        } elseif ($diff <= 3600) {
            return floor($diff / 60) . '分钟前';
        } elseif ($diff <= 86400) {
            return floor($diff / 3600) . '小时前';
        } elseif ($diff <= 2592000) {
            return floor($diff / 86400) . '天前';
        } else {
            return '一个月前';
        }
    }
    /**
     * 获取图片转为base64
     * @return bool|string
     */
    public static function put_image($url, $filename = '')
    {
        if ($url == '') {
            return false;
        }
        try {
            if ($filename == '') {
                $ext = pathinfo($url);
                if ($ext['extension'] != "jpg" && $ext['extension'] != "png" && $ext['extension'] != "jpeg") {
                    return false;
                }
                $filename = time() . "." . $ext['extension'];
            }

            //文件保存路径
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
            $path = 'upload/qrcode';
            $fp2 = fopen($path . '/' . $filename, 'a');
            fwrite($fp2, $img);
            fclose($fp2);
            return $path . '/' . $filename;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * 获取图片转为base64
     * @param string $avatar
     * @param int $timeout
     * @return false|string
     */
    public static  function image_to_base64(string $avatar = '', int $timeout = 9)
    {
        $avatar = str_replace('https', 'http', $avatar);
        try {
            $url = parse_url($avatar);
            $url = $url['host'];
            $header = [
                'User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:45.0) Gecko/20100101 Firefox/45.0',
                'Accept-Language: zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3',
                'Accept-Encoding: gzip, deflate, br',
                'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'Host:' . $url
            ];
            $dir = pathinfo($url);
            $host = $dir['dirname'];
            $refer = $host . '/';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_REFERER, $refer);
            curl_setopt($curl, CURLOPT_URL, $avatar);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            $data = curl_exec($curl);
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            if ($code == 200) {
                return "data:image/jpeg;base64," . base64_encode($data);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * 判断表单是否重提交
     * @return bool
     */
    public static function fromToken(){
        $request = request();
        $server = $request->server();
        $data   = $request->param();
        $data['time'] = $server['REQUEST_TIME'];
        $data['agent']= $server['HTTP_USER_AGENT'];
        $sign_str     = self::authSign($data);
        $cache_sign   = cache('from_token');
        if($sign_str == $cache_sign){
            return true;
        }
        cache('from_token', $sign_str, 10);
        return false;
    }
    /**
     * 生成订单号
     * @param string $str
     * @return mixed
     */
    public static function orderNumber(string $str=''){
        $str = $str.date('YmdH').substr(microtime(), 4,5);
        $str = str_replace(' ','',$str);
        return $str;
    }

    public static function security($num=10,$ext=''){
        $t = substr(microtime(), 3,7);
        return $ext.$t.self::GetRandStr($num-7,2);
    }

    /**
     * 根据用户id和成邀请码
     * @param int $uid
     * @param int $num
     * @param int $type 0 只是数字，1只是字母,2数字加字母
     * @return int|string
     */
    public static function inviteCode($uid=0,$num=8,$type=2){
        $uid_num = intval(strlen($uid));
        if($uid_num>$num-1){
            return $uid;
        }
        $x = $num - $uid_num;
        return $uid.self::GetRandStr($x,$type);
    }

    /**
     * ip解析
     * @param $ip
     * @param $type
     * @return bool|mixed|string
     */
     public function ip_to_city($ip,$type=''){
        $_data =  cache('ip_city_'.$ip);
        if(is_array($_data) && isset($_data['city'])){
            return $_data;
        }
        // https://lapi.jd.com/locate?source=ip&callback=jsonpAreaLocate&ip=&_=1591437552885
        switch ($type){
            case 'taobao':
                $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
                $data = self::httpRequest('POST',$url,'');
                break;
            default:
                $app_code = 'c19578f829ca40dc85912a3b6a17b6fa';
                $url = "https://hcapi20.market.alicloudapi.com/ip?ip=".$ip;
                $headers = ['Authorization:APPCODE '.$app_code];
                $data = self::httpRequest('GET',$url,'',$headers);
                break;
        }
        if($data){
            $data = json_decode($data,true);
        }
        $rt = [];
        if(isset($data['data']['city'])){
            $rt = $data['data'];
            $rt['code']  = 1;
            $data['code'] = 1;
            cache('ip_city_'.$ip,$data['data']);
        }
        if(!isset($rt['code'])){
            $rt['code'] = 0;
        }
        return $rt;
    }

    /**
     * 导出CSV数据表
     * @param string $name
     * @param array $head
     * @param array $data
     */
    public static function outCsv(string $name='数据表', array $head=[], array $data=[]){
        $file_name = $name.date("Y_m_d_H_i_s").".csv";
        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename='.$file_name );
        header ( 'Cache-Control: max-age=0' );
        $file  = fopen('php://output',"a");
        $limit = 1000;
        $calc  = 0;
        $tit   = [];
        foreach ($head as $v){
            $tit[] = iconv('UTF-8', 'GB2312//IGNORE',$v);
        }
        fputcsv($file,$tit);
        foreach ($data as $v){
            $calc++;
            if($limit==$calc){
                ob_flush();
                flush();
                $calc=0;
            }
            $t_arr = [];
            foreach ($v as $t){
                $t_arr[]=iconv('UTF-8', 'GB2312//IGNORE',$t);
            }
            fputcsv($file,$t_arr);
            unset($t_arr);
        }
        unset($list);
        fclose($file);
        exit();
    }


    /**
     * 获取POST请求的数据
     * @param $params
     * @param null $request
     * @param bool $suffix
     * @return array
     */
    public static function postData($params, $request = null, bool $suffix = false)
    {
        if ($request === null) $request = app('request');
        $p = [];
        $i = 0;
        foreach ($params as $param) {
            if (!is_array($param)) {
                $p[$suffix == true ? $i++ : $param] = $request->param($param);
            } else {
                if (!isset($param[1])) $param[1] = null;
                if (!isset($param[2])) $param[2] = '';
                if (is_array($param[0])) {
                    $name = is_array($param[1]) ? $param[0][0] . '/a' : $param[0][0] . '/' . $param[0][1];
                    $keyName = $param[0][0];
                } else {
                    $name = is_array($param[1]) ? $param[0] . '/a' : $param[0];
                    $keyName = $param[0];
                }
                $p[$suffix == true ? $i++ : (isset($param[3]) ? $param[3] : $keyName)] = $request->param($name, $param[1], $param[2]);
            }
        }
        return $p;
    }

    /**
     * 获取请求的数据
     * @param $params
     * @param null $request
     * @param bool $suffix
     * @return array
     */
    public static function getData($params, $request = null, bool $suffix = false)
    {
        if ($request === null) $request = app('request');
        $p = [];
        $i = 0;
        foreach ($params as $param) {
            if (!is_array($param)) {
                $p[$suffix == true ? $i++ : $param] = $request->param($param);
            } else {
                if (!isset($param[1])) $param[1] = null;
                if (!isset($param[2])) $param[2] = '';
                if (is_array($param[0])) {
                    $name = is_array($param[1]) ? $param[0][0] . '/a' : $param[0][0] . '/' . $param[0][1];
                    $keyName = $param[0][0];
                } else {
                    $name = is_array($param[1]) ? $param[0] . '/a' : $param[0];
                    $keyName = $param[0];
                }
                $p[$suffix == true ? $i++ : (isset($param[3]) ? $param[3] : $keyName)] = $request->param($name, $param[1], $param[2]);
            }
        }
        return $p;
    }

    /**
     * 生成随机数
     * @param int $len
     * @param int $type  0 只是数字，1只是字母,2数字加字母
     * @return string
     */
    public static function GetRandStr(int $len=5, int $type=0) {
        $chars_num = array( "1", "2", "3", "4", "5", "6", "7","8", "9", "0");
        $chars_str = array( "A", "B", "C", "D", "E", "F", "G","H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        if($type == 2){
            $chars = array_merge($chars_num,$chars_str);
        }elseif ($type == 1){
            $chars = $chars_str;
        }else{
            $chars = $chars_num;
        }
        $charsLen = count($chars) - 1;
        shuffle($chars);
        $output = "";
        for ($i=0; $i<$len; $i++) {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
    }

    /**
     * 生成app_id
     * @param int $id
     * @return string
     */
    public static function appId(int $id=0){
        $str = self::orderNumber(10);
        $str = $str.$id;
        return substr(md5($str),8,16);
    }

    /**
     * 生成 app_secret
     * @return string
     */
    public static function appSecret(){
        $str = self::orderNumber(10);
        $str = $str.time();
        return md5($str);
    }
    /**
     * 过滤空格回车
     * @param string $str
     * @return mixed
     */
    public static function strSpace($str = ''){
        $str = preg_replace("/ /","",$str);
        $str = preg_replace("/&nbsp;/","",$str);
        $str = preg_replace("/　/","",$str);
        $str = preg_replace("/\r\n/","",$str);
        $str = str_replace(chr(13),"",$str);
        $str = str_replace(chr(10),"",$str);
        $str = str_replace(chr(9),"",$str);
        return $str;
    }
    /**
     * 付款码判断
     * @param string $code
     * @return string
     */
    public static function payChannel(string $code = ''){
        // 微信 10/11/12/13/14/15 开头  18位
        // 翼支付 51开头  18位
        // 支付宝 25/26/27/28/29/30
        $key = mb_substr($code,0,2);
        if(in_array($key,array('10','11','12','13','14','15'))){
            return 'wechat';
        }elseif (in_array($key,array('25','26','27','28','29','30'))){
            return 'alipay';
        }else{
            return 'bestpay';
        }
    }

    public static function is_face($v){
        if($v == 2){
            return '刷脸支付';
        }else{
            return '扫码支付';
        }
    }

    /**
     * 客户端判断
     * @param string $agent
     * @return string
     */
    public static function clientType(string $agent=''){
        $type = '';
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            $type = 'wechat';
        }
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Alipay') !== false) {
            $type = 'alipay';
        }
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Bestpay') !== false) {
            $type = 'bestpay';
        }
        return $type;
    }

    /**
     * 计算两个时间相差几个小时几分钟
     * @param string $end_date 2019-11-28 12:56:00
     * @param string $start_date 2019-11-28 12:56:00
     * @return string
     */
    public static  function hourAndMin(string $start_date = '', string $end_date= ''){
        if(!$start_date){
            return '0小时0分';
        }
        if(!is_numeric($end_date)){
            $end_date = strtotime($end_date);
        }
        $second = $end_date - $start_date;
        $day    = floor($second/3600/24); //天
        $hour   = floor($second/3600%24); //小时（%取余数）
        $minute = floor($second/60%60);   //分钟
        if($day>0){
            $hour = $hour+($day*24);
        }
        return $hour.'小时'.$minute.'分';
    }

    /**
     * ip解析
     * @param $ip
     * @param string $type
     * @return bool|mixed|string
     */
    public static function getIp($ip, string $type=''){
        $data =  cache('cache_'.$ip);
        if($data){
            return $data;
        }
        switch ($type){
            case 'aliyun':
                $url = "https://hcapi20.market.alicloudapi.com/ip?ip=".$ip;
                $headers = ['Authorization:APPCODE c19578f829ca40dc85912a3b6a17b6fa'];
                $data = self::httpRequest('GET',$url,'',$headers);
                if($data){ $data = json_decode($data,true);}
                cache('cache_'.$ip,$data);
                return $data;
                break;
            default:
                $url = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
                $data = self::httpRequest('GET',$url);
                if($data){ $data = json_decode($data,true);}
                cache('cache_'.$ip,$data);
                return $data;
                break;
        }
    }

    /**
     * ip to city
     * @param string $ip
     * @param string $type
     * @return mixed|string
     */
    public static function interceptCity(string $ip='', string $type=''){
        $data = self::getIp($ip,$type='');
        $city = '';
        if($data['data']['city']){
            $city = $data['data']['city'];
        }
        return $city;
    }

    /**
     * 数据签名
     * @param array $param
     * @param string $key
     * @return string
     */
    public static function authSign(array $param=array(), string $key='')
    {
        $signPars = "";
        ksort($param);
        foreach ($param as $k => $v) {
            //++++++++++++++
            //如果是多维数组
            if(is_array($v)){
                $v = md5(json_encode($v));
            }
            //++++++++++++++
            if ("sign" != $k && "" != $v) {
                $signPars .= $k . "=" . $v . "&";
            }
        }
        $signPars = rtrim($signPars, '&');
        $signPars .= $key;
        $sign = md5($signPars);
        return strtoupper($sign);
    }

    /**
     * 生成宣传海报
     * @param array $config  参数,包括图片和文字
     * @param string $filename 生成海报文件名,不传此参数则不生成文件,直接输出图片
     * @param string $_path 保存路径
     * @param int $width 背景宽度
     * @param int $height 背景高度
     * https://blog.csdn.net/sinat_35861727/article/details/78853872?utm_source=blogxgwz0
     * $config = array(
    'text'=>array(
    array(
    'text'=>'昵称',
    'left'=>182,
    'top'=>105,
    'fontPath'=>'qrcode/simhei.ttf', //字体文件
    'fontSize'=>18, //字号
    'fontColor'=>'255,0,0', //字体颜色
    'angle'=>0,
    )
    ),
    image'=>array(
    array( //二维码
    'url'=>'qrcode/qrcode.png',//图片资源路径
    'left'=>130,
    'top'=>-140,
    'stream'=>0,//图片资源是否是字符串图像流
    'right'=>0,
    'bottom'=>0,
    'width'=>150,
    'height'=>150,
    'opacity'=>100
    ),
    array( //头像
    'url'=>'https://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eofD96opK97RXwM179G9IJytIgqXod8jH9icFf6Cia6sJ0fxeILLMLf0dVviaF3SnibxtrFaVO3c8Ria2w/0',
    'left'=>120,
    'top'=>70,
    'right'=>0,
    'stream'=>0,
    'bottom'=>0,
    'width'=>55,
    'height'=>55,
    'opacity'=>100
    ),
    ),
    'background'=>'qrcode/bjim.jpg',
    );
    $filename = 'qrcode/'.time().'.jpg';
    //echo createPoster($config,$filename);
    echo createPoster($config);
     * @return bool|string
     */
    public static function createPoster($config=array(),$filename="",$_path = '',$width=0,$height=0){
        //如果要看报什么错，可以先注释调这个header
        if(empty($filename)) header("content-type: image/png");
        $imageDefault = array(
            'left'=>0,
            'top'=>0,
            'right'=>0,
            'bottom'=>0,
            'width'=>100,
            'height'=>100,
            'opacity'=>100
        );
        $textDefault =  array(
            'text'=>'',
            'left'=>0,
            'top'=>0,
            'fontSize'=>32,             //字号
            'fontColor'=>'255,255,255', //字体颜色
            'angle'=>0,
            'center'=>false
        );
        $background = $config['background'];//海报最底层得背景

        //背景方法
        $backgroundInfo   = getimagesize($background);
        $backgroundFun    = 'imagecreatefrom'.image_type_to_extension($backgroundInfo[2], false);
        $background       = $backgroundFun($background);
        $backgroundWidth  = imagesx($background);    //背景宽度
        $backgroundHeight = imagesy($background)-60;   //背景高度

        $imageRes = imageCreatetruecolor($backgroundWidth,$backgroundHeight);
        $color    = imagecolorallocate($imageRes, 255, 255, 255);
        imagefill($imageRes, 0, 0, $color);
        imagecopyresampled($imageRes,$background,0,0,0,0,imagesx($background),imagesy($background),imagesx($background),imagesy($background));

        //处理了图片
        if(!empty($config['image'])){
            foreach ($config['image'] as $key => $val) {
                $val = array_merge($imageDefault,$val);
                if(isset($val['radius']) && $val['radius']){
                    $_radius_img = self::radius_img($val['url'],'radius_'.$filename);
                    if($_radius_img){
                        $val['url'] = $_radius_img;
                    }
                }
                $info     = getimagesize($val['url']);
                $function = 'imagecreatefrom'.image_type_to_extension($info[2], false);

                if($val['stream']){
                    //如果传的是字符串图像流
                    $info = getimagesizefromstring($val['url']);
                    $function = 'imagecreatefromstring';
                }
                $res       = $function($val['url']);
                $resWidth  = $info[0];
                $resHeight = $info[1];

                //建立画板 ，缩放图片至指定尺寸
                $canvas = imagecreatetruecolor($val['width'], $val['height']);
                imagefill($canvas, 0, 0, $color);
                //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
                imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'],$resWidth,$resHeight);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']) - $val['width']:$val['left'];
                $val['top']  = $val['top']<0?$backgroundHeight- abs($val['top']) - $val['height']:$val['top'];
                if(isset($val['radius']) && $val['radius']){
                    imageColorTransparent($canvas, $color);    //颜色透明
                }
                //放置图像
                imagecopymerge($imageRes,$canvas, $val['left'],$val['top'],$val['right'],$val['bottom'],$val['width'],$val['height'],$val['opacity']);//左，上，右，下，宽度，高度，透明度
            }
        }

        //处理文字
        if(!empty($config['title'])){
            foreach ($config['title'] as $key => $val) {
                $val = array_merge($textDefault,$val);
                list($R,$G,$B) = explode(',', $val['fontColor']);
                $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
                $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];

                if($val['center']){
                    $arr = imagettfbbox($val['fontSize'],0,$val['fontPath'],$val['text']);
                    $textWidth = $arr[2]-$arr[0];
                    $val['left'] = ceil(($backgroundWidth - $textWidth) / 2); //计算文字的水平位置
                }
                imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],$val['text']);
            }
        }

        //处理文字
        if(!empty($config['text'])){
            foreach ($config['text'] as $key => $val) {
                $val = array_merge($textDefault,$val);
                list($R,$G,$B) = explode(',', $val['fontColor']);
                $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
                $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
                if($val['center']){
                    $arr = imagettfbbox($val['fontSize'],0,$val['fontPath'],$val['text']);
                    $textWidth = $arr[2]-$arr[0];
                    $val['left'] = ceil(($backgroundWidth - $textWidth) / 2); //计算文字的水平位置
                }
                imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],$val['text']);
            }
        }

        //生成图片
        if(!empty($filename)){
            if($_path){
                $path = $_path;
            }else{
                $path = app()->getRootPath().'public/upload/qrcode';
            }
            if(!is_dir($path)){
                mk_dir($path);
            }
            $filename = $path.'/'.$filename;
            $res = imagejpeg ($imageRes,$filename,90); //保存到本地
            imagedestroy($imageRes);
            if(!$res) return false;
            return $filename;
        }else{
            imagejpeg ($imageRes);//在浏览器上显示
            imagedestroy($imageRes);
        }
    }

    /**
     * 把图片裁剪为圆形
     * @param string $imgpath 原图
     * @param string $outpath 新图
     * @return string
     */
    public static function radius_img($imgpath='',$outpath='') {
        $ext     = getimagesize($imgpath);
        $src_img = null;
        switch ($ext['mime']) {
            case 'image/jpeg':
                $src_img = imagecreatefromjpeg($imgpath);
                break;
            default:
                $src_img = imagecreatefrompng($imgpath);
                break;
        }
        $wh = getimagesize($imgpath);
        $w  = $wh[0];
        $h  = $wh[1];
        $radius = (min($w, $h) / 2);
        $img    = imagecreatetruecolor($w, $h);

        //这一句一定要有
        imagesavealpha($img, true);
        //拾取一个完全透明的颜色,最后一个参数127为全透明
        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        $r = $radius; //圆 角半径
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (($x >= $radius && $x <= ($w - $radius)) || ($y >= $radius && $y <= ($h - $radius))) {
                    //不在四角的范围内,直接画
                    imagesetpixel($img, $x, $y, $rgbColor);
                } else {
                    //在四角的范围内选择画
                    //上左
                    $y_x = $r; //圆心X坐标
                    $y_y = $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                    //上右
                    $y_x = $w - $r; //圆心X坐标
                    $y_y = $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                    //下左
                    $y_x = $r; //圆心X坐标
                    $y_y = $h - $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                    //下右
                    $y_x = $w - $r; //圆心X坐标
                    $y_y = $h - $r; //圆心Y坐标
                    if (((($x - $y_x) * ($x - $y_x) + ($y - $y_y) * ($y - $y_y)) <= ($r * $r))) {
                        imagesetpixel($img, $x, $y, $rgbColor);
                    }
                }
            }
        }
        $path = app()->getRootPath().'public/upload/qrcode';
        if(!is_dir($path)){ mk_dir($path); }
        $outpath  = str_replace('jpg','png',$outpath);
        $outpath  = str_replace('gif','png',$outpath);
        $outpath  = str_replace('jpeg','png',$outpath);
        $filename = $path.'/'.$outpath;
        $res      = imagepng ($img,$filename); //保存到本地
        if(!$res) return false;
        return $filename;
    }

    /**
     * 友好的时间显示
     * @param int $sTime 待显示的时间
     * @param string $type 类型. normal | mohu | full | ymd | other
     * @return string
     */
    public static function formatDate(int $sTime, string $type = 'my'): string
    {
        // sTime=源时间，cTime=当前时间，dTime=时间差
        $cTime = time();
        $dTime = $cTime - $sTime;
        $dDay = intval(date("z", $cTime)) - intval(date("z", $sTime));
        // $dDay = intval($dTime/3600/24);
        $dYear = intval(date("Y", $cTime)) - intval(date("Y", $sTime));
        // normal：n秒前，n分钟前，n小时前，日期
        if ($type == 'normal') {
            if ($dTime < 60) {
                return $dTime ? $dTime . "秒前" : '刚刚';
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
                // 今天的数据.年份相同.日期相同.
            } elseif ($dYear == 0 && $dDay == 0) {
                // return intval($dTime/3600)."小时前";
                return '今天' . date('H:i', $sTime);
            } elseif ($dYear == 0) {
                return date("m月d日 H:i", $sTime);
            } else {
                return date("Y-m-d H:i", $sTime);
            }
        } elseif ($type == 'mohu') {
            if ($dTime < 60) {
                return $dTime ? $dTime . "秒前" : '刚刚';
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dDay > 0 && $dDay <= 7) {
                return intval($dDay) . "天前";
            } elseif ($dDay > 7 && $dDay <= 30) {
                return intval($dDay / 7) . '周前';
            } elseif ($dDay > 30) {
                return intval($dDay / 30) . '个月前';
            }
            // full: Y-m-d , H:i:s
        } elseif ($type == 'my') {
            if ($dTime < 60) {
                return $dTime ? $dTime . "秒前" : '刚刚';
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dDay > 0 && $dDay <= 3) {
                return intval($dDay) . "天前";
            } else {
                return date("Y-m-d", $sTime);
            }
            // full: Y-m-d , H:i:s
        } elseif ($type == 'full') {
            return date("Y-m-d , H:i:s", $sTime);
        } elseif ($type == 'ymd') {
            return date("Y-m-d", $sTime);
        } else {
            if ($dTime < 60) {
                return $dTime ? $dTime . "秒前" : '刚刚';
            } elseif ($dTime < 3600) {
                return intval($dTime / 60) . "分钟前";
            } elseif ($dTime >= 3600 && $dDay == 0) {
                return intval($dTime / 3600) . "小时前";
            } elseif ($dYear == 0) {
                return date("Y-m-d H:i:s", $sTime);
            } else {
                return date("Y-m-d H:i:s", $sTime);
            }
        }
        return '';
    }

    /**
     * 保存历史记录
     * @param string $name 记录名称
     * @param array $data 要记录的数据
     * @param int $num 保存的条数
     * @return array|mixed
     */
    public static function historyList(string $name='', array $data= [] , int $num = 20 ){
        $history_list = cache($name.'_history');
        if($history_list){
            $history_list = string2array($history_list);
        }
        if(!$data || !is_array($data)){
            return $history_list;
        }
        //判断记录里面是否有浏览记录
        if(is_array($history_list)) {
            //在浏览记录顶部加入
            array_unshift($history_list, $data);
            /* 去除重复记录 */
            $rows = array();
            foreach ($history_list as $v) {
                if(in_array($v, $rows)) {
                    continue;
                }
                $rows[] = $v;
            }
            /* 如果记录数量多余,则去除 */
            while (count($rows) > $num){
                array_pop($rows); //弹出
            }
            $history_list = $rows;
            cache($name.'_history',array2string($history_list));
            return $history_list;
        } else {
            $history_list[] = $data;
            cache($name.'_history', array2string($history_list));
            return $history_list;
        }
    }

    /**
     * 下载远程图片
     * @param string $url  远程地址
     * @param string $path 保存目录
     * @param string $filename 保存的文件名
     * @return false|mixed|string
     */
    public static function download(string $url='', string $path = '', string $filename='')
    {
        $absolute_path =  $path.$filename;
        if(!file_exists($path)){
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mk_dir($path, 0777);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $file = curl_exec($ch);
        curl_close($ch);
        $resource = fopen($absolute_path, 'a');
        $zt = fwrite($resource, $file);
        fclose($resource);
        if($zt){
            return $filename;
        }
        return false;
    }

    /**
     * 请求
     * @param string $request
     * @param string $url
     * @param array|string $param
     * @param array $header
     * @param string $cookie
     * @return bool|string
     */
    public static function httpRequest(string $request='get', string $url='', $param='', array $header = [], string $cookie='')
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        }
        if(count($header)){
            curl_setopt($oCurl, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_FOLLOWLOCATION,1);//当遇到location跳转时，直接抓取跳转的页面
        if($request == 'post' || $request == 'POST'){
            if(is_array($param)){
                $aPOST = array();
                foreach ($param as $key => $val) {
                    $aPOST[] = $key . "=" . urlencode($val);
                }
                $strPOST = join("&", $aPOST);
            }else{
                $strPOST = $param;
            }
            curl_setopt($oCurl, CURLOPT_POST, TRUE);
            curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        }else{
            curl_setopt($oCurl, CURLOPT_POST, FALSE);
            curl_setopt($oCurl, CURLOPT_CUSTOMREQUEST, 'GET');
        }
        curl_setopt($oCurl, CURLOPT_ENCODING, 'gzip,deflate');
        if ($cookie) {
            curl_setopt($oCurl, CURLOPT_COOKIEJAR, $cookie); //接收 cookie
        }
        $sContent = curl_exec($oCurl);
        $aStatus  = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200 || intval($aStatus["http_code"]) == 400) {
            return $sContent;
        }
        return false;
    }
}
