<?php /*a:1:{s:54:"/www/wwwroot/tisktshop.com/app/sms/view/index/send.php";i:1661007166;}*/ ?>
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
    <title><?php echo html_entities($rule['title']); ?></title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em><?php echo html_entities($rule['title']); ?></em><?php echo html_entities($rule['note']); ?></div>
        <ul class="panel-tab">
            <li><a href="<?php echo url('index'); ?>">记录管理</a></li>
            <li class="layui-this"><a href="<?php echo url('send'); ?>">发送短信</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <!--#+++++++++++++++++++++++++++#-->
        <form class="layui-form" method="post" action="<?php echo url('send'); ?>">
            <br />
            <div class="layui-form-item">
                <label for="phone" class="layui-form-label">手机号：</label>
                <div class="layui-input-block">
                    <textarea name="phone" id="phone" cols="5" rows="5" class="layui-textarea" placeholder="多个电话号码用小写的,号隔开！"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="content" class="layui-form-label">短信内容：</label>
                <div class="layui-input-block">
                    <textarea name="content" id="content" cols="5" rows="5" class="layui-textarea" placeholder="短信内容尽量不超过71个字符"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="address" class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定发送</button>
                    <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.back()">返回</button>
                </div>
            </div>
        </form>
        <!--#+++++++++++++++++++++++++++#-->
    </div>
</div>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;

        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"<?php echo url('send'); ?>",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    location.href="<?php echo url('index'); ?>";
                }
            });
            return false;
        });
    });
</script>
</body>
</html>