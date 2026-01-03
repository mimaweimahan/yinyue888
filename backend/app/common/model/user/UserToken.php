<?php
declare (strict_types = 1);
/**
 * Explain: 登录TOKEN
 */
namespace app\common\model\user;
use app\common\model\User;
use app\common\model\BaseModel;
use app\common\traits\ModelTrait;
use app\api\AuthException;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class UserToken extends BaseModel
{
    protected $name = 'user_token';

    protected $type = [
        'create_time' => 'datetime',
        'login_ip' => 'string'
    ];
    protected $autoWriteTimestamp = true;
    protected $updateTime = false;

    use ModelTrait;

    public static function onBeforeInsert(UserToken $token)
    {
        if (!isset($token['login_ip']))
            $token['login_ip'] = app()->request->ip();
    }

    /**
     * 创建token并且保存
     * @param User $user
     * @param $type
     * @return UserToken
     */
    public static function createToken(User $user, $type): self
    {
        $tokenInfo = $user->getToken($type);
        return self::create([
            'uid' => $user->id,
            'token' => $tokenInfo['token'],
            'expires_time' => date('Y-m-d H:i:s', $tokenInfo['params']['exp'])
        ]);
    }

    /**
     * 创建token并且保存
     * @param $uid
     * @param $type
     * @return static
     */
    public static function createUidToken($uid, $type): self
    {
        $tokenInfo = (new User())->getUidToken($uid,$type);
        return self::create([
            'uid' => $uid,
            'token' => $tokenInfo['token'],
            'expires_time' => date('Y-m-d H:i:s', $tokenInfo['params']['exp'])
        ]);
    }

    /**
     * 删除一天前的过期token
     * @return bool
     * @throws \Exception
     */
    public static function delToken(): bool
    {
        return self::where('expires_time', '<', date('Y-m-d H:i:s',strtotime('-1 day')))->delete();
    }

    /**
     * 获取授权信息
     * @param $token
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function parseToken($token): array
    {
        if (!$token || !$tokenData = (new self())->where('token', $token)->find())
            throw new AuthException('请登录', 410000);
        try {
            [$user, $type] = User::parseToken($token);
        } catch (\Throwable $e) {
            $tokenData->delete();
            throw new AuthException('登录已过期,请重新登录', 410001);
        }

        if (!$user || $user->id != $tokenData->uid) {
            $tokenData->delete();
            throw new AuthException('登录状态有误,请重新登录', 410002);
        }
        $tokenData->type = $type;
        return compact('user', 'tokenData');
    }
}