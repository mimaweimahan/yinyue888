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
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>{$rule['title']}</em>{$rule['note']}</div>
        <ul class="panel-tab">
            <li><a href="{:url('index')}">模板管理</a></li>
            <li class="layui-this"><a>模板编辑</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <!--#+++++++++++++++++++++++++++#-->
        <form class="layui-form" method="post" action="{:url('edit')}">
            <input type="hidden" name="id" value="{$id}"/>
            <br />
            <div class="layui-form-item">
                <label for="template_id" class="layui-form-label">模板编号</label>
                <div class="layui-input-inline">
                    <input type="text" name="template_id" id="template_id" value="{$template_id}" class="layui-input" size="68" placeholder="请填写模板编号"/>
                </div>
            </div>

            <div class="layui-form-item">
                <label for="template_name" class="layui-form-label">模板名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="template_name" id="template_name" value="{$template_name}" class="layui-input" size="68" placeholder="请填写模板名称">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="status" class="layui-form-label">开通状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" id="status" value="1" title="是" {if $status == 1} checked="checked" {/if} />
                    <input type="radio" name="status" value="0" title="否" {if $status == 0} checked="checked" {/if} />
                </div>
            </div>

            <div class="layui-form-item">
                <label for="content" class="layui-form-label">模板内容</label>
                <div class="layui-input-block">
                    <textarea type="text" name="content" id="content" class="layui-textarea" placeholder="模板内容">{$content}</textarea>
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
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;

        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('edit')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>