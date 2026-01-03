<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>微信付款</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <style>
        html,body{ margin: 0; padding: 0; font-family: 'Helvetica Neue',Helvetica,sans-serif;}
        input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
            color: #666;
            font-size: 14px;
        }

        input:-moz-placeholder, textarea:-moz-placeholder {
            color: #666;
            font-size: 14px;
        }

        input::-moz-placeholder, textarea::-moz-placeholder {
            color: #666;
            font-size: 14px;
        }

        input:-ms-input-placeholder, textarea:-ms-input-placeholder {
            color: #666;
            font-size: 14px;
        }
        .container{
            margin: 0 auto;
            text-align: center;
            padding: 0 10%;
        }
        @media (min-width: 700px){
            .container { width: 600px;  }
        }
        .container h1{ font-weight: 300;  display: block;  padding-top: 50px; }
        .container h2{
            font-weight: 300;
            display: block;
            font-size: 18px;
            padding: 35px 0;
            color: #666;
        }
        .amount-box{
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #eee;
            padding: 10px;
        }
        .amount-box label{
            padding: 0 10px;
            border-right: 1px solid #eee;
            font-weight: 300;
            font-size: 14px;
            width: 150px;
            color: #666;
        }
        .amount-box .input{
            margin: 0 10px;
            padding: 0 10px;
            width: 90%;
            font-size: 20px;
            font-weight: 300;
            border: 0;
        }
        .button-box{ padding: 20px 0; }
         button, input[type=button], input[type=reset], input[type=submit] {
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42;
            position: relative;
            display: inline-block;
            margin-bottom: 0;
            padding: 6px 12px;
            cursor: pointer;
            -webkit-transition-timing-function: linear;
            transition-timing-function: linear;
            -webkit-transition-duration: .2s;
            transition-duration: .2s;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #fff;
            background-clip: padding-box;
            outline: 0;
            -webkit-appearance: none;
            transition: all .3s;
            -webkit-transition: all .3s;
            box-sizing: border-box;
        }
        .button-box .cashier-btn{
            width: 100%;
            height: 50px;
            color: #fff;
            border: 1px solid #21AD38;
            background-color: #21AD38;
        }
    </style>
</head>
<body>
    <div class="container">
        <form name="payment" class="layui-form" action="{:url('payment')}" method="post">
            <input type="hidden" name="shop_id" id="shop_id" value="{$shop_id}" />
            <input type="hidden" name="store_id" id="store_id" value="{$store_id}" />
            <input type="hidden" name="uid" id="uid" value="{$member_id}" />
            <input type="hidden" name="openid" id="openid" value="{$openid}" />
            <input type="hidden" name="salesman_id" id="salesman_id" value="{$salesman_id}" />
            <h1>收银台</h1>
            <h2>{$shop['shop_name']}</h2>
            <div class="amount-box">
                <label for="amount">消费金额(¥)</label>
                <input type="text" name="amount" class="input" id="amount" placeholder="输入支付金额" />
            </div>
            {if $member_id==0}
            <div class="amount-box" style="margin-top: 10px">
                <label for="phone">会员手机号</label>
                <input type="text" name="phone" class="input" id="phone" placeholder="输入你的手机号" />
            </div>
            {/if}
            <div class="button-box">
                <button type="button" class="cashier-btn" id="cashier-btn" lay-submit lay-filter="pay_form">立即结算</button>
            </div>
        </form>
    </div>
    <script src="{__STATIC__}layui/layui.js" charset="utf-8"></script>
    <script src="//res2.wx.qq.com/open/js/jweixin-1.6.0.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.config({
            version:1.0,
            base: '/statics/layui/modules/'
        }).use(['layer','jquery','form'], function(){
            var form = layui.form ,layer = layui.layer ,$ = layui.jquery;
            form.on('submit(pay_form)', function(data){
                var btn  = $('#cashier-btn');
                if (!data.field.amount){
                    layer.msg('请填写支付金额');
                    return false;
                }
                $.ajax({
                    url:"{:url('payment')}",
                    type: 'post',
                    data: data.field,
                    dataType:"json",
                    beforeSend:function(){
                        var text = btn.text();
                        btn.text(text + '中...').prop('disabled', true).addClass('disabled');
                    },
                    success:function(r){
                        var text = btn.text();
                        //按钮文案、状态修改
                        btn.removeClass('disabled').text(text.replace('中...', ''));
                        layer.msg(r.msg);
                        btn.removeProp('disabled').removeClass('disabled');
                        if ( r.code === 1 ) {
                            return callpay(r.data);
                        }
                    },
                    error:function(e){
                        layer.msg(e.msg);
                    }
                });
                return false;
            });

            /**
             * 调用微信JS api 支付
             * @param data
             */
            function jsApiCall(data){
                var number = '';
                if(data.order_number){
                    number = data.order_number;
                }
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest',
                    {
                        'appId': data.appid ? data.appid : data.appId,
                        'timeStamp': data.timeStamp,
                        'nonceStr': data.nonceStr,
                        'package': data.package,
                        'signType': data.signType,
                        'paySign': data.paySign,
                    },
                    function(res){
                        WeixinJSBridge.log(res.err_msg);
                        if(res.err_msg === 'get_brand_wcpay_request:cancel') {
                            return layer.msg("您已取消了此次支付");
                        } else if(res.err_msg === 'get_brand_wcpay_request:fail') {
                            return layer.msg("支付失败");
                        } else if(res.err_msg === 'get_brand_wcpay_request:ok') {
                            window.location.href = "{:url('result')}?order_number="+number;
                        } else {
                            return layer.msg("未知错误"+res.error_msg);
                        }
                    }
                );
            }
            function callpay(e) {
                if (typeof WeixinJSBridge == "undefined"){
                    jsApiCall(e);
                }else{
                    jsApiCall(e);
                }
            }
        });
    </script>
</body>
</html>