<?php /*a:1:{s:58:"/www/wwwroot/tisktshop.com/app/admin/view/config/index.php";i:1725870696;}*/ ?>
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
            <?php if(is_array($config_group_list) || $config_group_list instanceof \think\Collection || $config_group_list instanceof \think\Paginator): $i = 0; $__LIST__ = $config_group_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;if($id == $key || ($key == 1 && $id==0)): ?>
            <li class="layui-this"><a href="<?php echo url('index',['id'=>$key]); ?>"> <?php echo html_entities($group); ?>配置</a></li>
            <?php else: ?>
            <li><a href="<?php echo url('index',['id'=>$key]); ?>"> <?php echo html_entities($group); ?>配置</a></li>
            <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <!--#+++++++++++++++++++++++++++#-->
            <div style="height: 50px"></div>
            <form class="layui-form">
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?>
                <div class="layui-form-item">
                    <label class="layui-form-label"><?php echo html_entities($r['title']); ?></label>
                    <div class="layui-input-inline">
                        <?php switch($r['type']): case "1": ?> <input type="text"  name="config[<?php echo html_entities($r['name']); ?>]" value="<?php echo html_entities($r['value']); ?>" size="60" class="layui-input w-auto"/> <?php break; case "2": ?> <textarea name="config[<?php echo html_entities($r['name']); ?>]" cols="60" rows="8" class="layui-textarea w-auto"><?php echo html_entities($r['value']); ?></textarea> <?php break; case "3": ?> <textarea name="config[<?php echo html_entities($r['name']); ?>]" cols="30" rows="8" class="layui-textarea w-auto"><?php echo html_entities($r['value']); ?></textarea> <?php break; case "4": ?>
                        <select name="config[<?php echo html_entities($r['name']); ?>]" style="min-width: 100px;" class="layui-input w-auto">
                            <?php $_result=parse_config_attr($r['extra']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo html_entities($key); ?>" <?php if($r['value'] == $key): ?> selected <?php endif; ?>><?php echo html_entities($vo); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <?php break; case "6": ?>
                        <input type="text" name="config[<?php echo html_entities($r['name']); ?>]" id="<?php echo html_entities($r['name']); ?>" value="<?php echo html_entities($r['value']); ?>" class="layui-input w100" placeholder="点击右侧按钮上传">
                        <button type="button" class="layui-btn layui-bg-green upload-btn" data-id="<?php echo html_entities($r['name']); ?>"> + 点击上传 </button>
                        <?php break; default: ?> <input type="text"  name="config[<?php echo html_entities($r['name']); ?>]" value="<?php echo html_entities($r['value']); ?>" size="60" class="layui-input w-auto"/>
                        <?php endswitch; ?>
                        <div class="note-tips"> <span class="layui-badge st-red">调用：</span> <a href="javascript:void(0);">getConfig('<?php echo html_entities($r['name']); ?>')</a></div>
                        <p class="remark"><?php echo html_entities($r['remark']); ?></p>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" lay-submit lay-filter="submit_btn">立即提交</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="history.back();">返回</button>
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
    }).use(['element','layer', 'jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        $('.upload-btn').unbind('click').on('click',function(){
            var id = $(this).data('id');
            layer.open({
                type:2,
                title:'上传文件',
                area: ['600px', '600px'],
                maxmin:true,
                content:"<?php echo url('admin/file/api',['num'=>1,'type'=>'file']); ?>&val="+id,
                end:function () {}
            });
        });
        form.on('submit(submit_btn)', function(data){
            $.ajax({
                url:"<?php echo url('save'); ?>",
                async: false,
                type:"POST",
                data:data.field,
                dataType:'json',
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