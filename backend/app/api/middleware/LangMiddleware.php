<?php
namespace app\api\middleware;
use app\Request;
use think\facade\Lang;

class LangMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        $lang = $request->header('lang','en');
        Lang::setLangSet($lang);
        return $next($request);
    }
}