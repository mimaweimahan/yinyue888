<?php /*a:1:{s:62:"/www/wwwroot/tisktshop.com/app/admin/view/app_download/add.php";i:1766949832;}*/ ?>
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
    <title><?php if(!empty($id)): ?>编辑APP下载链接<?php else: ?>添加APP下载链接<?php endif; ?></title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="<?php if(!empty($id)): ?><?php echo url('edit'); else: ?><?php echo url('add'); ?><?php endif; ?>">
        <?php if(!empty($id)): ?>
        <input type="hidden" name="id" value="<?php echo html_entities($id); ?>"/>
        <?php endif; ?>
        <div class="form-item">
            <label for="url" class="form-label">下载链接 <span style="color:red">*</span></label>
            <div class="input-block">
                <input type="text" name="url" value="<?php echo html_entities((isset($url) && ($url !== '')?$url:'')); ?>" id="url" placeholder="请输入完整的下载链接，如：https://example.com/app.apk" autocomplete="off" class="layui-input" lay-verify="required" />
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
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
            
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            var url = "<?php if(!empty($id)): ?><?php echo url('edit'); else: ?><?php echo url('add'); ?><?php endif; ?>";
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

