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
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('edit')}">
        <input type="hidden" name="id" value="{$id}">
        <div class="form-item" style="display: none">
            <label for="type_id" class="form-label">所属类型</label>
            <div class="input-block">
                <select name="type_id" id="type_id">
                    <option value="0">点击选择</option>
                    {volist name="type_list" id="r"}
                    <option value="{$r['id']}" {if $type_id ==$r.id } selected {/if} >{$r['name']}</option>
                    {/volist}
                </select>
            </div>
        </div>

        <div class="form-item">
            <label for="grade_id" class="form-label">所属等级</label>
            <div class="input-block">
                <select name="grade_id" id="grade_id">
                    <option value="0">点击选择</option>
                    {volist name="grade_list" id="r"}
                    <option value="{$r['id']}" {if $grade_id == $r.id } selected {/if} >
                    {$r['grade_name']}
                    </option>
                    {/volist}
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="nickname" class="form-label">用户名称</label>
            <div class="input-block">
                <input type="text" name="nickname" value="{$nickname}" id="nickname" placeholder="用户名称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="account" class="form-label">登录账号</label>
            <div class="input-block">
                <input type="text" name="account" value="{$account}" id="account" placeholder="登录账号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="mobile" class="form-label">登录手机号</label>
            <div class="input-block">
                <input type="text" name="mobile" value="{$mobile}" id="mobile" placeholder="手机号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="password" class="form-label">登录密码</label>
            <div class="input-block">
                <input type="text" name="password" id="password" placeholder=" 不填写就不更改密码 " autocomplete="off" class="layui-input">
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
                    if(data.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                }
            });
            return false;
        });

    });
</script>
</body>
</html>