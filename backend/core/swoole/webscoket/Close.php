<?php

namespace core\swoole\webscoket;
use think\swoole\Websocket;
class Close
{
    protected $websocket;

    public function __construct()
    {
        $this->websocket = app(Websocket::class);
    }

    public function handle($event)
    {
        $fd = $this->websocket->getSender();
        echo "client {$fd} Close\n";
    }
}