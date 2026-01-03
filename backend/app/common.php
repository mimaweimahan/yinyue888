<?php
use think\facade\Request;
require __DIR__ . '/../core/functions.php';
if (!function_exists('html_entities')) {
    /**
     * 模版变量默认过滤方法
     * php8.1 中直接使用 htmlentities 当变量为空时报错所以使用这个自定义函数处理
     * @param $var
     * @return string|null
     */
    function html_entities($var)
    {
        if($var!=='' && $var !==null){
            return htmlentities($var);
        }
        return $var;
    }
}

if (!function_exists('getConfig')) {
    /**
     * 获取系统配置
     * @param $key
     * @return bool|mixed
     */
    function getConfig($key)
    {
        $rt = \think\facade\Db::name('config')->where(['name'=>$key])->cache(60)->value('value');
        if($rt){
            return $rt;
        }
        return '';
    }
}

if (!function_exists('think_md5')) {
    /**
     * 系统非常规MD5加密方法
     * @param string $str 要加密的字符串
     * @param string $key 密钥
     * @return string
     */
    function think_md5($str, $key = 'tp')
    {
        //return '' === $str ? '' : md5(sha1($str) . $key);
        return str_replace(' ','',$str);
    }
}

if (!function_exists('request_path_info')) {
    /**
     * 获取请求path_info
     * @return string
     */
    function request_path_info()
    {
        return app('http')->getName() . '/' . Request::pathinfo();
    }
}

if (!function_exists('css_version')) {
    function css_version()
    {
        return time();
    }
}
if (!function_exists('numFormat')) {
    function numFormat($num=0){
        $w = int2($num/10000);
        if($w>0){
            return $w .'万';
        }
        return $num;
    }
}

if (!function_exists('cms_version')) {
    function cms_version()
    {
        return time();
    }
}

if (!function_exists('data_auth_sign')) {
    /**
     * 数据签名认证
     * @param array $data 被认证的数据
     * @return string       签名
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    function data_auth_sign($data)
    {
        //数据类型检测
        if (!is_array($data)) {
            $data = (array)$data;
        }
        ksort($data); //排序
        $code = http_build_query($data); //url编码并生成query字符串
        $sign = sha1($code); //生成签名
        return $sign;
    }
}

if (!function_exists('isEmail')) {
    /**
     * 验证手机号是否正确
     * @param $mobile
     * @return bool
     */
    function validMobile($mobile)
    {
        if (!is_numeric($mobile)) {
            return false;
        }
        return preg_match('/^1[3|4|5|6|7|8|9]\d{9}$/', $mobile) ? true : false;
    }
}

if (!function_exists('isEmail')) {
    /**
     * 验证是否为邮箱
     * @param string $email 邮箱地址
     * @return bool
     */
    function isEmail($email)
    {
        if (preg_match("/[a-za-z0-9]+@[a-za-z0-9]+.[a-z]{2,4}/", $email, $mail)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('getDistance')) {
    /**
     * 根据经纬度计算距离 单位米
     * 根据经纬度计算距离 其中A($lat1,$lng1)、B($lat2,$lng2)
     * @param string $lat1 A点的经度
     * @param string $lng1 A点的纬度
     * @param string $lat2 B点的经度
     * @param string $lng2 B点的纬度
     * @return array|int
     */
    function getDistance($lat1 = '', $lng1 = '', $lat2 = '', $lng2 = '')
    {
        // 地球半径
        $R = 6378137;
        // 将角度转为狐度
        $radLat1 = deg2rad($lat1);
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        // 结果
        $s = acos(cos($radLat1) * cos($radLat2) * cos($radLng1 - $radLng2) + sin($radLat1) * sin($radLat2)) * $R;
        // 精度
        $s = round($s * 10000) / 10000;
        $s = round($s);
        return ['distance'=>fromUnit($s),'val'=>$s];
    }
}

if (!function_exists('fromUnit')) {
    /**
     * 距离单位换算
     * @param int $unit 距离 单位米
     * @return bool
     */
    function fromUnit($unit = 0)
    {
        if (!$unit) {
            return false;
        }
        if ($unit <= 500) {
            return $unit . "m";
        }
        if ($unit > 500) {
            $_unit = $unit / 1000;
            $_unit = round($_unit, 1);
            return $_unit . "km";
        }
        return false;
    }
}
if (!function_exists('str_space')) {
    /**
     * 过滤空格回车
     * @param string $str
     * @return mixed
     */
    function str_space($str = ''){
        $str = preg_replace("/ /","",$str);
        $str = preg_replace("/&nbsp;/","",$str);
        $str = preg_replace("/　/","",$str);
        $str = preg_replace("/\r\n/","",$str);
        $str = str_replace(chr(13),"",$str);
        $str = str_replace(chr(10),"",$str);
        $str = str_replace(chr(9),"",$str);
        return $str;
    }
}


if (!function_exists('thumb2')) {
    function thumb2($pic,$w=100,$h=100){
        return $pic."?x-oss-process=image/resize,m_fill,h_{$h},w_{$w}";
    }
}

if (!function_exists('thumb')) {
    /**
     * 生成缩略图
     * @param string $img_url 图片地址
     * @param int $width 缩略图宽度
     * @param int $height 缩略图高度
     * @param int $thumbType 缩略图生成方式
     * 1 标识缩略图等比例缩放类型;
     * 2 标识缩略图缩放后填充类型;
     * 3 标识缩略图居中裁剪类型;
     * 4 标识缩略图左上角裁剪类型;
     * 5 标识缩略图右下角裁剪类型;
     * 6 标识缩略图固定尺寸缩放类型
     * @param string $no_pic 图片不存在时显示默认图片
     * @param string $newFileName 缩略图名称
     * @return string
     */
    function thumb(string $img_url = '', int $width = 100, int $height = 100, int $thumbType = 3, string $no_pic = '/statics/skin/loading.png', string $newFileName='')
    {
        static $_thumb_cache = array();
        if (empty($img_url)) {
            return $no_pic;
        }
        //区分
        $key = md5($img_url . $width . $height . $thumbType . $no_pic);
        if (isset($_thumb_cache[$key])) {
            return $_thumb_cache[$key];
        }
        if (!$width) {
            return $no_pic;
        }
        //当获取不到DOCUMENT_ROOT值时的操作！
        if (empty($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['SCRIPT_FILENAME'])) {
            $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen($_SERVER['PHP_SELF'])));
        }
        if (empty($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['PATH_TRANSLATED'])) {
            $_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0 - strlen($_SERVER['PHP_SELF'])));
        }
        // | 解析URL
        $imgParse   = parse_url($img_url);
        //图片路径
        $imgPath    = $_SERVER['DOCUMENT_ROOT'] . $imgParse['path'];

        //取得文件名
        $basename   = basename($img_url);

        //取得文件存放目录
        $imgPathDir = str_replace($basename, '', $imgPath);

        //生成的缩略图文件名
        if($newFileName ==''){
            $newFileName = "thumb_{$width}_{$height}_" . $basename;
            //检查生成的缩略图是否已经生成过
            if (file_exists($imgPathDir . $newFileName)) {
                return str_replace($basename, $newFileName, $img_url);
            }
        }

        //检查文件是否存在，如果是开启远程附件的，估计就通过不了，以后在考虑完善！
        if (!file_exists($imgPath)) {
            return $img_url."?x-oss-process=image/resize,m_fill,h_{$height},w_{$width}";
        }
        $_info = @getimagesize($imgPath);
        if (false === $_info || (IMAGETYPE_GIF === $_info[2] && empty($_info['bits']))) {
            return $img_url."?x-oss-process=image/resize,m_fill,h_{$height},w_{$width}";
        }

        //取得图片相关信息
        list($width_t, $height_t, $type, $attr) = getimagesize($imgPath);
        //如果高是0，自动计算高
        if ($height <= 0) {
            $height = round(($width / $width_t) * $height_t);
        }

        //判断生成的缩略图大小是否正常
        if ($width >= $width_t || $height >= $height_t) {
            return $img_url;
        }
        //生成缩略图
        try {
            $thumb_image = \think\Image::open($imgPath);
            $thumb_image->thumb($width, $height, $thumbType)->save($imgPathDir.$newFileName);
            $_thumb_cache[$key] = str_replace($basename, $newFileName, $img_url);
            return $_thumb_cache[$key];
        }catch (\think\image\Exception|\Exception|\Error $e){
            return $img_url;
        }
    }
}

