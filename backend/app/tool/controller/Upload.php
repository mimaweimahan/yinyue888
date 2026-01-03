<?php
declare (strict_types = 1);
namespace app\tool\controller;
use app\Init;
use core\utils\ImageCompressor;
use think\facade\Db;
use think\facade\Filesystem;
use think\facade\Request;
use app\common\model\User;
use app\admin\model\File;
use utils\Random;
use think\Image;
class Upload extends Init
{
    //编辑器初始配置
    private static $cfg = array(
        /* 上传图片配置项 */
        'imageActionName' => 'uploadimage',
        'imageFieldName' => 'file',
        'imageMaxSize' => 0, /* 上传大小限制，单位B */
        'imageAllowFiles' => array('.png', '.jpg', '.jpeg', '.gif', '.bmp'),
        'imageCompressEnable' => true,
        'imageCompressBorder' => 1600,
        'imageInsertAlign' => 'none',
        'imageUrlPrefix' => '',
        'imagePathFormat' => '',
        /* 涂鸦图片上传配置项 */
        'scrawlActionName' => 'uploadscrawl',
        'scrawlFieldName' => 'upfile',
        'scrawlPathFormat' => '',
        'scrawlMaxSize' => 0,
        'scrawlUrlPrefix' => '',
        'scrawlInsertAlign' => 'none',
        /* 截图工具上传 */
        'snapscreenActionName' => 'uploadimage',
        'snapscreenPathFormat' => '',
        'snapscreenUrlPrefix' => '',
        'snapscreenInsertAlign' => 'none',
        /* 抓取远程图片配置 */
        'catcherLocalDomain' => array('127.0.0.1', 'localhost', 'img.baidu.com'),
        'catcherActionName' => 'catchimage',
        'catcherFieldName' => 'source',
        'catcherPathFormat' => '',
        'catcherUrlPrefix' => '',
        'catcherMaxSize' => 0,
        'catcherAllowFiles' => array('.png', '.jpg', '.jpeg', '.gif', '.bmp'),
        /* 上传视频配置 */
        'videoActionName' => 'uploadvideo',
        'videoFieldName' => 'upfile',
        'videoPathFormat' => '',
        'videoUrlPrefix' => '',
        'videoMaxSize' => 0,
        'videoAllowFiles' => array(".flv", ".swf", ".mkv", ".avi", ".rm", ".rmvb", ".mpeg", ".mpg", ".ogg", ".ogv", ".mov", ".wmv", ".mp4", ".webm", ".mp3", ".wav", ".mid"),
        /* 上传文件配置 */
        'fileActionName' => 'uploadfile',
        'fileFieldName' => 'upfile',
        'filePathFormat' => '',
        'fileUrlPrefix' => '',
        'fileMaxSize' => 0,
        'fileAllowFiles' => array(".xls", ".swf",".jpg",".gif",".png",".jpeg",".zip",".rar",".xlsx",".csv",".pdf",".ppt",".doc",".docx"),
        /* 列出指定目录下的图片 */
        'imageManagerActionName' => 'listimage',
        'imageManagerListPath' => '',
        'imageManagerListSize' => 20,
        'imageManagerUrlPrefix' => '',
        'imageManagerInsertAlign' => 'none',
        'imageManagerAllowFiles' => array('.png', '.jpg', '.jpeg', '.gif', '.bmp'),
        /* 列出指定目录下的文件 */
        'fileManagerActionName' => 'listfile',
        'fileManagerListPath' => '',
        'fileManagerUrlPrefix' => '',
        'fileManagerListSize' => '',
        'fileManagerAllowFiles' => array(".flv", ".swf",),
    );
    public static function json($code=0,$data='',$msg='success'){
        return json(["code"=>$code, "msg"=>$msg, "data"=>$data]);
    }

