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
use Swoole\Server;
use Swoole\Server\Task;
use think\facade\Log;

/**
 * 任务监听
 */
class TaskListen
{
    public function handle(Task $task)
    {
        var_dump('on task');
        var_dump($task->data);//task的data数据即server->task()传入的数据
        $task->finish($task->data);//这里必须手动执行finish,否则不会触发onFinish监听事件
        return ;
    }
}
