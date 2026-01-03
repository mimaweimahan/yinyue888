<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>支付订单</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <style>
        html,body{ margin: 0; padding: 0; font-family: 'Helvetica Neue',Helvetica,sans-serif;}
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
            padding: 25px 0;
            color: #666;
        }
        .container h2 span{
            font-size: 38px;
            color: #333;
        }
        .container h3{
            padding: 10px 0 30px 0;
            font-size: 18px;
        }
        .label-box{
            text-align: left;
            border-top: 1px dashed #EEEEEE;
        }
        .container ul{
            margin: 0;
            list-style: none;
            padding-top: 10px;
        }
        .container ul li{
            margin: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container li div{
             color: #666;
        }

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
        .btn-box{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 10px;
        }
        .btn-box .fh{
            color: #fff;
            border: 1px solid #21AD38;
            background-color: #21AD38;
        }
        .btn-box .btn{
            width: 48%;
        }
    </style>
</head>
<body>
<section class="container">
    <h1>支付订单</h1>
    <h2>￥<span>{$order['amount']}</span></h2>
    <h3>
        {if $order.pay_status == 1}
        <span style="color: #0bba5f">支付成功</span>
        {else/}
        <span style="color: red">订单待支付</span>
        {/if}
    </h3>
    <ul class="label-box">
        <li class="item">
            <label>订单编号</label>
            <div>{$order['order_number']}</div>
        </li>
        <li class="item">
            <label>交易时间</label>
            <div>{$order['add_time']}</div>
        </li>
    </ul>
    <div class="btn-box">
        <button type="button" class="btn">返回</button>
        <button type="button" class="btn fh">刷新</button>
    </div>
</section>
</body>
</html>