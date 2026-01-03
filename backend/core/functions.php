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
if (!function_exists('realIp')) {
    function realIp() {
        static $real_ip = NULL;
        if ($real_ip !== NULL)
        {
            return $real_ip;
        }
        if (isset($_SERVER))
        {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                foreach ($arr AS $ip)
                {
                    $ip = trim($ip);

                    if ($ip != 'unknown')
                    {
                        $real_ip = $ip;

                        break;
                    }
                }
            }
            elseif (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $real_ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            else
            {
                if (isset($_SERVER['REMOTE_ADDR']))
                {
                    $real_ip = $_SERVER['REMOTE_ADDR'];
                }
                else
                {
                    $real_ip = '0.0.0.0';
                }
            }
        }
        else
        {
            if (getenv('HTTP_X_FORWARDED_FOR'))
            {
                $real_ip = getenv('HTTP_X_FORWARDED_FOR');
            }
            elseif (getenv('HTTP_CLIENT_IP'))
            {
                $real_ip = getenv('HTTP_CLIENT_IP');
            }
            else
            {
                $real_ip = getenv('REMOTE_ADDR');
            }
        }
        preg_match("/[\d\.]{7,15}/", (string)$real_ip, $online_ip);
        $ip = !empty($online_ip[0]) ? $online_ip[0] : '0.0.0.0';
        if($ip == '0.0.0.0'){
            $ip = request()->ip();
        }
        return $ip;
    }
}
if (!function_exists('make_path')) {
    /**
     * 上传路径转化,默认路径
     * @param $path
     * @param int $type
     * @param bool $force
     * @return string
     * @throws Exception
     */
    function make_path($path, int $type = 2, bool $force = false)
    {
        $path = DS . ltrim(rtrim($path));
        switch ($type) {
            case 1:
                $path .= DS . date('Y');
                break;
            case 2:
                $path .= DS . date('Y') . DS . date('m');
                break;
            case 3:
                $path .= DS . date('Y') . DS . date('m') . DS . date('d');
                break;
        }
        try {
            if (is_dir(app()->getRootPath() . 'public' . DS . 'uploads' . $path) == true || mkdir(app()->getRootPath() . 'public' . DS . 'uploads' . $path, 0777, true) == true) {
                return trim(str_replace(DS, '/', $path), '.');
            } else return '';
        } catch (\Exception $e) {
            if ($force)
                throw new \Exception($e->getMessage());
            return '无法创建文件夹，请检查您的上传目录权限：' . app()->getRootPath() . 'public' . DS . 'uploads' . DS . 'attach' . DS;
        }

    }
}

