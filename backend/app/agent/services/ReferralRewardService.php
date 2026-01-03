<?php
namespace app\agent\services;
use app\agent\model\Orders;
use app\common\model\user\UserWallet;
use think\facade\Db;
use app\common\model\User;
class ReferralRewardService
{
    /**
     * 执行三级分销奖励
     *
     * @param int $userId 下单用户ID
     * @param float $orderAmount 订单金额
     * @param int $order_id 订单id
     * @return array 奖励执行结果
     */
    public static function executeReward(int $userId, float $orderAmount,int $order_id=0): array
    {
        // 验证订单金额有效性
        if ($orderAmount <= 0) {
            return ['success' => false, 'message' => '订单金额必须大于0'];
        }

        // 获取下单用户信息
        $user = User::find($userId);
        if (!$user) {
            return ['success' => false, 'message' => '用户不存在'];
        }

        // 定义各级推荐人奖励比例
        $rewardRates = [
            1 => floatval(getConfig('level1_rate')/100),  // 一级推荐人 15%
            2 => floatval(getConfig('level2_rate')/100),  // 二级推荐人 10%
            3 => floatval(getConfig('level3_rate')/100)   // 三级推荐人 5%
        ];

        $result = [
            'code' => 1,
            'message' => '分销奖励执行成功',
            'rewards' => []
        ];

        // 开启数据库事务
        Db::startTrans();
        try {
            $currentUserId = $user->referee_id;
            $level = 1;

            // 循环查找三级推荐人并发放奖励
            while ($currentUserId && $level <= 3) {
                // 获取当前级别的推荐人
                $referrer = User::where('id', $currentUserId)->find();
                if (!$referrer) {
                    break; // 推荐人不存在，终止向上查找
                }
                $f_data = [
                    'agent_id'  => $referrer->agent_id,
                    'worker_id' => $referrer->worker_id,
                    'user_type' => $referrer->user_type,
                    'from_user_id' => $userId,
                    'from_user_level' => $level,
                    'actype'    => 0,
                ];
                // 计算奖励金额
                $rewardAmount = $orderAmount * $rewardRates[$level];

                $do = UserWallet::updateAc($referrer->id,['balance' => $rewardAmount],5,'推荐奖励',$f_data);
                if($do['code'] == 1){
                    // 记录奖励信息
                    Orders::update(['reward_level_'.$level=>1],['id'=>$order_id]);
                }else{
                    break; // 执行奖励失败
                }

                // 记录奖励结果
                $result['rewards'][] = [
                    'level' => $level,
                    'user_id' => $referrer->id,
                    'email' => $referrer->email,
                    'reward_amount' => $rewardAmount,
                    'rate' => $rewardRates[$level] * 100 . '%'
                ];

                // 准备查找下一级推荐人
                $currentUserId = $referrer->referee_id;
                $level++;
            }

            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return ['code' => 0, 'message' => '奖励执行失败: ' . $e->getMessage()];
        }
        return $result;
    }

    /**
     * 记录奖励信息到数据库
     *
     * @param int $referrerId 推荐人ID
     * @param int $userId 下单用户ID
     * @param int $level 推荐级别
     * @param float $rewardAmount 奖励金额
     * @param float $orderAmount 订单金额
     */
    protected function recordReward(int $referrerId, int $userId, int $level, float $rewardAmount, float $orderAmount): void
    {
        // 假设存在奖励记录表tp_referral_reward
        Db::name('referral_reward')->insert([
            'referrer_id' => $referrerId,
            'user_id' => $userId,
            'level' => $level,
            'order_amount' => $orderAmount,
            'reward_amount' => $rewardAmount,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * 更新用户的奖励金额（如余额等）
     *
     * @param int $userId 用户ID
     * @param float $amount 奖励金额
     */
    protected function updateUserReward(int $userId, float $amount): void
    {
        // 这里假设用户表有一个reward_balance字段用于存储奖励余额
        // 实际应用中可根据业务逻辑调整
        User::where('id', $userId)->inc('reward_balance', $amount)->update();
    }
}