    public function index(){
        $is_val = Request::param('val','');
        $is_fun = Request::param('fun','');
        $this->assign('is_val',$is_val);
        $this->assign('is_fun',$is_fun);
        return $this->fetch();
    }
    /**
     * 单文件上传
     */
    public function file() {
        $type_id = Request::param('type_id',0,'intval');
        $app     = Request::param('app','admin');//所属应用
        $edit    = Request::param('edit',0,'intval');
        $driver  = getConfig('file_driver');
        $file    = request()->file('file');
        $original= Request::param('original',0,'intval');
        if(!$file){
            return self::json(-1,'','缺少上传文件');
        }
        validate(
            [
                'file' => [
                    // 限制文件大小(单位b)，这里限制为20M
                    'fileSize' => 20 * 1024 * 1024,
                    // 限制文件后缀，多个后缀以英文逗号分割
                    'fileExt'  => 'gif,jpg,png,jpeg,xlsx,xls,doc,docx,ppt,pptx,pdf,txt,zip,rar,mp3,mp4'
                ]
            ],
            [
                'file.fileSize' => '文件太大',
                'file.fileExt' => '不支持的文件后缀',
            ]
        )->check(['file' => $file]);

        try {
            $data = ['app'=>$app,'driver'=>$driver,'type_id'=>$type_id];
            $user = User::loginUser();
            if($user && isset($user['uid']) && $user['uid']){
                $data['uid'] = $user['uid'];
            }
            // 获取获取上传文件类型信息：image/jpeg
            $data['mime'] = $file->getOriginalMime();
            // 获取上传文件名：xxx.jpg
            $data['name'] = $file->getOriginalName();
            // 获取文件扩展名：jpg
            $data['ext']  = $file->extension();
            // 获取文件的哈希散列值
            $data['hash'] = $file->hash();
            $data['md5']  = $file->md5();
            $_file_size   = $file->getSize();
            $file_size    = round($_file_size/1024,2);
            if($file_size<1024){
                $data['size'] = $file_size;
                $data['unit'] = 'KB';
            }else{
                $data['size'] = round($file_size/1024,2);
                $data['unit'] = 'M';
            }
            $driver_cfg = Filesystem::getDiskConfig('public');
            $path = $driver_cfg['path'];
            $root = $driver_cfg['root'];
            if(!$path){ $path = ''; }
            $save_name = '';
            $local_save_name_path = '';
            // 判断文件是否存在
            $_file = Db::name('file')->where(['hash'=>$data['hash']])->find();
            if(isset($_file['savename']) && $_file['savename']){
                $save_name = $_file['savename'];
                if($_file['type_id']!=$type_id){
                    $_new_file = $_file;
                    $_new_file['type_id'] = $type_id;
                    $_new_file['create_time'] = time();
                    unset($_new_file['id']);
                    Db::name('file')->insert($_new_file);
                }else{
                    Db::name('file')->where(['hash'=>$data['hash']])->update(['create_time'=>time()]);
                }
                $image =  $_file['url'];
            }else{
                $disk = Filesystem::disk('public');
                //先将图片保存到本地
                if($original==1){
                    $local_save_name = $disk->putFile($path, $file, function () use ($file){
                        return str_replace('.'.$file->getOriginalExtension(),'',$file->getOriginalName());
                    });
                }else{
                    $local_save_name = $disk->putFile($path, $file, function () use ($file){
                        return date('Ym').'/'.date('dHi').'/'.Random::alnum(10);
                    });
                }
                $local_save_name_path =  $root.'/'.$local_save_name;
                //获取图片后缀
                $res_extension = $file->extension();
                //  以下类型的图片才可以压缩，gif不行
                if ($res_extension == 'jpg' || $res_extension == 'jpeg' || $res_extension == 'png') {
                    // 传入本地图片路径初始化
                    $_image = new ImageCompressor($local_save_name_path);
                    //压缩图片
                    $_image->compressProportionally(
                        maxWidth: 1000,
                        maxSize: 2097152, // 2MB
                        outputPath: $local_save_name_path,
                        quality: 85
                    );
                }
                $image = $local_save_name;
                if($local_save_name){
                    $_file = new \think\File($local_save_name_path);
                    //重新获取文件大小
                    $_file_size = $_file->getSize();
                    $file_size  = round($_file_size/1024,2);
                    if($file_size<1024){
                        $data['size'] = $file_size;
                        $data['unit'] = 'KB';
                    }else{
                        $data['size'] = round($file_size/1024,2);
                        $data['unit'] = 'M';
                    }
                    $_img = self::parseImagePath($local_save_name);
                    $data['savename'] = $_img['name'];
                    $data['path'] = $_img['dir'];
                }
            }
            if(!$image){
                return self::json(-1,'','上传失败');
            }

            //如果是本地上传
            if( $driver  == 'public'){
                //路径不包含域名
                $image_url = '/' . str_replace('\\', '/', $image);
            }else{
                $disk = Filesystem::disk($driver);
                $image = $disk->putFile($path, $file, function () use ($file){
                    return Random::alnum(10);
                });
                if(!$image){
                    return self::json(-1,'','上传失败');
                }
                $domain = Filesystem::getDiskConfig($driver, 'url');
                if(!$domain){
                    $domain = getConfig('config_app_url');
                }
                try {
                    //删除本地文件
                    unlink($local_save_name_path);
                }catch (\Exception $e){

                }
                //路径包含域名
                $image_url = $domain . '/' . str_replace('\\', '/', $image);
            }
            /*
                if (strpos($image_url, 'http://')===false && strpos($image_url, 'https://')===false) {
                    $image_url = getConfig('config_app_url').$image_url;
                }
            */
            $data['url']      = $image_url;
            $data['create_time'] = time();
            if(!$save_name){
                Db::name('file')->insertGetId($data);
            }
            $data['domain_url'] = $data['url'];
            if($edit == 1){
                return self::json(0,$data['url']);
            }
            return self::json(1,$data);

        } catch (\think\exception\ValidateException|\think\exception\HttpException $e) {
            return self::json(-1,[],$e->getMessage());
        }
    }
    /**
     * 文件批量上传
     */
    public function files() {
        $disk  = getConfig('file_driver');
        $disk  = Filesystem::disk($disk);
        $files = request()->file();
        $path  = '';
        try {
            $images = [];
            foreach($files as $file) {
                validate(
                    [
                        'file' => [
                            // 限制文件大小(单位b)，这里限制为4M
                            'fileSize' => 4 * 1024 * 1024,
                            // 限制文件后缀，多个后缀以英文逗号分割
                            'fileExt'  => 'gif,jpg,png,jpeg,xlsx,xls,doc,docx,ppt,pptx,pdf,txt,zip,rar,mp3,mp4'
                        ]
                    ],
                    [
                        'file.fileSize' => '文件太大',
                        'file.fileExt' => '不支持的文件后缀',
                    ]
                )->check(['file' => $file]);
                $images[] = $disk->putFile( $path, $file,'date');
            }
            return self::json(0,$images);
        } catch (\think\exception\ValidateException $e) {
            return self::json(-1,'',$e->getMessage());
        }
    }