if (!function_exists('curl_file_exist')) {
    /**
     * CURL 检测远程文件是否在
     * @param $url
     * @return bool
     */
    function curl_file_exist($url)
    {
        $ch = curl_init();
        try {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            $contents = curl_exec($ch);
            if (preg_match("/404/", $contents)) return false;
            if (preg_match("/403/", $contents)) return false;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


if (!function_exists('think_encrypt')) {
    /**
     * 系统加密方法
     * @param string $data 要加密的字符串
     * @param string $key 加密密钥
     * @param int $expire 过期时间 (单位:秒)
     * @return string
     */
    function think_encrypt($data, $key = '', $expire = 0)
    {
        if ($key == '') $key = 'TT';
        $key = md5($key);
        $data = base64_encode($data);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        $str = sprintf('%010d', $expire ? $expire + time() : 0);
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
        }
        return str_replace('=', '', base64_encode($str));
    }
}

if (!function_exists('think_decrypt')) {
    /**
     * 系统解密方法
     * @param string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
     * @param string $key 加密密钥
     * @return string
     */
    function think_decrypt($data, $key='')
    {
        if($key == '') $key = 'TT';
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $expire = substr($data, 0, 10);
        $data = substr($data, 10);
        if ($expire > 0 && $expire < time()) {
            return '';
        }
        $len = strlen($data);
        $l = strlen($key);
        $char = $str = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            } else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return base64_decode($str);
    }
}

if (!function_exists('arr2str')) {
    /**
     * 数组转换为字符串，主要用于把分隔符调整到第二个参数
     * @param array $arr 要连接的数组
     * @param string $glue 分割符
     * @return string
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    function arr2str($arr, $glue = ',')
    {
        return implode($glue, $arr);
    }
}

if (!function_exists('str2arr')) {
    /**
     * 字符串转换为数组，主要用于把分隔符调整到第二个参数
     * @param string $str 要分割的字符串
     * @param string $glue 分割符
     * @return array
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    function str2arr($str, $glue = ',')
    {
        return explode($glue, $str);
    }
}

if (!function_exists('int2')) {
    /**
     * 保留两位小数,自动补齐0
     * @param $num int 数字
     * @param int $type 类型：1四舍五入,0不四舍五入
     * @return string
     */
    function int2($num, $type = 0)
    {
        if ($type == 1) {
            return floatval(sprintf("%.2f", round($num, 2)));
        }
        return sprintf("%.2f", floor($num * 100) / 100);
    }
}

if (!function_exists('int3')) {
    /**
     * 保留3位小数,自动补齐0
     * @param $num int 数字
     * @param int $type 类型：1四舍五入,0不四舍五入
     * @return string
     */
    function int3($num, $type = 0)
    {
        if ($type == 1) {
            return sprintf("%.3f", round($num, 3));
        }
        return sprintf("%.3f", floor($num * 1000) / 1000);
    }
}


if (!function_exists('string2array')) {
    /**
     * 将字符串转换为数组
     * @param string $string 字符串
     * @return   array   返回数组格式，如果，data为空，则返回空数组
     */
    function string2array($string)
    {
        $Return = array();
        $string = urldecode($string);
        $TempArray = explode('||', $string);
        $NullValue = urlencode(base64_encode("^^^"));
        foreach ($TempArray as $TempValue) {
            list($Key, $Value) = explode('|', $TempValue);
            $DecodedKey = base64_decode(urldecode($Key));
            if ($Value != $NullValue) {
                $ReturnValue = base64_decode(urldecode($Value));
                if (substr($ReturnValue, 0, 8) == '^^array^')
                    $ReturnValue = String2Array(substr($ReturnValue, 8));
                $Return[$DecodedKey] = $ReturnValue;
            } else
                $Return[$DecodedKey] = NULL;
        }
        return $Return;
    }
}

if (!function_exists('array2string')) {
    /**
     * 将数组转换为字符串
     * @param array $array 数组
     * @return string  返回字符串，如果，$array为空，则返回空
     */
    function array2string($array = array())
    {
        $Return = '';
        $NullValue = "^^^";
        foreach ($array as $Key => $Value) {
            if (is_array($Value))
                $ReturnValue = '^^array^' . Array2String($Value);
            else
                if($Value){
                    $ReturnValue = (strlen($Value) > 0) ? $Value : $NullValue;
                }else{
                    $ReturnValue = $NullValue;
                }
                
            $Return .= urlencode(base64_encode($Key)) . '|' . urlencode(base64_encode($ReturnValue)) . '||';
        }
        return urlencode(substr($Return, 0, -2));
    }
}

if (!function_exists('array2file')) {
    /**
     * 调试，用于保存数组到txt文件 正式生产删除
     * 用法：array2file($info, SITE_PATH.'post.txt');
     * @param $array
     * @param $filename
     * @return bool|int|void
     */
    function array2file($array, $filename)
    {
        if (config("app_debug")) {
            // 修改文件时间
            file_exists($filename) or touch($filename);
            if (is_array($array)) {
                $str = var_export($array, true);
            } else {
                $str = $array;
            }
            return file_put_contents($filename, $str);
        }
        return false;
    }
}


if (!function_exists('hideMobile')) {
    /**
     * 隐藏手机中加4位
     * @param $mobile
     * @return string
     */
    function hideMobile($mobile)
    {
        return substr($mobile, 0, 3) . "****" . substr($mobile, 7, 4);
    }
}
if (!function_exists('bankCard')) {
    function bankCard($bankCardNo){
        //每隔4位分割为数组
        $split = str_split($bankCardNo,4);
        //头和尾保留，其他部分替换为星号
        $split = array_fill(1,count($split) - 2,"****") + $split;
        ksort($split);
        //合并
        return implode(" ",$split);
    }
}
if (!function_exists('str_cut')) {
    /**
     * 字符截取
     * @param string $source_str 需要截取的字符串
     * @param int $length 长度
     * @param string $dot
     * @return string
     */
    function str_cut($source_str = '', $length = 0, $dot = '...')
    {
        $return_str = '';
        $i = 0;
        $n = 0;
        // $source_str = preg_replace('/\s/', '', $source_str);
        $source_str = str_replace(" 　　　　　　　　 ", "", $source_str);
        $source_str = str_replace("  ", "", $source_str);
        $str_length = strlen($source_str); // 字符串的字节数
        while (($n < $length) && ($i <= $str_length)) {
            $temp_str = substr($source_str, $i, 1);
            $ascnum = Ord($temp_str); // 得到字符串中第$i位字符的ascii码
            if ($ascnum >= 224) {// 如果ASCII位高与224，
                $return_str = $return_str . substr($source_str, $i, 3); // 根据UTF-8编码规范，将3个连续的字符计为单个字符
                $i = $i + 3; // 实际Byte计为3
                $n++; // 字串长度计1
            } elseif ($ascnum >= 192) { // 如果ASCII位高与192，
                $return_str = $return_str . substr($source_str, $i, 2); // 根据UTF-8编码规范，将2个连续的字符计为单个字符
                $i = $i + 2; // 实际Byte计为2
                $n++; // 字串长度计1
            } elseif ($ascnum >= 65 && $ascnum <= 90) { // 如果是大写字母，
                $return_str = $return_str . substr($source_str, $i, 1);
                $i = $i + 1; // 实际的Byte数仍计1个
                $n++; // 但考虑整体美观，大写字母计成一个高位字符
            } else {// 其他情况下，包括小写字母和半角标点符号，
                $return_str = $return_str . substr($source_str, $i, 1);
                $i = $i + 1;            // 实际的Byte数计1个
                $n = $n + 0.5;        // 小写字母和半角标点等与半个高位字符宽...
            }
        }
        if ($str_length > strlen($return_str)) {
            $return_str = $return_str . $dot; // 超过长度时在尾处加上省略号
        }
        return $return_str;
    }
}

if (!function_exists('arraySort')) {
    /**
     * 二维数组根据某个字段排序
     * @param array $array 要排序的数组
     * @param string $keys 要排序的键字段
     * @param int $sort 排序类型 SORT_ASC,SORT_DESC
     * @return mixed 排序后的数组
     */
    function arraySort($array=[], $keys='', $sort = SORT_ASC)
    {
        $keysValue = [];
        foreach ($array as $k => $v) {
            $keysValue[$k] = $v[$keys];
        }
        array_multisort($keysValue, $sort, $array);
        return $array;
    }
}

if (!function_exists('mk_dir')) {
    /**
     * 递归创建文件
     * @param $dirs string 文件名称
     * @param int $mode 权限
     * @return bool
     */
    function mk_dir($dirs = '', $mode = 0777)
    {
        if (!is_dir($dirs)) {
            mk_dir(dirname($dirs), $mode);
            return @mkdir($dirs, $mode);
        }
        return true;
    }
}

if (!function_exists('filter_emoji')) {
    // 过滤掉emoji表情
    function filter_emoji($str): array|string|null
    {
        $str = preg_replace_callback(    //执行一个正则表达式搜索并且使用一个回调进行替换
            '/./u',
            function (array $match) {
                return strlen($match[0]) >= 4 ? '' : $match[0];
            },
            $str);
        return $str;
    }
}

if (!function_exists('log_push')) {
    /**
     * 日志文件
     * @param $file string 文件名
     * @param $word string 记录数据
     */
    function log_push(string $file, string $word)
    {
        $file = str_replace(['.','/'],'_',$file);
        $log_path = app()->getRootPath() . 'runtime/logs';
        if (!file_exists($log_path)) {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            mk_dir($log_path, 0777);
        }
        $fp = fopen($log_path . '/' . $file.'.log', "a");
        flock($fp, LOCK_EX);
        fwrite($fp, "执行日期：" . date('Y-m-d H:m:s', time()) . "\n" . $word . "\n\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }
}

/**
 * 数字金额转换成中文大写金额的函数
 * @param int $num 要转换的小写数字或小写字符串
 * @return string
 */
function num_to_rmb(int $num=0): string
{
    $c1 = "零壹贰叁肆伍陆柒捌玖";
    $c2 = "分角元拾佰仟万拾佰仟亿";
    //精确到分后面就不要了，所以只留两个小数位
    $num = round($num, 2);
    //将数字转化为整数
    $num = $num * 100;
    if (strlen((string)$num) > 10) {
        return "金额太大，请检查";
    }
    $i = 0;
    $c = "";
    while (1) {
        if ($i == 0) {
            //获取最后一位数字
            $n = substr((string)$num, strlen((string)$num)-1, 1);
        } else {
            $n = $num % 10;
        }
        //每次将最后一位数字转化为中文
        $p1 = substr($c1, 3 * $n, 3);
        $p2 = substr($c2, 3 * $i, 3);
        if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
            $c = $p1 . $p2 . $c;
        } else {
            $c = $p1 . $c;
        }
        $i = $i + 1;
        //去掉数字最后一位了
        $num = $num / 10;
        $num = (int)$num;
        //结束循环
        if ($num == 0) {
            break;
        }
    }
    $j = 0;
    $slen = strlen($c);
    while ($j < $slen) {
        //utf8一个汉字相当3个字符
        $m = substr($c, $j, 6);
        //处理数字中很多0的情况,每次循环去掉一个汉字“零”
        if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
            $left = substr($c, 0, $j);
            $right = substr($c, $j + 3);
            $c = $left . $right;
            $j = $j-3;
            $slen = $slen-3;
        }
        $j = $j + 3;
    }
    //这个是为了去掉类似23.0中最后一个“零”字
    if (substr($c, strlen($c)-3, 3) == '零') {
        $c = substr($c, 0, strlen($c)-3);
    }
    //将处理的汉字加上“整”
    if (empty($c)) {
        return "零元整";
    }else{
        return $c . "整";
    }
}

/**
 * 去除代码中的空白和注释
 * @param string $content 代码内容
 * @return string
 */
function strip_whitespace(string $content): string
{
    $stripStr   = '';
    //分析php源码
    $tokens     = token_get_all($content);
    $last_space = false;
    for ($i = 0, $j = count($tokens); $i < $j; $i++) {
        if (is_string($tokens[$i])) {
            $last_space = false;
            $stripStr  .= $tokens[$i];
        } else {
            switch ($tokens[$i][0]) {
                //过滤各种PHP注释
                case T_COMMENT:
                case T_DOC_COMMENT:
                    break;
                //过滤空格
                case T_WHITESPACE:
                    if (!$last_space) {
                        $stripStr  .= ' ';
                        $last_space = true;
                    }
                    break;
                case T_START_HEREDOC:
                    $stripStr .= "<<<THINK\n";
                    break;
                case T_END_HEREDOC:
                    $stripStr .= "THINK;\n";
                    for($k = $i+1; $k < $j; $k++) {
                        if(is_string($tokens[$k]) && $tokens[$k] == ';') {
                            $i = $k;
                            break;
                        } else if($tokens[$k][0] == T_CLOSE_TAG) {
                            break;
                        }
                    }
                    break;
                default:
                    $last_space = false;
                    $stripStr  .= $tokens[$i][1];
            }
        }
    }
    return $stripStr;
}

/**
 * 生成配置文件
 * 快速文件数据读取和保存 针对简单类型数据 字符串、数组
 * @param string $name 缓存名称
 * @param array|string $value 缓存值
 * @param string $path 缓存路径
 * @return array|bool|int|mixed
 */
function io_cache(string $name, $value='', string $path = '') {
    static $_cache = array();
    if($path==''){
        $path = app()->getRootPath() . 'public/config/';
    }
    $filename = $path . $name . '.json';
    if ($value!=='') {
        if (is_null($value)||$value=='null') {
            // 删除缓存
            return false != strpos($name, '*') ? array_map("unlink", glob($filename)) : unlink($filename);
        } else {
            // 缓存数据
            $dir = dirname($filename);
            // 目录不存在则创建
            if (!is_dir($dir))
                mkdir($dir, 0755, true);
            $_cache[$name] = $value;
            $content = json_encode($value,256);
            return file_put_contents($filename,$content);
        }
    }

    if (isset($_cache[$name]))
        return $_cache[$name];

    // 获取缓存数据
    if (is_file($filename)) {
        $value = file_get_contents($filename);
        if($value){
            $value = json_decode($value,true);
        }
        $_cache[$name] = $value;
    } else {
        $value = false;
    }
    return $value;
}


/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function diy_dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}

