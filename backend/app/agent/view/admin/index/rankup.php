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
    <title>上下分操作</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('rankup')}">
        <input type="hidden" name="agent_id" value="{$agent_id}">
        <div class="form-item">
            <label for="amount" class="form-label">操作金额</label>
            <div class="input-block">
                <input type="number" name="amount" value="" placeholder="请填写金额" id="amount" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="rate" class="form-label">操作类型</label>
            <div class="input-block">
                <div style="width: 180px">
                    <select name="type" id="type" class="layui-select">
                        <option value="1">上分</option>
                        <option value="0">下分</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-item">
            <label for="remark" class="form-label">操作说明</label>
            <div class="input-block">
                <textarea name="remark" id="remark" class="layui-textarea" placeholder="请填写操作说明"></textarea>
            </div>
        </div>
        <div class="footer-btn-box">
            <div>
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">提交执行</button>
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
                url:"{:url('rankup')}",
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