    /**
     * [ueditor 编辑器方法]
     * @return string|\think\response\Json
     */
    public function editor(){
        $action  = Request::param('action');
        $type_id = Request::param('type_id',0,'intval');
        $app     = Request::param('app','admin');//所属应用
        $edit    = Request::param('edit',0,'intval');
        $driver  = getConfig('file_driver');
        switch($action){
            case 'config':
                $result = self::$cfg;
                break;
            case 'uploadimage':
                $files = request()->file('file');
                if (empty($files)) {
                    $return['code'] = 0;
                    $return['msg'] = 'No file upload or server upload limit exceeded';
                    return json($return);
                }
                $arr = File::upload($driver,$files,$type_id,$app,$edit);
                $result['state'] ='SUCCESS';
                $result['url'] = $arr['data']['url'];
                $result['original'] = $arr['data']['name'];
                $result['name'] = $arr['data']['name'];
                break;
            case 'uploadscrawl':
                $files = Request::param('upfile');
                if (empty($files)) {
                    $return['code'] = 0;
                    $return['msg'] = 'No file upload or server upload limit exceeded';
                    return json($return);
                }
                $arr = File::upload($driver,$files,$type_id,$app,$edit);
                $result['state'] ='SUCCESS';
                $result['url'] = $arr['data']['url'];
                $result['original'] = $arr['data']['name'];
                $result['name'] = $arr['data']['name'];
                break;
            case 'uploadfile':
                $files = request()->file('upfile');
                if (empty($files)) {
                    $return['code'] = 0;
                    $return['msg'] = 'No file upload or server upload limit exceeded';
                    return json($return);
                }
                $arr = File::upload($driver,$files,$type_id,$app,$edit);
                if($arr['code'] == 1){
                    $result['state'] ='SUCCESS';
                    $result['url'] = $arr['data']['url'];
                    $result['original'] = $arr['data']['name'];
                    $result['name'] = $arr['data']['name'];
                }else{
                    $result['state'] = 'error';
                    $result['msg'] = $arr['msg'];
                }
                break;
            case 'uploadvideo':
                $files = request()->file('upfile');
                if (empty($files)) {
                    $return['code'] = 0;
                    $return['msg'] = 'No file upload or server upload limit exceeded';
                    return json($return);
                }
                $data = File::upload($driver,$files,$type_id,$app,$edit);
                if($data['code'] == 1){
                    $result['state'] ='SUCCESS';
                    $result['url'] = $data['data']['url'];
                    $result['original'] = $data['data']['name'];
                    $result['name'] = $data['data']['name'];
                }else{
                    $result['state'] = 'error';
                    $result['msg']   = $data['msg'];
                }
                break;
            /* 列出图片 */
            case 'listimage':
                $page     = input('start',0,'intval');
                $pageSize = input('size',0,'intval');
                $result   = self::imageList($page,$pageSize);
                break;

            /* 列出文件 */
            case 'listfile':
                $page     = $this->request->get('start',0,'intval');
                $pageSize = $this->request->get('size',0,'intval');
                $result   = self::imageList($page,$pageSize);
                break;

            /* 抓取远程文件 */
            case 'catchimage_bak':
                $config = array(
                    "pathFormat" => self::$cfg['catcherPathFormat'],
                    "maxSize" => self::$cfg['catcherMaxSize'],
                    "allowFiles" => self::$cfg['catcherAllowFiles'],
                    "oriName" => "remote.png"
                );
                $fieldName = self::$cfg['catcherFieldName'];
                /* 抓取远程图片 */
                $list = array();
                isset($_POST[$fieldName]) ? $source = $_POST[$fieldName] : $source = $_GET[$fieldName];
                foreach($source as $imgUrl){
                    $info = json_decode($this->saveRemote($config,$imgUrl),true);
                    array_push($list, array(
                        "state" => $info["state"],
                        "url" => $info["url"],
                        "size" => $info["size"],
                        "title" => htmlspecialchars($info["title"]),
                        "original" => htmlspecialchars($info["original"]),
                        "source" => htmlspecialchars($imgUrl)
                    ));
                }
                $result = array(
                    'state' => count($list) ? 'SUCCESS':'ERROR',
                    'list' => $list
                );
                break;
            default:
                $result = array(
                    'state' => '请求地址出错'
                );
                break;
        }
        return json($result);
    }