/**
 * 从图片URL中提取图片名称和不含域名的保存路径
 * @param string $imageUrl 完整的图片URL（如https://www.xx.com/uploads/images/68b07d045ce92.jpg）
 * @return array|false 成功返回关联数组（含path和filename），失败返回false
 */
function getImagePathAndName($imageUrl) {
    // 1. 验证URL格式（确保是合法的HTTP/HTTPS URL）
    if (!filter_var($imageUrl, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)) {
        return false; // URL格式非法
    }

    // 2. 解析URL，分离协议（http/https）、域名、路径等部分
    $urlParts = parse_url($imageUrl);
    // 检查URL是否包含"路径"部分（无路径则无图片文件）
    if (!isset($urlParts['path']) || empty($urlParts['path'])) {
        return false; // URL无文件路径
    }

    // 3. 提取不含域名的完整路径（即$urlParts['path']，已自动去除协议和域名）
    $fullPathWithoutDomain = $urlParts['path'];

    // 4. 提取图片名称（路径中最后一个"/"后的部分）
    $imageFileName = basename($fullPathWithoutDomain);

    // 5. 提取图片保存的文件夹路径（去除文件名后的剩余部分）
    $imageFolderPath = dirname($fullPathWithoutDomain);
    // 处理特殊情况：若路径以"/"结尾（如"xxx/uploads/images/"），dirname会保留正确文件夹路径

    // 6. 返回结果（键名：path=文件夹路径，filename=图片名称）
    return [
        'path' => $imageFolderPath,
        'filename' => $imageFileName
    ];
}

