<?php
declare (strict_types = 1);
namespace app\common\traits;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
trait JwtAuthModelTrait
{
    /**
     * @param string $type
     * @param array $params
     * @return array
     */
    public function getToken(string $type, array $params = []): array
    {
        $id   = $this->{$this->getPk()};
        $host = app()->request->host();
        $time = time();
        $params += [
            'iss' => $host,
            'aud' => $host,
            'iat' => $time,
            'nbf' => $time,
            'exp' => strtotime('+ 72hour'),
        ];
        $params['jti'] = compact('id', 'type');
        $key = 'example_key';
        $token = JWT::encode($params, $key,'HS256');
        return compact('token', 'params');
    }
    /**
     * 通过用户ID获取token
     * @param int $uid
     * @param string $type
     * @param array $params
     * @return array
     */
    public function getUidToken(int $uid, string $type, array $params = []): array
    {
        $host = app()->request->host();
        $time = time();
        $params += [
            'iss' => $host,
            'aud' => $host,
            'iat' => $time,
            'nbf' => $time,
            'exp' => strtotime('+ 72hour'),
        ];
        $params['jti'] = compact('uid', 'type');
        $key = 'example_key';
        $token = JWT::encode($params, $key,'HS256');

        return compact('token', 'params');
    }
    /**
     * @param string $jwt
     * @return array
     * @throws SignatureInvalidException    Provided JWT was invalid because the signature verification failed
     * @throws BeforeValidException         Provided JWT is trying to be used before it's eligible as defined by 'nbf'
     * @throws BeforeValidException         Provided JWT is trying to be used before it's been created as defined by 'iat'
     * @throws ExpiredException             Provided JWT has since expired, as defined by the 'exp' claim
     */
    public static function parseToken(string $jwt): array
    {
        JWT::$leeway = 60;
        $key = 'example_key';
        $data = JWT::decode($jwt, new Key($key, 'HS256'));
        //$data = JWT::decode($jwt, Config::get('app.app_key', 'default'), array('HS256'));
        $model = new self();
        return [$model->where($model->getPk(), $data->jti->id)->find(), $data->jti->type];
    }
}