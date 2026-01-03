<?php
// 事件定义文件
return [
    'bind'      => [],
    'listen'    => [
        'AppInit'  => [],
        'HttpRun'  => [],
        'HttpEnd'  => [],
        'LogLevel' => [],
        'LogWrite' => [],
        'swoole.init' => [\core\swoole\listeners\InitLockListen::class],//swoole 初始化事件
        'swoole.start' => [\core\swoole\listeners\StartListen::class],//swoole 启动事件
        'swoole.shutDown' => [\core\swoole\listeners\ShutdownListen::class],//swoole 停止事件
        'swoole.workerStart' => [\core\swoole\listeners\WorkerStartListen::class],//socket 启动事件
    ],
    'subscribe' => [
        core\subscribes\TaskSubscribe::class,//定时任务事件订阅类
    ]
];