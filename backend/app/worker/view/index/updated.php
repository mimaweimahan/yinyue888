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
    <title>更新资料</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>更新资料</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form" method="post" action="{:url('updated')}">
                <div class="form-item">
                    <label for="idd" class="form-label">ID</label>
                    <div class="input-inline">
                        <input type="text"  value="{$worker_id}" id="idd" disabled class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="worker_user" class="form-label">登录账号</label>
                    <div class="input-inline">
                        <input type="text" value="{$worker_user}" id="worker_user" disabled class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="nickname" class="form-label">用户名称</label>
                    <div class="input-inline">
                        <input type="text" name="nickname" value="{$nickname}" id="nickname" placeholder="用户名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="telegram" class="form-label">Telegram(客服号)</label>
                    <div class="input-inline">
                        <input type="text" name="telegram" value="{$telegram}" id="telegram" placeholder="Telegram客服号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="form-item">
                    <label for="cpassword" class="form-label">当前密码</label>
                    <div class="input-inline">
                        <input type="text" name="cpassword" id="cpassword" placeholder=" 请填写当前登陆密码 " autocomplete="off" class="layui-input" />
                        <div class="form-tips"> * 不修改请留空</div>
                    </div>
                </div>
                <div class="form-item">
                    <label for="npassword" class="form-label">新密码</label>
                    <div class="input-inline">
                        <input type="text" name="npassword" id="npassword" placeholder=" 不修改请留空 " autocomplete="off" class="layui-input" />
                        <div class="form-tips"> * 不修改请留空</div>
                    </div>
                </div>
                <div class="form-item">
                    <label for="npassword2" class="form-label">确认新密码</label>
                    <div class="input-inline">
                        <input type="text" name="npassword2" id="npassword2" placeholder=" 不修改请留空 " autocomplete="off" class="layui-input" />
                        <div class="form-tips"> * 不修改请留空</div>
                    </div>
                </div>
                <div class="form-item">
                    <label for="npassword2" class="form-label"></label>
                    <div class="input-inline">
                        <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">保存以上设置</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.back()">返回</button>
                    </div>
                </div>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
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
                url:"{:url('updated')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        location.reload();
                    }
                }
            });
            return false;
        });

    });
</script>
</body>
</html>