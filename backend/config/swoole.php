<?php
use Swoole\Table;
use core\swoole\Managers;
use core\swoole\Parser;
use \think\swoole\websocket\Handler;
return [
    'http' => [
        'enable'     => true,
        'host'       => '0.0.0.0',
        'port'       => 8088,
        'worker_num' => swoole_cpu_num(),
        'options'    => [],
    ],
    'websocket'  => [
        'enable'        => true,
        'handler'       => Managers::class,
        'ping_interval' => 25000,
        'ping_timeout'  => 60000,
        'room'          => [
            'type'  => 'table',
            'table' => [
                'room_rows'   => 8192,
                'room_size'   => 2048,
                'client_rows' => 4096,
                'client_size' => 2048,
            ],
            'redis' => [
                'host'          => '127.0.0.1',
                'port'          => 6379,
                'max_active'    => 3,
                'max_wait_time' => 5,
            ],
        ],
        'listen'        => [],
        'subscribe'     => [],
    ],
    'rpc' => [
        'server' => [
            'enable'     => false,
            'host'       => '0.0.0.0',
            'port'       => 9002,
            'worker_num' => swoole_cpu_num(),
            'services'   => [],
        ],
        'client' => [],
    ],
    //队列
    'queue'  => [
        'enable'  => true,
        'workers' => [
            'default'        => [
                'delay'      => 0,
                'sleep'      => 3,
                'tries'      => 0,
                'timeout'    => 60,
                'worker_num' => 1,
            ],
        ],
    ],
    'hot_update' => [
        'enable'  => env('APP_DEBUG', false),
        'name'    => ['*.php'],
        'include' => [app_path(), root_path('core')],
        'exclude' => [],
    ],
    //连接池
    'pool' => [
        'db' => [
            'enable'        => true,
            'max_active'    => 3,
            'max_wait_time' => 5,
        ],
        'cache' => [
            'enable'        => true,
            'max_active'    => 3,
            'max_wait_time' => 5,
        ],
        //自定义连接池
    ],
    'coroutine' => [
        'enable'=> true,
        'flags'=> SWOOLE_HOOK_ALL,
    ],
    'tables'     => [],
    //每个worker里需要预加载以共用的实例
    'concretes'  => [],
    //重置器
    'resetters'  => [],
    //每次请求前需要清空的实例
    'instances'  => [],
    //每次请求前需要重新执行的服务
    'services'   => [],
];