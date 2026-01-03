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
namespace core\subscribes;
use app\agent\services\OnlineService;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\facade\Log;

/**
 * 定时任务类
 */
class TaskSubscribe
{

    public function handle()
    {}

    /**
     * 2秒钟执行的方法
     */
    public function onTask_2()
    {}

    /**
     * 6秒钟执行的方法
     */
    public function onTask_6()
    {}


    /**
     * 10秒钟执行的方法
     */
    public function onTask_10()
    {}

    /**
     * 30秒钟执行的方法
     */
    public function onTask_30()
    {}

    /**
     * 60秒钟执行的方法
     */
    public function onTask_60()
    {

        try {
            //处理内容
            OnlineService::handleOfflineUser();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            Log::error('onTask_60任务失败，'.$e->getMessage());
        }

    }

    /**
     * 3钟执行的方法
     */
    public function onTask_180()
    {}

    /**
     * 5钟执行的方法
     */
    public function onTask_300()
    {}

    /**
     * 30钟执行的方法
     */
    public function onTask_1800()
    {}

    /**
     * 1小时执行的方法
     */
    public function onTask_3600()
    {}

    /**
     * 12小时执行的方法
     */
    public function onTask_43200()
    {
        //处理
        /*
        try {
            OrderService::auto_complete();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            Log::error('自动收货处理错误'.$e->getMessage());
        }
        */
    }

    /**
     * 24小时执行的方法
     */
    public function onTask_86400()
    {}
}