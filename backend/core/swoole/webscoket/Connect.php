<?php

namespace core\swoole\webscoket;
use think\swoole\Websocket;
class Connect
{
    protected $websocket;

    public function __construct()
    {
        $this->websocket = app(Websocket::class);
    }

    public function handle($event)
    {
        $fd = $this->websocket->getSender();
        $this->websocket->push(json_encode([
            'type' => 'connect',
            'data' => "client {$fd} Connect",
            'time' => time()
        ]));
    }
}