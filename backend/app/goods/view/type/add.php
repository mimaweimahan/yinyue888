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
    <form class="layui-form" method="post" action="{:url('add')}">
        <div class="layui-form-item">
            <label for="pid" class="layui-form-label">上级分类</label>
            <div class="layui-input-block">
                <select name="pid" id="pid" >
                    <option value="0">作为一级菜单</option>
                    {$lists|raw}
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="name" class="layui-form-label">分类名称</label>
            <div class="layui-input-block">
                <textarea name="name" id="name" class="layui-textarea" cols="5" rows="5" placeholder="请填名称 一行一个！"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" for="image_pic">分类图片</label>
            <div class="layui-input-block">
                <div><input type="text" name="image" id="image_pic" placeholder="分类图片" class="layui-input"></div>
                <br/>
                <button type="button" class="layui-btn layui-btn-danger" id="upload-btn"><i class="layui-icon"></i>点击上传</button>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label" for="color">选择颜色</label>type-color
            <div class="layui-input-inline" style="width: 120px;">
                <div class="color-picker-box">
                    <input type="text" name="color" placeholder="请选择颜色" class="layui-input" id="color">
                    <div id="type-color"></div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否显示</label>
            <div class="layui-input-block">
                <input type="radio" name="show" value="1" title="开启" />
                <input type="radio" name="show" value="0" title="关闭" checked="checked"/>
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
        }).use(['element','layer','jquery','form','upload','colorpicker'], function(){
            var $  = layui.jquery,
            layer  = layui.layer,
            colorpicker = layui.colorpicker,
            upload = layui.upload,
            form   = layui.form;
            //表单赋值
            colorpicker.render({
                elem: '#type-color'
                ,color: '#1c97f5'
                ,done: function(color){
                    $('#color').val(color);
                }
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
                        setTimeout(function (){ location.reload(); },3000);
                    }
                });
                return false;
            });
            //设定文件大小限制
            upload.render({
                elem: '#upload-btn'
                ,url: "{:url('tool/upload/file',['app'=>'goods'])}" //改成您自己的上传接口
                //,size: 60 //限制文件大小，单位 KB
                ,done: function(res){
                    if(res.code === 1){
                        layer.msg('上传成功');
                        $('#image_pic').val(res.data.url);

                        var tpl = thumb_tpl.innerHTML;
                        laytpl(tpl).render(data, function(html){
                            $('.thumb-upload-box ul').append(html);
                        });
                        // 绑定删除
                        $('.thumb-upload-box a').on('click',function(){
                            $(this).parent().parent().remove();
                        });
                    }else{
                        layer.msg(res.data.msg);
                    }
                }
            });
            $('#bak-btn').on('click',function () {
                layer.closeAll();
            });
        });
    </script>
</body>
</html>
