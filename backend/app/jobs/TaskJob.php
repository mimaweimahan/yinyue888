<?php
// +----------------------------------------------------------------------
// | TT[ 管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020~2030 https://www.x.com All rights reserved
// +----------------------------------------------------------------------
// | Licensed TT[管理系统] 并不是自由软件，未经许可不能去掉TT相关版权及二次开发
// +----------------------------------------------------------------------
// | Author: TT
// +----------------------------------------------------------------------
namespace app\jobs;
use core\basic\BaseJobs;
use Swoole\Coroutine;
use Swoole\Coroutine\Channel;
use Swoole\Coroutine\WaitGroup;
use function Swoole\Coroutine\go;
use function Swoole\Coroutine\run;

class TaskJob extends BaseJobs
{
    /**
     * 默认执行方法
     * 调用 Queue::push( 'app\jobs\TaskJob', [] ]);
     * @param $data
     * @return bool
     */
    public function doJob($data)
    {
        $startTime = microtime(true);
        $result = array();

        go(function () use (&$result) {
            $result[1] = microtime(true);
        });
        go(function () use (&$result) {
            $result[2] = microtime(true);
        });
        go(function () use (&$result) {
            $result[3] = microtime(true);
        });
        echo microtime(true) - $startTime;
        log_push('integral.log',var_export($result,true));
        return true;
    }
}