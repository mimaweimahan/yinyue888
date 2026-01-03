<?php
/**
 * @Description : IP信息
 * @Author : 120499187@qq.com
 */
namespace app\common\service;
use think\facade\Cache;
class IpInfoService
{
    /**
     * 获取IP信息
     * @param string $ip IP地址
     * @return array
     */
    public static function info($ip)
    {
        $info = Cache::get($ip);
        if (empty($info)) {
            $url = 'http://ip.taobao.com/outGetIpInfo?ip=' . $ip . '&accessKey=alibaba-inc';
            $res = http_get($url);
            $res = json_decode($res,true);
            $info = [
                'ip'       => $ip,
                'country'  => '',
                'province' => '',
                'city'     => '',
                'area'     => '',
                'region'   => '',
                'isp'      => '',
            ];
            if (isset($res['code'])&&$res['code'] == 0 && $res['data']) {
                $info['ip']       = $ip;
                $info['country']  = $res['data']['country'];
                $info['province'] = $res['data']['region'];
                $info['city']     = $res['data']['city'];
                $info['region']   = $res['data']['country'].$res['data']['region'].$res['data']['city'].$res['data']['area'];
                $info['area']     = $res['data']['area'];
                $info['isp']      = $res['data']['isp'];
                Cache::set($ip, $info);
            }
        }
        return $info;
    }
}
