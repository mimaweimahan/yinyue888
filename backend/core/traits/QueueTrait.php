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
namespace core\traits;
use core\utils\Queue;
/**
 * 快捷加入消息队列
 * Trait QueueTrait
 */
trait QueueTrait
{
    /**
     * 列名
     * @return string
     */
    protected static function queueName()
    {
        return null;
    }

    /**
     * 加入队列
     * @param array|string|int $action
     * @param array $data
     * @param string|null $queueName
     * @return mixed
     */
    public static function dispatch($action, array $data = [], string $queueName = null)
    {
        $queue = Queue::instance()->job(__CLASS__);
        if (is_array($action)) {
            $queue->data(...$action);
        } else if (is_string($action)) {
            $queue->do($action)->data(...$data);
        }
        if ($queueName) {
            $queue->setQueueName($queueName);
        } else if (self::queueName()) {
            $queue->setQueueName(self::queueName());
        }
        return $queue->push();
    }

    /**
     * 延迟加入消息队列
     * @param int $secs 延迟执行秒数
     * @param $action
     * @param array $data
     * @param string|null $queueName
     * @return mixed
     */
    public static function dispatchSece(int $secs, $action, array $data = [], string $queueName = null)
    {
        $queue = Queue::instance()->job(__CLASS__)->secs($secs);
        if (is_array($action)) {
            $queue->data(...$action);
        } else if (is_string($action)) {
            $queue->do($action)->data(...$data);
        }
        if ($queueName) {
            $queue->setQueueName($queueName);
        } else if (self::queueName()) {
            $queue->setQueueName(self::queueName());
        }
        return $queue->push();
    }

    /**
     * 加入小队列
     * @param string $do 方法名称
     * @param array $data 传递数据
     * @param int|null $secs  延迟执行秒数
     * @param string|null $queueName 队列名称
     * @return mixed
     */
    public static function dispatchDo(string $do, array $data = [], int $secs = null, string $queueName = null)
    {
        $queue = Queue::instance()->job(__CLASS__)->do($do);
        if ($secs) {
            $queue->secs($secs);
        }
        if ($data) {
            $queue->data(...$data);
        }
        if ($queueName) {
            $queue->setQueueName($queueName);
        } else if (self::queueName()) {
            $queue->setQueueName(self::queueName());
        }
        return $queue->push();
    }
}
