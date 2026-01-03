<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>设置提现地址</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>更新资料</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <form class="layui-form" method="post" action="{:url('address')}">
                <div class="layui-form-item ">
                    <label class="layui-form-label">提现地址</label>
                    <label class="layui-input-inline" style="width: 60%">
                        <input type="text" name="address"  lay-verify="required" value="{$withdrawal_address}" placeholder="请输入提现地址" class="layui-input" >
                    </label>
                </div>
                <div class="layui-form-item layui-inline">
                    <label class="layui-form-label">谷歌验证码</label>
                    <label class="layui-input-inline">
                        <input type="text" name="google_auth" lay-verify="required" placeholder="请输入谷歌验证码" class="layui-input">
                    </label>
                </div>
                <div class="layui-form-item layui-inline">
                    <button class="layui-btn" lay-submit lay-filter="submit_btn">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('address')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(res){
                    layer.msg(res.msg);
                    if(res.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>
