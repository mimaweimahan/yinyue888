<?php

namespace app\api\controller\v1;
use core\utils\ImageCompressor;
use think\facade\Request;
use think\facade\Filesystem;
use utils\Random;
use think\exception\ValidateException;
use think\response\Json;
class Upload
{
    /**
     * 图片上传接口
     * @return Json
     */
    public function image(): Json
    {
        try {
            // 获取上传的文件
            $file = Request::file('image');

            if (empty($file)) {
                return json([
                    'code' => 400,
                    'msg' => '请选择要上传的图片'
                ]);
            }

            // 验证文件
            $validate = \think\facade\Validate::rule([
                'image' => 'file|fileExt:jpg,png,gif,jpeg|fileSize:4242880' // 最大5M
            ]);

            if (!$validate->check(['image' => $file])) {
                return json([
                    'code' => 400,
                    'msg' => $validate->getError()
                ]);
            }
            $disk = Filesystem::disk('public');
            $driver_cfg = Filesystem::getDiskConfig('public');
            $path = $driver_cfg['path'];
            $root = $driver_cfg['root'];
            if(!$path){ $path = ''; }
            // 上传文件到public/uploads/images目录
            $local_save_name = $disk->putFile($path, $file, function () use ($file){
                return date('Ym').'/'.date('dHi').'/'.Random::alnum(10);
            });
            $local_save_name_path =  $root.'/'.$local_save_name;
            //压缩图片
            $_image = new ImageCompressor($local_save_name_path);
            //压缩图片
            $_image->compressProportionally(
                maxWidth: 1000,
                maxSize: 1097152, // 2MB
                outputPath: $local_save_name_path,
                quality: 85
            );

            if ($local_save_name) {
                // 生成可访问的URL
                $url = Request::domain() .'/'. $local_save_name;
                return json([
                    'code' => 200,
                    'msg' => '上传成功',
                    'data' => [
                        'url' => $url,
                        'path' => $local_save_name
                    ]
                ]);
            } else {
                return json([
                    'code' => 500,
                    'msg' => '上传失败'
                ]);
            }
        } catch (ValidateException $e) {
            return json([
                'code' => 400,
                'msg' => $e->getMessage()
            ]);
        } catch (\Exception $e) {
            return json([
                'code' => 500,
                'msg' => 'error：' . $e->getMessage()
            ]);
        }
    }
}