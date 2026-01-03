<?php
// 派单任务
namespace app\agent\model;
use app\agent\services\ReferralRewardService;
use app\common\model\User;
use app\common\model\user\UserWallet;
use app\common\traits\ModelTrait;
use app\goods\model\Goods;
use think\Model;

class Orders  extends Model
{
    use ModelTrait;

    public static function getCreatedAtAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',trim($data));
        }
        return '';
    }

    //endTime
    public static function getEndTimeAttr($data): string
    {
        if($data){
            return date('Y-m-d H:i:s',trim($data));
        }
        return '';
    }


    /**
     * 获取用户订单收益
     * @param $uid
     * @param $total_price
     * @return string
     */
    public static function getUserProfit($uid,$total_price): string
    {
        $task_rate = User::where(['id'=>$uid])->value('task_rate');
        if($task_rate>0){
            return $total_price * ($task_rate / 100);
        }
        return 0;
    }

    public function goods()
    {
        return $this->hasOne(Goods::class,'id', 'goods_id');
    }
    public function goodsPic()
    {
        return $this->hasOne(Goods::class,'id', 'goods_id')->bind(['image']);
    }

    /**
     * 确认订单
     * @param $order
     * @param $uid
     * @return int
     */
    public static function confirm($order,$uid): int
    {
        self::startTrans();
        try{
            // 扣除可用余额
            $f_data = [
                'agent_id'  => $order['agent_id'],
                'worker_id' => $order['worker_id'],
                'user_type' => $order['user_type'],
                'actype'    => 0,
            ];
            $total_price = floatval($order['total_price']);
            $profit = floatval($order['profit']);

            $user = User::getToArray(['id'=>$uid]);

            // 获取当前任务完成数
            $new_task_done = intval($user['task_done'])+1;
            if($new_task_done>$user['task_num']){
                return 0;
            }

            //解冻余额
            $rt1 = UserWallet::updateAc($uid,['balance'=>$total_price,'freeze_balance'=>-$total_price],51,'任务完成解押',$f_data);

            //奖励入账
            $rt2 = UserWallet::updateAc($uid,['balance'=>$profit],4,'获得收益',$f_data);

            //更新订单状态
            $rt3 = Orders::update(['status'=>1,'is_ready'=>1,'endTime'=>time()],['id'=>$order['id']]);

            //更新用户任务状态
            $rt4 = User::update(['task_done'=>$new_task_done],['id'=>$uid]);

            //分销奖励
            $rt5 = ReferralRewardService::executeReward($uid, $profit,$order['id']);

            //如果完成任务
            if($new_task_done>=$user['task_num']){
                //清空派单记录
                Ptask::where(['uid'=>$uid])->delete();
                //User::update(['task_batch'=>$user['task_batch']+1,'task_done'=>0],['id'=>$uid]);
            }
            
            if($rt1&&$rt2&&$rt3&&$rt4){
                self::commit();
                return $order['id'];
            }
            self::rollback();
            return 0;
        }catch (\Exception $e){
            self::rollback();
            return 0;
        }
    }


    public static function fx($referee_id,$order,$profit){
        //1级分销
        $referee_id = 0;
    }

}