/**
 * 隐藏邮箱@前面部分的中间字符，用*代替
 *
 * @param string $email 原始邮箱地址
 * @return string 处理后的邮箱地址，如：a**b@example.com
 */
function maskEmail($email) {
    // 检查邮箱格式是否合法
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email; // 格式不合法则返回原字符串
    }

    // 分割邮箱为用户名和域名部分
    list($username, $domain) = explode('@', $email, 2);
    $usernameLength = strlen($username);

    // 根据用户名长度决定显示和隐藏的字符数
    switch (true) {
        case $usernameLength <= 2:
            // 2个字符及以下不隐藏
            $maskedUsername = $username;
            break;
        case $usernameLength == 3:
            // 3个字符显示首尾各1个，中间1个*
            $maskedUsername = substr($username, 0, 1) . '*' . substr($username, -1);
            break;
        case $usernameLength == 4:
            // 4个字符显示首尾各1个，中间2个*
            $maskedUsername = substr($username, 0, 1) . '**' . substr($username, -1);
            break;
        default:
            // 5个字符及以上显示首2个和尾2个，中间用*填充
            $maskedUsername = substr($username, 0, 2) . str_repeat('*', $usernameLength - 4) . substr($username, -2);
    }

    // 组合处理后的用户名和域名
    return $maskedUsername . '@' . $domain;
}