    private static function imageList($page,$pageSize): array
    {
        if(!$page){
            $page = 0;
        }
        if(!$pageSize){
            $pageSize = 20;
        }
        $_lists = Db::name('file')->limit( ($page)*$pageSize, $pageSize )->order(['create_time'=>'DESC'])->select();

        if($_lists){
            $files = array();
            foreach ( $_lists as $r){
                $files[] = array('name'=>$r['name'],'url'=>$r['url'],'mtime'=>$r['create_time']);
            }
            $result = array(
                "state" => "SUCCESS",
                "list" => $files,
                "start" => $page + $pageSize,
                "total" => count($files)
            );
        }else{
            $result = array(
                "state" => "ERROR",
                "list" => [],
                "start" => 0,
                "total" => 0
            );
        }
        return $result;
    }

    /**
     * 解析图片路径或URL，获取所在目录和图片名称
     *
     * @param string $path 图片路径或URL
     * @return array 返回包含目录和文件名的关联数组，格式: ['directory' => ..., 'filename' => ...]
     */
    public static function parseImagePath($path) {
        // 处理URL情况，提取路径部分
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            $urlParts = parse_url($path);
            $path = $urlParts['path'];
        }

        // 规范化路径中的特殊字符（如处理示例中的"311.334"）
        $path = preg_replace('/\/+/', '/', $path); // 合并多个斜杠

        // 分离目录和文件名
        $directory = dirname($path);
        $filename = basename($path);

        // 处理目录以斜杠结尾的情况，保持一致性
        if ($directory !== '.' && substr($directory, -1) !== '/') {
            $directory .= '/';
        }

        // 对于当前目录的情况，返回空目录
        if ($directory === './') {
            $directory = '';
        }

        return [
            'dir' => $directory,
            'name' => $filename
        ];
    }
}
