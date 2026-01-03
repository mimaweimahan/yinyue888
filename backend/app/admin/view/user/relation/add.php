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
    <title>新增</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('add')}">
        <div class="layui-form-item">
            <label for="referee_time" class="layui-form-label">推荐时间</label>
            <div class="layui-input-block">
                <input type="text" name="referee_time" id="referee_time" readonly value="{:date('Y-m-d H:i:s')}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="nickname" class="layui-form-label">用户姓名</label>
            <div class="layui-input-block">
                <input type="text" name="nickname" id="nickname" placeholder="用户姓名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="account" class="layui-form-label">用户账号</label>
            <div class="layui-input-block">
                <input type="text" name="account" id="account" placeholder="手机号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="referee_phone" class="layui-form-label">推荐人账号</label>
            <div class="layui-input-block">
                <input type="text" name="referee_phone" id="referee_phone" placeholder="推荐人账号或手机号" class="layui-input">
            </div>
        </div>
        <div class="footer-btn-box">
            <div>
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定新增</button>
                <button type="button" class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll()">取消</button>
            </div>
        </div>
    </form>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer','jquery','form','laydate'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            laydate = layui.laydate,
            form  = layui.form;
        laydate.render({
            elem: '#referee_time',
            type: 'datetime'
        });
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('add')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                }
            });
            return false;
        });
        $('#bak-btn').on('click',function () {
            layer.closeAll();
        });
    });
</script>
</body>
</html>