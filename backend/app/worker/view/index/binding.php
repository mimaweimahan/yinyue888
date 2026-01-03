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
    <title>绑定谷歌验证</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('binding')}">
        <input type="hidden" name="agent_id" value="{$agent_id}"/>
        <div class="form-item">
            <label for="nickname" class="form-label">谷歌验证扫码</label>
            <div class="input-block">
                <img src="{$qrCodeUrl}" alt=""/>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item">
                <label for="nickname" class="form-label">谷歌秘钥</label>
                <div class="input-block">
                    <input type="text" name="secret_key" value="{$secret_key}" readonly placeholder="请输入谷歌秘钥" class="layui-input">
                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item">
                <label for="nickname" class="form-label"></label>
                <div class="input-block">
                    <button type="submit" class="layui-btn" lay-submit lay-filter="binding">确定绑定</button>
                    <button type="button" class="layui-btn layui-btn-danger" lay-submit lay-filter="unbinding">解除绑定</button>
                </div>
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
            form.on('submit(binding)', function (data) {
                $.ajax({
                    url:"{:url('binding')}",
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
            //解除绑定
            form.on('submit(unbinding)', function (data) {
                layer.confirm('确定要解绑吗？', function(index){
                    $.ajax({
                        url:"{:url('unbinding')}",
                        async: false,
                        type:"POST",
                        data:data.field,
                        success: function(data){
                            layer.msg(data.msg);
                        }
                    });
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
