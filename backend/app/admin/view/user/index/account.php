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
    <title>用户账户</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
        .layui-form-item{}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('account')}">
        <input type="hidden" name="id"  value="{$id}" />

        <div class="layui-form-item" >
            <label for="amount" class="layui-form-label">用户余额</label>
            <div class="layui-input-block">
                <input type="text" name="amount" id="amount" value="" placeholder="余额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="integral" class="layui-form-label">积分</label>
            <div class="layui-input-block">
                <input type="text" name="integral" id="integral" value="" placeholder="积分" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" style="display: none">
            <label for="bi" class="layui-form-label">虚拟币金额</label>
            <div class="layui-input-block">
                <input type="text" name="bi" id="bi" value="" placeholder="虚拟币金额" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="note" class="layui-form-label">操作说明</label>
            <div class="layui-input-block">
                <textarea name="note" id="note" class="layui-textarea" placeholder="请填写操作说明">后台充值</textarea>
            </div>
        </div>
        <div class="footer-btn-box">
            <div>
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定充值</button>
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
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('account')}",
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
