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
        <input type="hidden" name="id" value="{$worker_id}">
        <div class="form-item">
            <label for="worker_user" class="form-label">登陆账户</label>
            <div class="input-inline">
                <input type="text" name="worker_user" value="{$worker_user}" id="worker_user" placeholder="登陆账户" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="worker_pass" class="form-label">登陆密码</label>
            <div class="input-inline">
                <input type="text" name="worker_pass" value="{$worker_pass}"  id="worker_pass" placeholder="登录密码最少6位" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="nickname" class="form-label">用户昵称</label>
            <div class="input-inline">
                <input type="text" name="nickname" value="{$nickname}" id="nickname" placeholder="用户昵称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="telegram" class="form-label">Telegram</label>
            <div class="input-inline">
                <input type="text" name="telegram" value="{$telegram}"  id="telegram" placeholder="Telegram" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="status" class="form-label">状态 </label>
            <div class="input-inline">
                <input type="radio" name="status" value="1" title="正常" {if($status==1)} checked ='checked' {/if} />
                <input type="radio" name="status" value="0" title="禁用" {if($status==0)} checked ='checked' {/if} />
            </div>
        </div>
        <div class="form-item">
            <label for="is_bind" class="form-label">绑定谷歌 </label>
            <div class="input-inline">
                <input type="radio" name="is_bind" value="1" title="已绑定" {if($is_bind==1)} checked ='checked' {/if} />
                <input type="radio" name="is_bind" value="0" title="未绑定" {if($is_bind==0)} checked ='checked' {/if} />
            </div>
        </div>
        <div class="form-item">
            <label for="is_account" class="form-label">上分权限 </label>
            <div class="input-inline">
                <input type="radio" name="is_account" value="1" title="允许" {if($is_account==1)} checked ='checked' {/if} />
                <input type="radio" name="is_account" value="0" title="禁止" {if($is_account==0)} checked ='checked' {/if} />
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
