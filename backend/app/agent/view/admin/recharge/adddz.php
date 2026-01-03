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
    <form class="layui-form" method="post" action="{:url('adddz')}">
        <div class="form-item">
            <label for="agent_id" class="form-label">所属代理</label>
            <div class="input-block">
                <select name="agent_id" id="agent_id">
                    <option value="">请选择</option>
                    {volist name="agent_list" id="r"}
                    <option value="{$r.agent_id}">{$r.username}</option>
                    {/volist}
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="type_id" class="form-label">所属网络</label>
            <div class="input-block">
                <select name="type_id" id="type_id">
                    <option value="">请选择</option>
                    {volist name="type_list" id="r"}
                    <option value="{$r.id}">{$r.title}</option>
                    {/volist}
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="title" class="form-label">地址名称</label>
            <div class="input-block">
                <input type="text" name="name"  required lay-verify="required" placeholder="trc" autocomplete="off" class="layui-input" />
            </div>
        </div>

        <div class="form-item">
            <label for="address_icon" class="form-label">地址图片：</label>
            <div class="input-inline">
                <input type="text" name="icon" id="address_icon" class="layui-input w100" placeholder="点击按钮上传">
            </div>
            <div class="input-inline" style="width: 85px">
                <button type="button" class="layui-btn layui-bg-green upload-btn" data-id="address_icon"> + 点击上传 </button>
            </div>
        </div>
        <div class="form-item">
            <label for="address" class="form-label">钱包地址</label>
            <div class="input-block">
                <input type="text" name="address" value="" placeholder="请填写钱包地址" autocomplete="off" class="layui-input" />
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
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('adddz')}",
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
        $('.upload-btn').unbind('click').on('click',function(){
            var id = $(this).data('id');
            layer.open({
                type:2,
                title:'上传文件',
                area: ['820px', '510px'],
                maxmin:true,
                content:"{:url('admin/file/api',['num'=>1,'type'=>'file'])}&val="+id,
                end:function () {}
            });
        });
        $('#bak-btn').on('click',function () {
            layer.closeAll();
        });
    });
</script>
</body>
</html>
