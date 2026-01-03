<?php

namespace app\tool\controller;

use app\agent\model\Ptask;
use app\common\model\User;

class Batch
{
    public function index()
    {
        return 'hello world';
    }

    public function run()
    {
        $map[] = ['task_num','>',0];
        $map[] = ['task_done','>',0];
        $list = User::where($map)->whereColumn('task_done', '>=', 'task_num')->select();
        $r = [];
        foreach ($list as $user){
            $user->task_done = 0;
            $user->task_batch = $user->task_batch + 1;
            $user->save();
            //清空派单
            Ptask::where('uid', $user->id)->delete();
            $r[] = $user->id;
        }
        return json($r);
    }
}