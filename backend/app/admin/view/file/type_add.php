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
        .color-picker-box{
            display: flex;
            align-items: center;
        }
        .color-picker-box .type-color{
            width: 26px;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('type_add')}">
        <div class="form-item">
            <label for="pid" class="form-label">上级分类</label>
            <div class="input-block">
                <select name="pid" id="pid">
                    <option value="0">作为一级菜单</option>
                    {$type_list|raw}
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="name" class="form-label">分类名称</label>
            <div class="input-block">
                <textarea name="name" id="name" class="layui-textarea" cols="5" rows="5" placeholder="请填名称 一行一个！"></textarea>
            </div>
        </div>
        <div class="footer-btn-box">
            <div >
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定新增</button>
                <button type="button" class="layui-btn layui-btn-primary" id="bak-btn">返回</button>
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
            var $  = layui.jquery,
            layer  = layui.layer,
            form   = layui.form;
            //监听提交
            form.on('submit(submit_btn)', function (data) {
                $.ajax({
                    url:"{:url('type_add')}",
                    async: false,
                    type:"POST",
                    data:data.field,
                    success: function(data){
                        layer.msg(data.msg);
                        setTimeout(function (){ location.reload(); },3000);
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
