<?php

namespace app\api\controller;
use app\common\model\User;
use core\utils\ImageCompressor;
use think\facade\Db;
use think\facade\Request;
use think\facade\Filesystem;
use utils\Random;
use function getConfig;
use function json;
use function request;
use function validate;

class Upload
{
    public static function json($code=0,$data='',$msg='success'){
        return json(["code"=>$code, "msg"=>$msg, "data"=>$data]);
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

            $data['path'] = $path;
            // 判断文件是否存在
            $save_name = Db::name('file')->where(['hash'=>$data['hash'],'type_id'=>$type_id])->value('savename');
            if($save_name){
                $image = $save_name;
                Db::name('file')->where(['hash'=>$data['hash']])->update(['create_time'=>time()]);
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
                    //压缩图片
                    $_image = new ImageCompressor($local_save_name_path);
                    //压缩图片
                    $_image->compressProportionally(
                        maxWidth: 1000,
                        maxSize: 1097152, // 2MB
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
                //路径包含域名
                $image_url = $domain . '/' . str_replace('\\', '/', $image);
            }
            $data['url']      = $image_url;
            $data['create_time'] = time();
            if(!$save_name){
                Db::name('file')->insertGetId($data);
            }
//            if (strpos($image_url, 'http://')===false && strpos($image_url, 'https://')===false) {
//                $data['domain_url'] = getConfig('config_app_url').$image_url;
//            }else{
//                $data['domain_url'] = $image_url;
//            }
            if($edit == 1){
                return self::json(0,$data['url']);
            }
            return self::json(1,$data);

        } catch (\think\exception\ValidateException|\think\exception\HttpException $e) {
            return self::json(-1,[],$e->getMessage());
        }
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