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
use core\swoole\Room;
use core\services\CacheService;
use core\swoole\interfaces\ListenerInterface;
/**
 * swoole启动监听
 */
class StartListen implements ListenerInterface
{
    /**
     * 事件执行
     * @param $event
     */
    public function handle($event): void
    {
        log_push('start_listen.log','启动监听');
    }
}
