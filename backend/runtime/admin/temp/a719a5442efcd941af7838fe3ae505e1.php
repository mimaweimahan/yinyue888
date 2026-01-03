<?php /*a:1:{s:57:"/www/wwwroot/tisktshop.com/app/admin/view/event/index.php";i:1766956735;}*/ ?>
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
    <title>事件管理</title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>事件管理</em>管理事件内容，供前端调用</div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
        </div>
    </div>
</div>
<script type="text/html" id="content_panel">
    <div style="max-width: 500px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ d.content }}">
        {{ d.content }}
    </div>
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="add"><span><i class="layui-icon layui-icon-add-circle"></i>添加事件</span></button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>批量删除</span></button>
        </div>
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    function is_mobile(){
        return window.screen.width <= 768;
    }
    
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;

        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height: 'full-180'
            ,limit:'<?php echo html_entities($limit); ?>'
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '事件列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                 {type: 'checkbox', fixed: 'left'}
                ,{field: 'id', title: 'ID', width:80, sort: true}
                ,{field: 'content', title:'事件内容', minWidth:500, toolbar: '#content_panel'}
                ,{title: '管理操作', width:150, toolbar: '#set_panel', fixed: 'right'}
            ]]
        });

        //监听头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            var _event = obj.event;
            
            if(_event === 'add'){
                layer.open({
                    type: 2,
                    title: '添加事件',
                    shade: 0.1,
                    maxmin: true,
                    area: ['800px', '600px'],
                    content: "<?php echo url('event/add'); ?>",
                    end:function(){
                        table.reload('table_list',{});
                    }
                });
            }
            
            if(_event === 'delete'){
                var data = checkStatus.data;
                if(data.length === 0){
                    layer.msg('请选择要删除的数据');
                    return;
                }
                layer.confirm('确定要删除选中的 ' + data.length + ' 条事件吗？', function(index){
                    var ids = [];
                    for(var i = 0; i < data.length; i++){
                        ids.push(data[i].id);
                    }
                    $.post("<?php echo url('event/del'); ?>", {ids: ids}, function(res){
                        layer.msg(res.msg);
                        if(res.code === 1){
                            layer.close(index);
                            table.reload('table_list',{});
                        }
                    }, 'json');
                });
            }
        });

        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var _event = obj.event;
            var data = obj.data;
            
            if(_event === 'edit'){
                layer.open({
                    type: 2,
                    title: '编辑事件',
                    shade: 0.1,
                    maxmin: true,
                    area: ['800px', '600px'],
                    content: "<?php echo url('event/edit'); ?>?id=" + data.id,
                    end:function(){
                        table.reload('table_list',{});
                    }
                });
            }
            
            if(_event === 'del'){
                layer.confirm('确定要删除这条事件吗？', function(index){
                    $.post("<?php echo url('event/del'); ?>", {id: data.id}, function(res){
                        layer.msg(res.msg);
                        if(res.code === 1){
                            layer.close(index);
                            table.reload('table_list',{});
                        }
                    }, 'json');
                });
            }
        });
    });
</script>
</body>
</html>

