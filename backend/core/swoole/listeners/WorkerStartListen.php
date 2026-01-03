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
use think\facade\Log;
use think\swoole\Websocket;
use think\swoole\Manager;
class WorkerStartListen implements ListenerInterface
{
    protected $websocket = null;
    protected $manager = null;
    protected $interval = 2000;
    public function __construct(Websocket $websocket, Manager $manager)
    {
        $this->websocket = $websocket;
        $this->manager = $manager;
    }

    public function handle($event): void
    {
        $worker_id = $this->manager->getWorkerId();//获取连接标识
        if($worker_id==0){
            $this->timer();
        }
    }

    /**
     * 开启定时器
     */
    protected function timer()
    {
        //开启定时器
        $last = time();
        $task = [
            6 => $last,
            10 => $last,
            30 => $last,
            60 => $last,
            180 => $last, //3钟
            300 => $last, //5钟
            600 => $last, //10钟
            1800 => $last, //30钟
            3600 => $last, //1小时
            43200 => $last, //12小时
            86400 => $last, //24小时
        ];
        Timer::tick($this->interval, function () use (&$task) {
            try {
                $now = time();
                event('Task_2');
                foreach ($task as $num => $time) {
                    if ($now - $time >= $num) {
                        event('Task_' . $num);
                        $task[$num] = $now;
                    }
                }
            } catch (\Throwable $e) {
                //log_push('timer',$e->getMessage());
                Log::error($e->getMessage());
            }
        });
    }
}