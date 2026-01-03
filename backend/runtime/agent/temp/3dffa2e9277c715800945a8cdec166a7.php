<?php /*a:1:{s:62:"/www/wwwroot/tisktshop.com/app/agent/view/admin/task/index.php";i:1762764657;}*/ ?>
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
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form" method="post" action="<?php echo url('index'); ?>">
                <div class="layui-form" >
                    <div class="layui-form-item">
                        <label class="layui-form-label">任务数量</label>
                        <div class="layui-input-inline">
                            <input type="text" name="task_num" lay-verify="number" value="<?php echo html_entities($task_num); ?>" lay-verType="tips" class="layui-input">
                        </div>
                    </div>
                    <hr/>
                    <div class="layui-form-item">
                        <label class="layui-form-label">任务收益</label>
                        <div class="layui-input-inline">
                            <input type="text" name="task_rate" value="<?php echo html_entities($task_rate); ?>" lay-verify="number"  lay-verType="tips" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">* 1 = 1% </div>
                    </div>
                    <hr/>
                    <div class="layui-form-item">
                        <label class="layui-form-label">注册开启抢单</label>
                        <div class="layui-input-inline">
                            <input type="text" name="is_task" lay-verify="number" value="<?php echo html_entities($is_task); ?>" lay-verType="tips" class="layui-input">
                        </div>
                    </div>
                    <hr/>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="setmyinfo">确认修改</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>

<script src="/statics/layui/layui.all.js" charset="utf-8"></script>

<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        //搜索
        form.on('submit(setmyinfo)', function(data){
            $.ajax({
                url:"<?php echo url('index'); ?>",
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