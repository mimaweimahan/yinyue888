<?php
namespace app\pay\model;
use core\payment\AliPay\Scan;
use think\Model;

class Pay extends Model{
    // 表名
    protected $name = 'member';
    private static $notify_url = 'http://www.hudouban.cn/alipay_notify';
    private static $cfg = [
        'debug'=>false,
        'sign_type'=>'RSA2',
        'appid'=>'2019102768654437',
        'public_key'=>'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAg+wJU6U2foRO85a5QlOOaMq6sVJuHJ756+1ihlQ9Y7In698IOWMVWo8njk6A187qJepbYs/Pq7aQBhXajry4+/8os20Jz7mp9omQsIVjnq/pS08A+hSwOjy6qw0aCysJgG6tTsy/wAoPnv8vB1+kUABSyaqNOtC+h0XtNVn8b4BTUuH3PLInitcqlrOaijM5TPvQKZN1fj0a4tIsTD08afpkHv98dl5Z0Cvu9R+LrsOUmLsaUAQNCzh9f284xRk86i3Onr2EkkckDzXFn7Qk/w5rVa0yHmAPq2n5ax6eNNinBXEGN6K6UlS1k5omgPf/u577B7lHxxTTox2W09qE8QIDAQAB',
        'private_key'=>'MIIEowIBAAKCAQEAg+wJU6U2foRO85a5QlOOaMq6sVJuHJ756+1ihlQ9Y7In698IOWMVWo8njk6A187qJepbYs/Pq7aQBhXajry4+/8os20Jz7mp9omQsIVjnq/pS08A+hSwOjy6qw0aCysJgG6tTsy/wAoPnv8vB1+kUABSyaqNOtC+h0XtNVn8b4BTUuH3PLInitcqlrOaijM5TPvQKZN1fj0a4tIsTD08afpkHv98dl5Z0Cvu9R+LrsOUmLsaUAQNCzh9f284xRk86i3Onr2EkkckDzXFn7Qk/w5rVa0yHmAPq2n5ax6eNNinBXEGN6K6UlS1k5omgPf/u577B7lHxxTTox2W09qE8QIDAQABAoIBAD0jlkr6xZ+q6ABCeUeA+/4a/p0Rq9B96SvrT38b6Xub5J6PNfuKrSnUMKvmPBZIYgICdCn+T6uwJ116oVkHo9++KHnHbgWkcV298Z2tpDa2JjPtwHEmR2omHQkLQGeuoW+xW4aqo693ujeg4oXTUI53J+cosN1yQurkgIP6WWC++LPaRir0xYDQ7MBfp99jFlkVj/Z8HrkrCRWR5EDnpxYxPglYk9vFRAKRA5tiHEUALXtQzEKMfDTQuYNCjM0cUOm66pUUBAo1gBMwrxaN4dTskJaasRAOoB+oEkQbl9r+u+mAK1GrRiGUT0kNyV3d7iegaLxNd0jj8XgcLOQ1qMUCgYEAw4r5c1mj0xwzHhUg6EPLrMdYFn/k2FG9Czb7Sdi8vprGICGCINCD8VW+Oq0TCZuSAR4Yev2nMeRiO8Es4I5ZMoiIqhhQD7cFHhKlsZ7BgWTAB7iBRd7KQTKr2JJY4KSuPjO+Kc/wyCXW7WTCbPJhPTdE1cLFqHUMlPs9gN3J47MCgYEArLWIxE3nsqzW/p0Hn5jV/6vYzKKTfTosYWxHrUCAamh/6OgM/KwShvUOHV132TVRKYUM8YoJDZxfnSrtgsW9RHH7JRTZFFkKdcbiK3VUTkPz1kY8vZcRTvILaQTSNwwRkkKhyUg1opnoKwnKS2yYF2M/njAFmpjysKBCSWOOMssCgYBNGU6hnIZrhoLhKZOAALsdtLuWo3anlBLliRgrVbmVrZDQumWEarKbRSNsHzGSaDR5HFSqqbhyg4n35YK8R2QD+LFp34wxpgfug4uxLNc/HWpZoPXXhrBYZJI9IfbJHCVXgS9JbSOSxtinYUMHkcmlSVVqsxEcCoqbczQcy1X+4QKBgCqzGyRFipJPTzxWAIuB0u7KQuidDU/5sP1JMxNvjhBA09b2gDd8J3x8W8gA0t+94dodDg0trn1R+wW1llEtqFSixY/ubpksRnzF9ib+dCCBhmikpuHM1reo+g815O89KZ76oFtOYgxYduElI4GwUI3/uLvYbZpCVEY86QaR+ZcvAoGBAJcjRBHZyx9G4+5wQJDGEzLiMj8JKsVJzMlZDz4PS+iocdJDPvXL1MPgwhzA2BwNkZFntJwvs8TdZvORZRTVSPr1Tjb3Rpx1FD1hKB2ciG6HXu2ZIgPhCwCcjSKMYq1+vRbHu6SUOr+wOdcIQAREQfM00R5OIFfcmx/i37tV9cX5',
        'notify_url'=>'https://api.road-well.cn/api/alipay/notify',
        'service_pid'=>'2088631619797023'
    ];

    /**
     *  支付宝扫码支付
     */
    public static function alipay($unionid,$type_id){
        try {
            // 实例支付对象
            $pay = Scan::instance(self::$cfg);
            // 参数链接：https://docs.open.alipay.com/api_1/alipay.trade.precreate
            $order_number = orderNumber();
            $_body = '月会员充值';
            $_total_amount = 2;
            if($type_id == 4){
                $_body = '年会员充值';
                $_total_amount = 20;//20
            }

            $result = $pay->apply([
                'out_trade_no' => $order_number, // 订单号
                'total_amount' => $_total_amount, // 订单金额，单位：元
                'subject' => $_body
            ]);

            if( isset($result['qr_code']) && $result['qr_code'] ){
                // 保存订单数据到数据库
                Db::name('order')->insert([
                    'order_number'=>$order_number,
                    'type_id'=>$type_id,
                    'unionid'=>$unionid,
                    'total_amount'=>$_total_amount,
                    'pay_amount'=>$_total_amount,
                    'goods_name'=>$_body,
                    'channel'=>'',
                    'payment_type'=>'jsapi',
                    'add_time'=>time(),
                    'update_time'=>time()
                ]);
                return $result['qr_code'];
            }
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
