<?php

namespace app\api\controller;
use app\Request;
use core\services\CacheService;
use core\utils\Tools;
class Image
{

    /**
     * 获取图片base64
     * @param Request $request
     * @return mixed
     */
    public function getImageBase64(Request $request)
    {
        $imageUrl = $request->param('image','');
        $codeUrl = $request->param('code','');
        try {
            $code = CacheService::get($codeUrl, function () use ($codeUrl) {
                $codeTmp = $code = $codeUrl ? Tools::image_to_base64($codeUrl) : false;
                if (!$codeTmp) {
                    $putCodeUrl = Tools::put_image($codeUrl);
                    $code = $putCodeUrl ? Tools::image_to_base64(app()->request->domain(true) . '/' . $putCodeUrl) : false;
                    $code ?? unlink($_SERVER["DOCUMENT_ROOT"] . '/' . $putCodeUrl);
                }
                return $code;
            });
            $image = CacheService::get($imageUrl, function () use ($imageUrl) {
                $imageTmp = $image = $imageUrl ? Tools::image_to_base64($imageUrl) : false;
                if (!$imageTmp) {
                    $putImageUrl = Tools::put_image($imageUrl);
                    $image = $putImageUrl ? Tools::image_to_base64(app()->request->domain(true) . '/' . $putImageUrl) : false;
                    $image ?? unlink($_SERVER["DOCUMENT_ROOT"] . '/' . $putImageUrl);
                }
                return $image;
            });
            return app('json')->success(compact('code', 'image'));
        } catch (\Exception $e) {
            return app('json')->fail($e->getMessage());
        }
    }
}