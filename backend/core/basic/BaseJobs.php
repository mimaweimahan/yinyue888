<?php
namespace core\basic;
use core\interfaces\JobInterface;
use think\queue\Job;
class BaseJobs implements JobInterface
{
    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        $this->fire(...$arguments);
    }
    /**
     * 运行消息队列
     * Queue::later(6,'app\jobs\XXXJob', ['data'=>1])
     * Queue::push('app\jobs\XXXJob', ['data'=>1])
     * @param Job $job
     * @param $data
     */
    public function fire(Job $job, $data): void
    {
        try {
            $errorCount = 3;
            if(isset($data['errorCount']) && $data['errorCount']){
                $errorCount = $data['errorCount'];
            }
            if ($this->doJob($data)) {
                $job->delete(); //删除任务
            } else {
                if ($job->attempts() >= $errorCount ) {
                    $job->delete(); //删除任务
                } else {
                    $job->release();//从新放入队列
                }
            }
        } catch (\Throwable|\Exception|\ErrorException $e) {
            log_push('jobs.log',json_encode(['data'=>$data,'msg'=>$e->getMessage()],JSON_UNESCAPED_UNICODE));
            $job->delete();
        }
    }
}