/**
 * 验证不含国家代码的手机号格式是否正确
 *
 * @param string $phone 待验证的手机号（不含国家代码）
 * @return bool 验证通过返回true，否则返回false
 */
function validateLocalPhone($phone) {
    // 移除可能存在的空格、连字符等分隔符
    $cleanedPhone = preg_replace('/[\s\-()]/', '', $phone);

    /**
     * 不含国家代码的手机号正则规则：
     * 1. 纯数字组成
     * 2. 长度在7-15位之间（覆盖世界各国常见的本地手机号长度）
     * 3. 不能以0开头后直接跟多位0（避免明显无效的号码）
     */
    $pattern = '/^[1-9]\d{6,14}$/';

    // 执行正则匹配
    return preg_match($pattern, $cleanedPhone) === 1;
}

//获取当前访问域名
function getCurrentDomain() {
    // 判断是否使用HTTPS
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

    // 获取域名或主机名
    $domain = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';

    // 组合完整URL
    return $protocol . '://' . $domain;
}

/**
 * 格式化金额，大于1000时添加逗号分隔
 *
 * @param float $amount 要格式化的金额
 * @param int $decimals 保留的小数位数，默认2位
 * @return string 格式化后的金额字符串
 */
function formatCurrency($amount, $decimals = 2) {
    // 确保输入是有效的数字
    if (!is_numeric($amount)) {
        return '0.00';
    }
    // 使用number_format进行格式化
    // 参数说明：
    // 1. 要格式化的数字
    // 2. 保留的小数位数
    // 3. 小数点符号
    // 4. 千位分隔符
    return number_format($amount, $decimals, '.', ',');
}