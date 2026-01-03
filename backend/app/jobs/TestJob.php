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

class TestJob extends BaseJobs
{
    /**
     * 默认执行方法
     * 调用 Queue::push( 'app\jobs\TestJob', [] ]);
     * @param $data
     * @return bool
     */
    public function doJob($data)
    {

        echo date("Y-m-d H:i:s").PHP_EOL;
        log_push('integral.log','test');
        return true;
    }
}