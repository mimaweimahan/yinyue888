<?php
namespace core\utils;
/**
 * 远程文件下载器
 * 提供静态方法用于下载远程文件到本地
 */
class FileDownloader {

    /**
     * 下载远程文件到本地
     *
     * @param string $url 远程文件URL
     * @param string $savePath 保存路径，必须以斜杠结尾
     * @param string|null $fileName 保存的文件名，为null则使用原文件名
     * @param int $timeout 超时时间(秒)，默认30秒
     * @return bool|string 成功返回保存的文件路径，失败返回false
     */
    public static function download($url, $savePath, $fileName = null, $timeout = 30) {
        // 验证URL有效性
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        // 确保保存目录存在
        if (!self::ensureDirectoryExists($savePath)) {
            return false;
        }

        // 确定文件名
        $fileName = self::determineFileName($url, $fileName);
        $saveFilePath = $savePath . $fileName;

        // 执行下载
        $fileContent = self::fetchRemoteContent($url, $timeout);
        if ($fileContent === false) {
            return false;
        }

        // 保存文件
        if (!self::saveToFile($saveFilePath, $fileContent)) {
            return false;
        }

        return $saveFilePath;
    }

    /**
     * 确保目录存在，不存在则创建
     *
     * @param string $directory
     * @return bool
     */
    private static function ensureDirectoryExists($directory) {
        if (!is_dir($directory)) {
            return mkdir($directory, 0755, true);
        }
        return true;
    }

    /**
     * 确定保存的文件名
     *
     * @param string $url
     * @param string|null $fileName
     * @return string
     */
    private static function determineFileName($url, $fileName = null) {
        if (is_null($fileName)) {
            $pathInfo = pathinfo(parse_url($url, PHP_URL_PATH));
            $fileName = $pathInfo['basename'] ?? 'downloaded_file';

            // 处理可能的空文件名
            if (empty($fileName)) {
                $fileName = 'downloaded_file_' . time();
            }
        }
        return $fileName;
    }

    /**
     * 获取远程文件内容
     *
     * @param string $url
     * @param int $timeout
     * @return bool|string
     */
    private static function fetchRemoteContent($url, $timeout) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

        // 注意：生产环境中应考虑启用SSL验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $content = curl_exec($ch);

        // 检查错误
        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        }

        // 检查HTTP响应码
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode < 200 || $httpCode >= 300) {
            return false;
        }

        return $content;
    }

    /**
     * 将内容保存到文件
     *
     * @param string $filePath
     * @param string $content
     * @return bool
     */
    private static function saveToFile($filePath, $content) {
        $fileHandle = fopen($filePath, 'wb');
        if (!$fileHandle) {
            return false;
        }

        $result = fwrite($fileHandle, $content);
        fclose($fileHandle);

        if ($result === false) {
            // 清理空文件
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            return false;
        }

        return true;
    }
}

// 使用示例
/*
$url = 'https://example.com/image.jpg';
$savePath = '/var/www/downloads/';

// 静态调用下载方法
$savedFile = RemoteFileDownloader::download($url, $savePath);

if ($savedFile) {
    echo "文件已成功下载到: " . $savedFile;
} else {
    echo "文件下载失败";
}
*/