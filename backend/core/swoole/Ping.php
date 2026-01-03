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
namespace core\swoole;
use think\facade\Log;
use think\swoole\App;
/**
 * Class Ping
 * @package app\webscoket
 */
class Ping
{
    /**
     * @var \think\cache\Driver
     */
    protected $redis;
    const CACHE_PINK_KEY = 'ws.p.';
    const CACHE_SET_KEY = 'ws.s';
    /**
     * Ping constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        try {
            $this->redis = $app->cache->store('redis');
            $this->destroy();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param $time
     * @param int $timeout
     */
    public function createPing($id, $time, $timeout = 0)
    {
        $this->updateTime($id, $time, $timeout);
        $this->redis->sAdd(self::CACHE_SET_KEY, $id);
    }

    /**
     * @param $id
     * @param $time
     * @param int $timeout
     */
    public function updateTime($id, $time, $timeout = 0)
    {
        $this->redis->set(self::CACHE_PINK_KEY . $id, $time, $timeout);
    }

    /**
     * @param $id
     */
    public function removePing($id)
    {
        $this->redis->del(self::CACHE_PINK_KEY . $id);
        $this->redis->del(self::CACHE_SET_KEY, $id);
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function getLastTime($id)
    {
        try {
            return $this->redis->get(self::CACHE_PINK_KEY . $id);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return null;
        }

    }

    /**
     */
    public function destroy()
    {
        $members = $this->redis->sMembers(self::CACHE_SET_KEY) ?: [];
        foreach ($members as $k => $member) {
            $members[$k] = self::CACHE_PINK_KEY . $member;
        }
        if (count($members))
            $this->redis->sRem(self::CACHE_SET_KEY, ...$members);
    }
}
