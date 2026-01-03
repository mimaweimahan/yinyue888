<?php
declare (strict_types = 1);
/**
 * Explain: 用户类型
 */
namespace app\common\model\user;
use app\agent\model\WalletLog;
use app\common\model\BaseModel;
use app\common\model\User;
use app\common\traits\ModelTrait;
use app\admin\model\Admin;
class UserWallet extends BaseModel
{
    use ModelTrait;
    /**
     * 更新账户
     * @param int $uid 用户ID
     * @param array $field ['bi'=>0,'integral'=>0,'amount'=>0]
     * @param string $note 记录说明
     * @param int $type 记录类型 1消费、2充值、3提现、4收益、5奖励、6转账,50占用,51解押,52赠金,53出金,54上分,55下分
     * @param array $arr_data 记录附加数据
     * @return array
     */
    public static function updateAc(int $uid=0, array $field=[], int $type=53, string $note='记录说明', array $arr_data=[])
    {
        if(!$uid){
            return ['code'=>0,'msg'=>'用户ID为空'];
        }
        self::startTrans();
        // actype->0|balance:可用账户, actype->1|体验金:frozen_balance, actype->2|交易账户:freeze_balance
        // 0balance，1frozen_balance,2freeze_balance
        try {
            $admin_name = '';
            $_fields = self::getToArray(['uid'=>$uid]);
            if(!$_fields){
                return ['code'=>0,'msg'=>'缺少更新状态'];
            }
            $model = (new self())->where(['uid'=>$uid]);
            $user = User::getToArray(['id'=>$uid],'agent_id,worker_id,user_type');
            if($admin = Admin::loginAdmin()){
                $admin_name = $admin['nickname'];
            }
            // 更新字段
            $update_data = [];

            // 记录数据
            $log_data =[
                'uid'=>$uid,
                'user_type'=>$user['user_type'],
                'agent_id'=>$user['agent_id'],
                'worker_id'=>$user['worker_id'],
                'change_type'=>$type,
                'change_desc'=>$note,
                'do_user'=>$admin_name,
                'updated_at'=>time(),
                'created_at'=>time(),
            ];

            $arr_data['agent_id']  = $user['agent_id'];
            $arr_data['worker_id'] = $user['worker_id'];
            $arr_data['user_type'] = $user['user_type'];

            $wallet = self::getToArray(['uid'=>$uid]);
            foreach ( $_fields as $key=>$v){
                if ($key =='uid') {
                    continue; // 当$value等于3时，跳过当前迭代，继续下一个迭代
                }
                if (isset($field[$key]) && !$field[$key]==0){
                    $_val = floatval($field[$key]);
                    $model->inc($key,$_val);
                    $update_data[$key] = $_val;
                    $log_data[$key] = $_val;
                    $log_data['current_'.$key] = $_val+floatval($wallet[$key]);
                }
            }

            $model->save();
            if( count($update_data)<1 ){
                self::rollback();
                return ['code'=>0,'msg'=>'缺少更新状态'];
            }

            if($log_data){
                $log_data = array_merge($log_data,$arr_data);
            }
            // 写入账户记录
            $rt = WalletLog::create($log_data);
            if($rt->id){
                self::commit();
                return ['code'=>1,'msg'=>'操作成功','data'=>$log_data];
            }else{
                self::rollback();
                return ['code'=>0,'msg'=>'操作失败', 'data'=>$rt];
            }
        }catch (\Exception $e){
            self::rollback();
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }
}