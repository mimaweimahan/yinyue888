<?php /*a:1:{s:57:"/www/wwwroot/tisktshop.com/app/admin/view/module/shop.php";i:1744945988;}*/ ?>
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
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="icon_panel">
    <i class="iconfont">{{ d.icon+';' }}</i>
</script>
<script type="text/html" id="name_panel">
    <span>{{ d.module_name }}</span>
</script>

<script type="text/html" id="introduce_panel">
    <a>{{ d.introduce }}</a>
</script>

<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="install">安装</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="/statics/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            form  = layui.form;

        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-300;
        }
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,escape: false
            ,height: table_h
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                 {field: 'icon',title: '图标', width:60, toolbar: '#icon_panel'}
                ,{field: 'module_name', title:'应用名称', toolbar: '#name_panel', width:120}
                ,{field: 'introduce', title:'应用介绍', toolbar: '#introduce_panel', minWidth:220}
                ,{field: 'author', title:'开发者',  width:90}
                ,{field: 'version', title:'版本',  width:80}
                ,{field: 'install_time', title: '安装时间', width:150}
                ,{title: '管理操作', width:120, toolbar: '#set_panel'}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var _event = obj.event; var data = obj.data;
            console.log(data);
            if(_event === 'install'){
                layer.open({
                    type:2,
                    title:'安装模块',
                    maxmin:true,
                    area: ['320px', '280px'],
                    content:"<?php echo url('install'); ?>?module="+data.module,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
            if(_event === 'uninstall'){
                layer.open({
                    type:2,
                    title:'卸载模块',
                    maxmin:true,
                    area: ['320px', '280px'],
                    content:"<?php echo url('uninstall'); ?>?module="+data.module,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
        });
    });
</script>
</body>
</html>