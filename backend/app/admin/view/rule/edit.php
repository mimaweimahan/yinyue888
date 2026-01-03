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
    <title>编辑</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body style="background: #FFFFFF">
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('edit')}">
        <input type="hidden" name="id" value="{$id}">
        <div class="layui-form-item">
            <label for="title" class="layui-form-label">上级菜单</label>
            <div class="layui-input-block">
                <select name="pid" id="pid" lay-verify="pid">
                    <option value="0">作为一级菜单</option>
                    {$list|raw}
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="title" class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
                <input type="text" name="title" value="{$title}" id="title" placeholder="菜单名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">认证类型</label>
            <div class="layui-input-block">
                <select name="type" class="am-input-sm" title="选择认证类型">
                    <option value="">选择认证类型</option>
                    <option value="1" {eq name="$type" value="1"} selected {/eq}>菜单+认证</option>
                    <option value="2" {eq name="$type" value="2"} selected {/eq}>主菜单+认证</option>
                    <option value="0" {eq name="$type" value="0"} selected {/eq}>只为菜单</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="name" class="layui-form-label">权限规则</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="{$name}" id="name" placeholder="权限规则" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="condition" class="layui-form-label">附加规则</label>
            <div class="layui-input-block">
                <input type="text" name="condition" value="{$condition}" id="condition" placeholder=" 填写附加规则" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否显示</label>
            <div class="layui-input-block">
                <input type="radio" name="show" value="1" title="开启" {eq name="$show" value="1"} checked="checked" {/eq} />
                <input type="radio" name="show" value="0" title="关闭" {eq name="$show" value="0"} checked="checked" {/eq} />
            </div>
        </div>
        <div class="layui-form-item">
            <label for="note" class="layui-form-label">备注说明</label>
            <div class="layui-input-block">
                <input type="text" name="note" value="{$note}" id="note" placeholder="备注说明" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="footer-btn-box">
            <div >
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定提交</button>
                <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.back()">返回</button>
            </div>
        </div>
    </form>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.config({
            version:1.0,
            base: '{__STATIC__}layui/modules/'
        }).use(['element','layer', 'jquery','form'], function(){
            var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
            //监听提交
            form.on('submit(submit_btn)', function (data) {
                $.ajax({
                    url:"{:url('edit')}",
                    async: false,
                    type:"POST",
                    data:data.field,
                    success: function(data){
                        layer.msg(data.msg);
                        location.reload();
                    }
                });
                return false;
            });

        });
    </script>
</body>
</html>
