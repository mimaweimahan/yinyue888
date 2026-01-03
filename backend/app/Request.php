<?php
namespace app;
// 应用请求对象类
use Spatie\Macroable\Macroable;
class Request extends \think\Request
{
    // 全局过滤规则
    protected $filter = ['trim'];
    use Macroable;
}
