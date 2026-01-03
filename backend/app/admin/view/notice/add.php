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
    <title>{if !empty($id)}编辑公告{else}添加公告{/if}</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{if !empty($id)}{:url('edit')}{else}{:url('add')}{/if}">
        {if !empty($id)}
        <input type="hidden" name="id" value="{$id}"/>
        {/if}
        <div class="form-item">
            <label for="title" class="form-label">公告标题 <span style="color:red">*</span></label>
            <div class="input-block">
                <input type="text" name="title" value="{$title|default=''}" id="title" placeholder="请输入公告标题" autocomplete="off" class="layui-input" lay-verify="required" />
            </div>
        </div>
        <div class="form-item">
            <label for="content" class="form-label">公告内容 <span style="color:red">*</span></label>
            <div class="input-block">
                <textarea name="content" id="content" placeholder="请输入公告内容" class="layui-textarea" lay-verify="required" style="min-height:150px">{$content|default=''}</textarea>
            </div>
        </div>
        <div class="form-item">
            <label for="status" class="form-label">显示状态</label>
            <div class="input-inline">
                <div style="width: 180px">
                    <select name="status" id="status" class="layui-select">
                        <option value="0" {if isset($status) && $status == 0} selected {/if}>隐藏</option>
                        <option value="1" {if isset($status) && $status == 1} selected {/if}>显示</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-item">
            <label for="show_home" class="form-label">首页展示</label>
            <div class="input-inline">
                <div style="width: 180px">
                    <select name="show_home" id="show_home" class="layui-select">
                        <option value="0" {if isset($show_home) && $show_home == 0} selected {/if}>否</option>
                        <option value="1" {if isset($show_home) && $show_home == 1} selected {/if}>是</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-item">
            <label for="sort" class="form-label">排序</label>
            <div class="input-inline">
                <div style="width: 180px">
                    <input type="number" name="sort" value="{$sort|default=0}" id="sort" placeholder="数字越小越靠前" autocomplete="off" class="layui-input" />
                </div>
            </div>
        </div>
        <div class="footer-btn-box">
            <div>
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定保存</button>
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
            var url = "{if !empty($id)}{:url('edit')}{else}{:url('add')}{/if}";
            $.ajax({
                url: url,
                async: false,
                type: "POST",
                data: data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { 
                            if(parent.layer){
                                parent.layer.closeAll();
                                parent.location.reload();
                            } else {
                                location.reload();
                            }
                        }, 1000);
                    }
                },
                error: function(){
                    layer.msg('操作失败，请稍候再试');
                }
            });
            return false;
        });
    });
</script>
</body>
</html>

