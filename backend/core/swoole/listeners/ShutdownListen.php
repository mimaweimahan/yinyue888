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
namespace core\swoole\listeners;
use core\swoole\interfaces\ListenerInterface;
use Swoole\Timer;
class ShutdownListen implements ListenerInterface
{
    public function handle($event): void
    {
        Timer::clearAll();
        log_push('shut_down_listen.log','停止监听');
    }
}
