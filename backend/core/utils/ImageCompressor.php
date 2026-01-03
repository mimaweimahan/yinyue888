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
use InvalidArgumentException;
use RuntimeException;
#压缩图片类
class ImageCompressor {
    // 裁剪方式常量
    const CROP_CENTER = 1;
    const CROP_TOP = 2;
    const CROP_BOTTOM = 3;
    const CROP_TOP_LEFT = 4;
    const CROP_TOP_RIGHT = 5;

    private $supportedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp'
    ];

    private $sourcePath;
    private $memoryLimit;
    private $imageInfo;
    private $imageResource = null;

    /**
     * 构造函数 - 接受本地图片路径
     * @param string $sourcePath 本地图片的字符串路径
     * @param int $memoryLimit 处理图片时的内存限制(MB)，默认64MB
     * @throws InvalidArgumentException 当文件不存在或不是支持的图片类型时
     */
    public function __construct($sourcePath, $memoryLimit = 64) {
        $this->sourcePath = $sourcePath;
        $this->memoryLimit = $memoryLimit;

        // 验证文件存在性和可读性
        if (!file_exists($sourcePath)) {
            throw new InvalidArgumentException("图片文件不存在: {$sourcePath}");
        }

        if (!is_readable($sourcePath)) {
            throw new InvalidArgumentException("图片文件不可读: {$sourcePath}");
        }

        // 获取并验证图片信息
        $this->imageInfo = $this->getImageInfo();
        $this->validateImageType();

        // 设置内存限制
        $this->setMemoryLimit();
    }

    /**
     * 获取图片信息并验证文件完整性
     */
    private function getImageInfo() {
        $info = getimagesize($this->sourcePath);

        if (!$info) {
            throw new RuntimeException("无效的图片文件: {$this->sourcePath}");
        }

        return [
            'width' => $info[0],
            'height' => $info[1],
            'mime' => $info['mime'],
            'size' => filesize($this->sourcePath),
            'extension' => image_type_to_extension($info[2], false)
        ];
    }

    /**
     * 验证图片类型是否被支持
     */
    private function validateImageType() {
        if (!in_array($this->imageInfo['mime'], $this->supportedMimeTypes)) {
            throw new InvalidArgumentException(
                "不支持的图片类型: {$this->imageInfo['mime']}. " .
                "支持的类型: " . implode(', ', $this->supportedMimeTypes)
            );
        }
    }

    /**
     * 设置内存限制
     */
    private function setMemoryLimit() {
        $currentLimit = ini_get('memory_limit');
        $currentLimitBytes = $this->convertMemoryToBytes($currentLimit);
        $newLimitBytes = $this->memoryLimit * 1024 * 1024;

        if ($newLimitBytes > $currentLimitBytes) {
            ini_set('memory_limit', $this->memoryLimit . 'M');
        }
    }

    /**
     * 将内存限制字符串转换为字节数
     */
    private function convertMemoryToBytes($memory) {
        $memory = trim($memory);
        $last = strtolower($memory[strlen($memory) - 1]);

        switch ($last) {
            case 'g':
                $memory = (int)$memory * 1024 * 1024 * 1024;
                break;
            case 'm':
                $memory = (int)$memory * 1024 * 1024;
                break;
            case 'k':
                $memory = (int)$memory * 1024;
                break;
            default:
                $memory = (int)$memory;
        }

        return $memory;
    }

    /**
     * 创建图片资源
     */
    private function createImageResource() {
        switch ($this->imageInfo['mime']) {
            case 'image/jpeg':
                $this->imageResource = imagecreatefromjpeg($this->sourcePath);
                break;
            case 'image/png':
                $this->imageResource = imagecreatefrompng($this->sourcePath);
                imagesavealpha($this->imageResource, true);
                break;
            case 'image/gif':
                $this->imageResource = imagecreatefromgif($this->sourcePath);
                break;
            case 'image/webp':
                if (!function_exists('imagecreatefromwebp')) {
                    throw new RuntimeException("当前PHP环境不支持WebP格式");
                }
                $this->imageResource = imagecreatefromwebp($this->sourcePath);
                imagesavealpha($this->imageResource, true);
                break;
            default:
                throw new RuntimeException("不支持的图片格式");
        }

        if (!$this->imageResource) {
            throw new RuntimeException("无法创建图片资源，可能是损坏的图片文件");
        }
    }

    /**
     * 释放图片资源
     */
    private function freeResource() {
        if ($this->imageResource !== null) {
            imagedestroy($this->imageResource);
            $this->imageResource = null;
        }
    }

    /**
     * 原比例压缩
     * $maxSize 2097152（2兆）
     */
    public function compressProportionally($maxWidth, $maxSize = 2097152, $outputPath='', $quality = 80) {
        // 检查是否需要压缩
        if ($this->imageInfo['width'] <= $maxWidth && $this->imageInfo['size'] <= $maxSize) {
            return copy($this->sourcePath, $outputPath);
        }

        // 计算新尺寸
        $ratio = $maxWidth / $this->imageInfo['width'];
        $newWidth = $maxWidth;
        $newHeight = (int)($this->imageInfo['height'] * $ratio);

        return $this->resizeImage($newWidth, $newHeight, $outputPath, $quality);
    }

    /**
     * 裁剪压缩
     */
    public function cropAndCompress($targetWidth, $targetHeight, $cropMode, $outputPath, $quality = 80) {
        $this->createImageResource();

        // 计算裁剪区域
        $sourceRatio = $this->imageInfo['width'] / $this->imageInfo['height'];
        $targetRatio = $targetWidth / $targetHeight;

        // 确定裁剪区域的宽度和高度
        if ($sourceRatio > $targetRatio) {
            $cropWidth = (int)($this->imageInfo['height'] * $targetRatio);
            $cropHeight = $this->imageInfo['height'];
        } else {
            $cropWidth = $this->imageInfo['width'];
            $cropHeight = (int)($this->imageInfo['width'] / $targetRatio);
        }

        // 确定裁剪起始点
        switch ($cropMode) {
            case self::CROP_CENTER:
                $x = (int)(($this->imageInfo['width'] - $cropWidth) / 2);
                $y = (int)(($this->imageInfo['height'] - $cropHeight) / 2);
                break;
            case self::CROP_TOP:
                $x = (int)(($this->imageInfo['width'] - $cropWidth) / 2);
                $y = 0;
                break;
            case self::CROP_BOTTOM:
                $x = (int)(($this->imageInfo['width'] - $cropWidth) / 2);
                $y = $this->imageInfo['height'] - $cropHeight;
                break;
            case self::CROP_TOP_LEFT:
                $x = 0;
                $y = 0;
                break;
            case self::CROP_TOP_RIGHT:
                $x = $this->imageInfo['width'] - $cropWidth;
                $y = 0;
                break;
            default:
                throw new InvalidArgumentException("无效的裁剪模式: {$cropMode}");
        }

        // 创建目标图像
        $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);
        $this->handleTransparency($targetImage);

        // 裁剪并调整大小
        $result = imagecopyresampled(
            $targetImage,
            $this->imageResource,
            0, 0, $x, $y,
            $targetWidth, $targetHeight,
            $cropWidth, $cropHeight
        );

        if (!$result) {
            imagedestroy($targetImage);
            $this->freeResource();
            throw new RuntimeException("图片裁剪失败");
        }

        // 保存图像
        $saveResult = $this->saveImage($targetImage, $outputPath, $quality);

        // 释放资源
        imagedestroy($targetImage);
        $this->freeResource();

        return $saveResult;
    }

    /**
     * 调整图片大小
     */
    private function resizeImage($newWidth, $newHeight, $outputPath, $quality) {
        $this->createImageResource();

        // 创建目标图像
        $targetImage = imagecreatetruecolor($newWidth, $newHeight);
        $this->handleTransparency($targetImage);

        // 调整大小
        $result = imagecopyresampled(
            $targetImage,
            $this->imageResource,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $this->imageInfo['width'],
            $this->imageInfo['height']
        );

        if (!$result) {
            imagedestroy($targetImage);
            $this->freeResource();
            throw new RuntimeException("图片缩放失败");
        }

        // 保存图像
        $saveResult = $this->saveImage($targetImage, $outputPath, $quality);

        // 释放资源
        imagedestroy($targetImage);
        $this->freeResource();

        return $saveResult;
    }

    /**
     * 处理图像透明度
     */
    private function handleTransparency($targetImage) {
        if (in_array($this->imageInfo['mime'], ['image/png', 'image/gif', 'image/webp'])) {
            imagealphablending($targetImage, false);
            imagesavealpha($targetImage, true);
            $transparent = imagecolorallocatealpha($targetImage, 255, 255, 255, 127);
            imagefilledrectangle($targetImage, 0, 0, imagesx($targetImage), imagesy($targetImage), $transparent);
        }
    }

    /**
     * 保存图片到文件
     */
    private function saveImage($imageResource, $outputPath, $quality) {
        // 确保目录存在
        $dir = dirname($outputPath);
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new RuntimeException("无法创建输出目录: {$dir}");
        }

        // 根据图片类型保存
        switch ($this->imageInfo['mime']) {
            case 'image/jpeg':
                $quality = max(0, min(100, $quality));
                return imagejpeg($imageResource, $outputPath, $quality);
            case 'image/png':
                $pngQuality = 9 - min(9, max(0, (int)($quality / 10)));
                return imagepng($imageResource, $outputPath, $pngQuality);
            case 'image/gif':
                return imagegif($imageResource, $outputPath);
            case 'image/webp':
                if (!function_exists('imagewebp')) {
                    throw new RuntimeException("当前PHP环境不支持WebP格式");
                }
                $quality = max(0, min(100, $quality));
                return imagewebp($imageResource, $outputPath, $quality);
            default:
                return false;
        }
    }

    /**
     * 获取图片信息
     */
    public function getInfo() {
        return $this->imageInfo;
    }

    /**
     * 获取支持的图片类型
     */
    public function getSupportedTypes() {
        return $this->supportedMimeTypes;
    }
}
/*
    DEMO
    try {
        // 传入本地图片路径初始化
        $compressor = new ImageCompressor('/path/to/local/image.jpg');

        // 获取图片信息
        $imageInfo = $compressor->getInfo();
        echo "原始图片: {$imageInfo['width']}x{$imageInfo['height']}, {$imageInfo['mime']}\n";

        // 原比例压缩
        $compressor->compressProportionally(
            maxWidth: 1000,
            maxSize: 2097152, // 2MB
            outputPath: '/path/to/output/compressed.jpg',
            quality: 85
        );

        // 裁剪压缩 - 居中裁剪
        $compressor->cropAndCompress(
            targetWidth: 500,
            targetHeight: 300,
            cropMode: ImageCompressor::CROP_CENTER,
            outputPath: '/path/to/output/cropped-center.jpg'
        );

        echo "图片处理完成";
    } catch (Exception $e) {
        // 捕获并处理所有可能的错误
        echo "处理失败: " . $e->getMessage();
    }
 */