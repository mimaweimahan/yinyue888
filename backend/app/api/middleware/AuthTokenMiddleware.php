<?php
namespace app\api\middleware;
use app\Request;
use app\common\model\user\UserToken;
use app\api\AuthException;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
/**
 * token验证中间件
 * Class AuthTokenMiddleware
 * @package app\http\middleware
 */
class AuthTokenMiddleware
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @param bool $force
     * @return mixed
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function handle(Request $request, \Closure $next, bool $force = true)
    {
        $authInfo = null;
        $token = $request->header('Authorization','');
        if($token){
            $token = trim($token);
        }
        try {
            $authInfo = UserToken::parseToken($token);
        } catch (AuthException $e) {
            if ($force){
                return app('json')->make($e->getCode(), $e->getMessage());
            }
        }
        if (!is_null($authInfo)) {
            Request::macro('user', function () use (&$authInfo) {
                return $authInfo['user'];
            });
        }
        Request::macro('isLogin', function () use (&$authInfo) {
            return !is_null($authInfo);
        });

        Request::macro('uid', function () use (&$authInfo) {
            return is_null($authInfo) ? 0 : $authInfo['user']->id;
        });
        return $next($request);
    }
}