<?php
declare (strict_types = 1);
/**
 * Created by PhpStorm.
 * Explain: 权限验证中间件（备用）
 */
namespace app\admin\middleware;
use Closure;
use think\Request;
use think\Response;
use think\facade\Config;
class RuleVerify
{
    /**
     * 处理请求
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        //todo 权限逻辑 exit('没有权限！');
        return $next($request);
    }
}
