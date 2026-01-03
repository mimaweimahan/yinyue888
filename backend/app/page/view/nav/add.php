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
    <title>{$rule['title']}</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        .color-picker-box{
            display: flex;
            align-items: center;
        }
        .color-picker-box #type-color{
            width: 26px;
            margin: 0;
        }
    </style>
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>导航管理</em></div>
        <ul class="panel-tab">
            <li><a href="{:url('index')}">列表</a></li>
            <li class="layui-this"><a href="javascript:void(0);">新增菜单</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <!--#+++++++++++++++++++++++++++#-->
        <form class="layui-form" method="post" action="{:url('add')}">
            <br />
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">菜单名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" id="name" class="layui-input" size="68" placeholder="请填写菜单名称">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="status" class="layui-form-label">启用状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" id="status" value="1" title="是" checked="checked" />
                    <input type="radio" name="status" value="0" title="否" />
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="image">菜单图标</label>
                <div class="layui-input-block">
                    <div><input type="text" name="image" id="image" placeholder="菜单图标" class="layui-input"></div>
                    <br/>
                    <button type="button" class="layui-btn layui-btn-danger upload-btn" data-id="image"><i class="layui-icon"></i>点击上传</button>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="color">选择颜色</label>
                <div class="layui-input-inline" style="width: 120px;">
                    <div class="color-picker-box">
                        <input type="text" name="color" placeholder="请选择颜色" class="layui-input" id="color">
                        <div id="type-color"></div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="url" class="layui-form-label">菜单地址</label>
                <div class="layui-input-inline">
                    <input type="text" name="url" id="url" class="layui-input" size="68" placeholder="请填写菜单地址">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="address" class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定提交</button>
                    <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.back()">返回</button>
                </div>
            </div>
        </form>
        <!--#+++++++++++++++++++++++++++#-->
    </div>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer','jquery','form','colorpicker'], function(){
        var $ = layui.jquery,
            layer  = layui.layer,
            colorpicker = layui.colorpicker,
            form   = layui.form;
        //表单赋值
        colorpicker.render({
            elem: '#type-color'
            ,color: '#ffffff'
            ,done: function(color){
                $('#color').val(color);
            }
        });

        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('add')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    window.location.reload();
                }
            });
            return false;
        });
        $('.upload-btn').unbind('click').on('click',function(){
            const id = $(this).data('id');
            parent.layer.open({
                type:2,
                title:'上传图片',
                area: ['1020px', '570px'],
                maxmin:true,
                content:"{:url('admin/file/api',['num'=>1])}&val="+id,
                end:function () {}
            });
        });

    });

</script>
</body>
</html>