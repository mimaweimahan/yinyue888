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
    <title>充值审批</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('approval')}">
        <input type="hidden" name="id" value="{$id}"/>
        <div class="form-item">
            <label for="status" class="form-label">审批结果</label>
            <div class="input-inline">
                <div style="width: 180px">
                    <select name="status" id="status" class="layui-select">
                        <option value="0" selected>请选择</option>
                        <option value="1" {if $status == 1} selected {/if}>审批通过并已给用户付款</option>
                        <option value="2" {if $status == 2} selected {/if}>拒绝提现申请</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-item">
            <label for="mark" class="form-label">审批说明</label>
            <div class="input-block">
                <textarea name="mark" id="mark" placeholder=" 填写审批说明 " class="layui-textarea">{$mark}</textarea>
            </div>
        </div>
        <div class="footer-btn-box" {if $status==1} style="display: none;" {/if}>
            <div>
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定执行</button>
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
                url:"{:url('approval')}",
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
