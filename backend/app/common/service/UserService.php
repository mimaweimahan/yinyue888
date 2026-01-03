<?php

namespace app\common\service;
use app\common\model\User;
class UserService
{
    /**
     * 获取用户的1-3级推荐用户ID
     *
     * @param int $userId 起始用户ID
     * @param int $maxLevel 最大层级，默认为3
     * @param bool $hb 是否合并全部uid
     * @return array 包含各层级推荐用户ID的数组
     *
     */
    public static function getReferralUserIds($userId, $maxLevel = 3,$hb=false) {
        // 初始化结果数组，包含1-3级推荐用户
        $result = [
            1 => [],
            2 => [],
            3 => []
        ];

        // 如果最大层级小于1，则直接返回空结果
        if ($maxLevel < 1) {
            return $result;
        }

        // 获取一级推荐用户
        $level1Users = User::where('referee_id', $userId)
            ->column('id');

        $result[1] = $level1Users;

        // 如果最大层级为1，直接返回结果
        if ($maxLevel == 1) {
            return $result;
        }

        // 获取二级推荐用户
        if (!empty($level1Users)) {
            $level2Users = User::whereIn('referee_id', $level1Users)
                ->column('id');

            $result[2] = $level2Users;
        }

        // 如果最大层级为2，返回结果
        if ($maxLevel == 2) {
            return $result;
        }

        // 获取三级推荐用户
        if (!empty($result[2])) {
            $level3Users = User::whereIn('referee_id', $result[2])
                ->column('id');

            $result[3] = $level3Users;
        }
        if($hb){
            $_result = array_merge($result[1],$result[2],$result[3]);
        }else{
            $_result = $result;
        }
        return $_result;
    }

    /**
     * 获取用户的1-3级推荐用户ID（递归版本）
     *
     * @param int $userId 起始用户ID
     * @param int $currentLevel 当前层级
     * @param int $maxLevel 最大层级
     * @param array $result 结果数组
     * @return array 包含各层级推荐用户ID的数组
     */
    public static function getReferralUsersRecursive($userId, $currentLevel = 1, $maxLevel = 3, &$result = []) {
        // 初始化结果数组
        if (empty($result)) {
            $result = [
                1 => [],
                2 => [],
                3 => []
            ];
        }

        // 如果当前层级超过最大层级，停止递归
        if ($currentLevel > $maxLevel) {
            return $result;
        }

        // 获取当前层级的推荐用户
        $users = User::where('referee_id', $userId)->column('id');

        // 将当前层级的用户ID添加到结果中
        if (!empty($users)) {
            $result[$currentLevel] = array_merge($result[$currentLevel] ?? [], $users);

            // 递归获取下一级推荐用户
            foreach ($users as $user) {
                self::getReferralUsersRecursive($user, $currentLevel + 1, $maxLevel, $result);
            }
        }

        return $result;
    }
}