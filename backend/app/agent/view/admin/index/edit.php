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
        <input type="hidden" name="id" value="{$agent_id}">
        <div class="form-item">
            <label for="nickname" class="form-label">代理昵称</label>
            <div class="input-inline">
                <input type="text" name="nickname" value="{$nickname}" id="nickname" placeholder="代理昵称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="username" class="form-label">登录账号</label>
            <div class="input-inline">
                <input type="text" name="username" value="{$username}" id="username" placeholder="登录账号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="rate" class="form-label">代理费率</label>
            <div class="input-inline">
                <input type="text" name="rate" value="{$rate}" id="rate"  class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="rate" class="form-label">提现自动打款</label>
            <div class="input-inline">
                <div style="width: 180px">
                    <select name="is_auto_paid" id="is_auto_paid" class="layui-select">
                        <option value="0" {if $is_auto_paid == 0} selected {/if} >禁止</option>
                        <option value="1" {if $is_auto_paid == 1} selected {/if}>开启</option>
                    </select>
                </div>
                <div class="form-tips"> * 普通用户提现自动打款</div>
            </div>
        </div>
        <div class="form-item">
            <label for="max_paid_amount" class="form-label">自动打款限额</label>
            <div class="input-inline">
                <input type="text" name="max_paid_amount" value="{$max_paid_amount}" id="max_paid_amount" placeholder=" 填写0为不限制 " autocomplete="off" class="layui-input" />
                <div class="form-tips"> * 提现自动打款最大值</div>
            </div>
        </div>
        <div class="form-item">
            <label for="telegram" class="form-label">Telegram</label>
            <div class="input-inline">
                <input type="text" name="telegram" value="{$telegram}" id="telegram" placeholder="Telegram客服账号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="password" class="form-label">登录密码</label>
            <div class="input-inline">
                <input type="text" name="password" value="{$password}" id="password" placeholder=" 不填写就不更改密码 " autocomplete="off" class="layui-input">
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
