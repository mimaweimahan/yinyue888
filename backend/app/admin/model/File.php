<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 文件库
 */
namespace app\admin\model;
use app\common\model\User;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\facade\Db;
use think\facade\Filesystem;
use think\facade\Request;
use think\Model;
use app\common\traits\ModelTrait;

class File extends Model
{
    public $error = '';
    use ModelTrait;
    /**
     * 获取文件分类名称
     * @return \think\model\relation\HasOne
     */
    public function type()
    {
        return $this->hasOne('FileType','id', 'type_id')->bind(['type_name']);
    }

    /**
     * 上传处理
     * @param string $driver
     * @param $file
     * @param int $type_id
     * @param string $app
     * @param int $edit
     * @return array
     */
    public static function upload(string $driver, $file, $type_id=0, $app='admin', $edit=0){
        $disk    = Filesystem::disk($driver);
        if(!$file){
            return ["code"=>-1, "msg"=>'缺少上传文件', "data"=>[]];
        }
        $path = Filesystem::getDiskConfig($driver, 'path');
        if(!$path){ $path = ''; }
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
            validate(
                [
                    'file' => [
                        // 限制文件大小(单位b)，这里限制为4M
                        'fileSize' => 40 * 1024 * 1024,
                        // 限制文件后缀，多个后缀以英文逗号分割
                        'fileExt'  => 'gif,jpg,png,jpeg,xlsx,xls,doc,docx,ppt,pptx,pdf,txt,zip,rar,mp3,mp4,flv,swf'
                    ]
                ],
                [
                    'file.fileSize' => '文件太大',
                    'file.fileExt' => '不支持的文件后缀',
                ]
            )->check(['file' => $file]);

            $data['path'] = $path;
            // 判断文件是否存在
            $save_name = Db::name('file')->where(['hash'=>$data['hash']])->value('savename');
            if($save_name){
                $image = $save_name;
            }else{
                $image = $disk->putFile($path, $file);
            }
            if(!$image){
                return ["code"=>-1, "msg"=>'上传失败', "data"=>[]];
            }
            //如果是本地上传
            if( $driver  == 'public'){
                //路径不包含域名
                $image_url = '/' . str_replace('\\', '/', $image);
            }else{
                $domain = Filesystem::getDiskConfig($driver, 'url');
                if(!$domain){
                    $domain = getConfig('config_app_url');
                }
                //路径包含域名
                $image_url = $domain . '/' . str_replace('\\', '/', $image);
            }
            $data['savename'] = $image;
            $data['url'] = $image_url;
            $data['create_time'] = time();
            if(!$save_name){
                Db::name('file')->insertGetId($data);
            }
            if($edit == 1){
                return ["code"=>1, "msg"=>'SUCCESS', "data"=>$data['url']];
            }
            return ["code"=>1, "msg"=>'SUCCESS', "data"=>$data];
        } catch (\think\exception\ValidateException|\think\exception\HttpException $e) {
            return [ "code"=>-1, "msg"=>$e->getMessage(), "data"=>[] ];
        }
    }

    /**
     * @param string $driver
     * @param $files
     * @return array|false
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function base64(string $driver,$files)
    {
        $aData = $files;
        if ($aData == '' || $aData == 'undefined') {
            return false;
        }
        $result = [];
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $aData, $result)) {
            $base64_body = substr(strstr($aData, ','), 1);

            empty($aExt) && $aExt = $result[2];
        } else {
            $base64_body = $aData;
        }

        empty($aExt) && $aExt = 'jpg';

        $md5   = md5($base64_body);
        $sha1  = sha1($base64_body);
        $check = self::where(['md5' => $md5, 'sha1' => $sha1])->find();
        if ($check) {
            $check = $check->toArray();
            //已存在则直接返回信息
            $return['id'] = $check['id'];
            $return['path'] = $check['path'];
            return $return;
        } else {
            $date     = date('Y-m-d');
            $saveName = uniqid();
            $savePath = './uploads/picture/' . $date . '/';
            $path = $savePath . $saveName . '.' . $aExt;
            $rs = '';
            if($driver == 'local'){
                //本地上传
                if(!file_exists('.' . $savePath)){
                    mkdir('.' . $savePath, 0777, true);
                }
                $data = base64_decode($base64_body);
                $rs   = file_put_contents('.' . $path, $data);
            }
            if ($rs) {
                $pic['savepath'] = $path;
                $pic['md5'] = $md5;
                $pic['sha1'] = $sha1;
                $pic['create_time'] = time();
                $id = self::insertGetId($pic);
                return ['id' => $id, 'path' => $path];
            } else {
                return false;
            }

        }
    }
}