if (!function_exists('periodDate')) {
    /**
     * 获取两个日期之间的数组
     * @param $start_time '2020-10-10'
     * @param $end_time '2020-12-11'
     * @return array
     */
    function periodDate($start_time,$end_time): array
    {
        $start_time = strtotime($start_time);
        $end_time   = strtotime($end_time);
        $i =0;
        $arr = [];
        while ($start_time<=$end_time){
            $arr[$i]=date('Y-m-d',$start_time);
            $start_time = strtotime('+1 day',$start_time);
            $i++;
        }
        return $arr;
    }
}
if (!function_exists('isMobile')) {
    /**
     * 判断是否手机访问
     * @return bool
     */
    function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        }
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }
}
if (!function_exists('delDir')) {
    /**
     * 循环删除目录和文件
     * @param $dir
     * @return bool
     */
    function delDir($dir)
    {
        $dh = opendir($dir);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $full_path = $dir . "/" . $file;
                if (!is_dir($full_path)) {
                    @unlink($full_path);
                } else {
                    delDir($full_path);
                }
            }
        }
        closedir($dh);
        if (rmdir($dir)) {
            return true;
        }
        return false;
    }
}
if (!function_exists('service_type')) {
    function service_type($val)
    {
        switch ($val) {
            case 1:
                return '退款';
            case 2:
                return '换货';
            case 3:
                return '报损';
            case 4:
                return '拒收';
            case 5:
                return '投诉';
            case 11:
                return '退款不退货';
            default:
                return '正常';
        }
    }
}
if (!function_exists('getCategory')) {
    /**
     * 获取栏目相关信息
     * @param int $cat_id 栏目id
     * @param string $field 返回的字段，默认返回全部，数组
     * @param bool $newCache 是否强制刷新
     * @return array|bool|mixed|\think\Model|null
     */
    function getCategory(int $cat_id = 0, string $field = '', bool $newCache = false)
    {
        if (empty($cat_id)) {
            return false;
        }
        $key = 'getCategory_' . $cat_id;
        //强制刷新缓存
        if ($newCache) {
            cache($key, NULL);
        }
        $cache = cache($key);
        if ($cache === 'false') {
            return false;
        }
        if (empty($cache)) {
            //读取数据
            $cache = think\facade\Db::name('category')->where('cat_id', $cat_id)->find();
            if (empty($cache)) {
                cache($key, 'false', 60);
                return false;
            } else {
                //扩展配置
                cache($key, $cache, 3600);
            }
        }
        if ($field) {
            //支持var.property，不过只支持一维数组
            if (false !== strpos($field, '.')) {
                $vars = explode('.', $field);
                return $cache[$vars[0]][$vars[1]];
            } else {
                return $cache[$field];
            }
        } else {
            return $cache;
        }
    }
}

function isEmptyString($str) {
    // 先检查是否为null或非字符串类型
    if ($str === null || !is_string($str)) {
        return true; // 非字符串或null也视为"空"
    }
    // 去除两端空白后判断是否为空
    return empty(trim($str));
}