<?php
/**
 * 跨域请求中间件
 */
namespace app\common\middleware;
use Closure;
use think\Request;
use think\Response;
class AllowCrossDomain
{
    /**
     * 处理请求
     * 
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Headers: *');
//        header('Content-type:application/json; charset=UTF-8'); //['Content-Type', 'Authorization', 'X-Requested-With', 'Accept']
//        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, HEAD, multipart');
//        header('Access-Control-Allow-Credentials: true');
//        if ($request->isOptions()) {
//            return Response::create();
//        }
//        return $next($request);

        // 允许所有来源
        $allowOrigin = "*";
        // 获取请求中的所有头信息
        $requestHeaders = $request->header('Access-Control-Request-Headers', '*');
        // 设置跨域响应头 - 关键修复
        header("Access-Control-Allow-Origin: {$allowOrigin}");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: {$requestHeaders}, Content-Type, XMLHttpRequest, X-Requested-With");
        header("Access-Control-Allow-Credentials: false");
        header("Access-Control-Max-Age: 86400");
        header("Access-Control-Expose-Headers: *");

        // 处理OPTIONS请求 - 关键修复
        if ($request->method() === 'OPTIONS') {
            // 直接直接返回空响应，不经过后续中间件
            return response('', 204)
                ->header([
                    'Access-Control-Allow-Origin'      => $allowOrigin,
                    'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers'     => "{$requestHeaders}, Content-Type, X-Requested-With, XMLHttpRequest",
                    'Access-Control-Allow-Credentials' => 'false',
                    'Access-Control-Max-Age'           => '86400',
                ]);
        }

        $response = $next($request);

        // 确保响应中也包含跨域头
        return $response->header([
            'Access-Control-Allow-Origin'      => $allowOrigin,
            'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers'     => "{$requestHeaders}, Content-Type, X-Requested-With, XMLHttpRequest",
            'Access-Control-Allow-Credentials' => 'false',
            'Access-Control-Max-Age'           => '86400',
        ]);
    }
}
