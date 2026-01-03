<?php /*a:1:{s:57:"/www/wwwroot/tisktshop.com/app/admin/view/config/edit.php";i:1661007166;}*/ ?>
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
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>编辑配置</em></div>
    </div>
    <div class="panel-body">
        <form class="layui-form" method="post" action="<?php echo url('edit'); ?>">
            <input type="hidden" name="id" value="<?php echo html_entities($data['id']); ?>">
            <div class="form-item">
                <label for="name" class="form-label">配置标识</label>
                <div class="input-inline">
                    <input type="text" name="name" id="name" class="layui-input" size="60" value="<?php echo html_entities($data['name']); ?>" />
                    <p class="remark">用于getConfig函数调用，只能使用英文且不能重复</p>
                </div>
            </div>
            <div class="form-item">
                <label for="title" class="form-label">配置标题</label>
                <div class="input-inline">
                    <input type="text" name="title" id="title" class="layui-input" size="60" value="<?php echo html_entities($data['title']); ?>" />
                    <p class="remark">用于后台显示的配置标题</p>
                </div>
            </div>

            <div class="form-item">
                <label for="sort" class="form-label">排序</label>
                <div class="input-inline">
                    <input type="text" name="sort" id="sort" class="layui-input" value="<?php echo html_entities($data['sort']); ?>" />
                    <p class="remark">用于分组显示的顺序</p>
                </div>
            </div>

            <div class="form-item">
                <label for="type" class="form-label">配置类型</label>
                <div>
                    <select name="type" id="type" class="layui-input w-auto" style="min-width: 120px;">
                        <?php foreach($config_type_list as $key=>$val): if($data['type'] == $key): ?>
                        <option value="<?php echo html_entities($key); ?>" selected ><?php echo html_entities($val); ?></option>
                        <?php else: ?>
                        <option value="<?php echo html_entities($key); ?>" ><?php echo html_entities($val); ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <p class="remark">系统会根据不同类型解析配置值</p>
                </div>
            </div>

            <div class="form-item">
                <label for="group" class="form-label">配置分组</label>
                <div>
                    <select name="group" id="group" class="layui-input w-auto" style="min-width: 120px;">
                        <option value="0">不分组</option>
                        <?php foreach($config_group_list as $key=>$value): if($data['group'] == $key): ?>
                        <option value="<?php echo html_entities($key); ?>" selected><?php echo html_entities($value); ?></option>
                        <?php else: ?>
                        <option value="<?php echo html_entities($key); ?>" ><?php echo html_entities($value); ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <p class="remark">配置分组 用于批量设置 不分组则不会显示在系统设置中</p>
                </div>
            </div>

            <div class="form-item">
                <label for="value" class="form-label">配置值</label>
                <div class="input-inline">
                    <textarea name="value" id="value" rows="5" cols="60"  class="layui-textarea"><?php echo html_entities($data['value']); ?></textarea>
                    <p class="remark">配置值</p>
                </div>
            </div>

            <div class="form-item">
                <label for="extra" class="form-label">配置项</label>
                <div class="input-inline">
                    <textarea name="extra" id="extra" rows="5" cols="60" class="layui-textarea"><?php echo html_entities($data['extra']); ?></textarea>
                    <p class="remark">如果是枚举型 需要配置该项</p>
                </div>
            </div>

            <div class="form-item">
                <label for="remark" class="form-label">说明</label>
                <div class="input-inline">
                    <textarea name="remark" id="remark" rows="5" cols="60" class="layui-textarea"><?php echo html_entities($data['remark']); ?></textarea>
                    <p class="remark">配置详细说明</p>
                </div>
            </div>
            <div class="form-item">
                <label for="remark" class="form-label"></label>
                <div class="input-inline">
                    <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定更新</button>
                    <button type="button" class="layui-btn layui-btn-primary" onclick="history.back()" >返回</button>
                </div>
            </div>
        </form>
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
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"<?php echo url('edit'); ?>",
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
        $('#bak-btn').on('click',function () {
            layer.closeAll();
        });
    });
</script>
</body>
</html>
