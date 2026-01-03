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
declare (strict_types=1);
namespace app\common\service;
use app\api\AuthException;
use app\common\model\User;
use core\services\CacheService;
use utils\JwtAuth;

/**
 * Class UserAuthServices
 * @package app\services\user
 */
class UserAuthServices
{
    /**
     * 获取授权信息
     * @param $token
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function parseToken($token): array
    {
        $md5Token = is_null($token) ? '' : md5($token);
        if ($token === 'undefined') {
            throw new AuthException('请登录', 410000);
        }
        if (!$token || !$tokenData = CacheService::getTokenBucket($md5Token))
            throw new AuthException('请登录', 410000);

        if (!is_array($tokenData) || empty($tokenData) || !isset($tokenData['uid'])) {
            throw new AuthException('请登录', 410000);
        }

        $jwtAuth = app()->make(JwtAuth::class);
        //设置解析token
        [$id, $type] = $jwtAuth->parseToken($token);

        try {
            $jwtAuth->verifyToken();
        } catch (\Throwable $e) {
            if (!request()->isCli()) CacheService::clearToken($md5Token);
            throw new AuthException('登录已过期,请重新登录', 410001);
        }
        $user = User::get($id);
        if (!$user || $user->uid != $tokenData['uid']) {
            if (!request()->isCli()) \services\CacheService::clearToken($md5Token);
            throw new AuthException('登录状态有误,请重新登录', 410002);
        }
        $tokenData['type'] = $type;
        return compact('user', 'tokenData');
    }
}
