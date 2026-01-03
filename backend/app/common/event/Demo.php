<?php
declare (strict_types = 1);
namespace app\common\event;
use think\facade\Log;
class Demo
{
    /**
     * 用户成功登录后
     * @param $event
     */
    public function handle($event): void
    {
        [$name,$data] = $event;
        Log::error("记录状态:{$name}_{$data}");
    }
}