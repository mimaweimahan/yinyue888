<?php

namespace core\swoole\webscoket;

use think\swoole\Websocket;

class Event
{
    protected $websocket;

    public function __construct()
    {
        $this->websocket = app(Websocket::class);
    }

    public function handle($event)
    {
        $fd = $this->websocket->getSender();
        echo "client {$fd} Event\n";
        //echo '接收到事件: ' . $event->type . ' --- ' . $event->data . "\n";

    }
}