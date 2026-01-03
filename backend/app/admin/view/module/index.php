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
    <title>{$rule['title']}</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>{$rule['title']}</em>{$rule['note']}</div>
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
    <i class="iconfont">
        {{#  if(d.icon){ }}
        {{ d.icon+';' }}
        {{#  } else { }}
        &#xe6c5;
        {{#  } }}
    </i>
</script>
<script type="text/html" id="name_panel">
    <span>{{ d.module_name }}</span>
</script>
<script type="text/html" id="disabled_panel">
    {{#  if(d.disabled === 0 || d.disabled === 1 ){ }}
    <input type="checkbox" name="disabled" id="{{d.id}}" data-id="{{d.id}}" value="{{d.disabled}}" title="启用" lay-filter="lock_disabled" {{ d.disabled == 0 ? 'checked' : '' }}>
    {{#  } else { }}
    <input type="checkbox" name="disabled" id="{{d.id}}" disabled  title="启用" >
    {{#  } }}
</script>
<script type="text/html" id="set_panel">
    {{#  if(d.id > 0){ }}
    <a class="layui-btn layui-btn-xs layui-btn-warm" lay-event="uninstall">卸载</a>
    {{#  } else { }}
    <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="install">安装</a>
    {{#  } }}
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a href="javascript:;" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-delete"></i> <b>缓存</b></span></a>
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="{__STATIC__}layui/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,table=layui.table,form=layui.form;
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,escape: false
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {field: 'icon',title: '图标', width:60, templet: '#icon_panel'}
                ,{field: 'module_name', title:'应用名称', toolbar: '#name_panel', width:120}
                ,{field: 'module', title:'应用目录',  width:100}
                ,{field: 'disabled', title:'启用状态', toolbar: '#disabled_panel', width:120,unresize: true}
                ,{field: 'introduce', title:'应用介绍', minWidth:220}
                ,{field: 'author', title:'开发者',  width:90}
                ,{field: 'version', title:'版本',  width:80}
                ,{field: 'install_time', title: '安装时间', width:120}
                ,{title: '管理操作', width:90, toolbar: '#set_panel'}
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
                    content:"{:url('install')}?module="+data.module,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
            if(_event === 'uninstall'){
                $.getJSON("{:url('uninstall')}",{'module':data.module}).done(function (data) {
                    layer.msg(data.msg);
                    if(data.code === 1){
                        table.reload('table_list',{});
                    }
                });
            }
        });

        form.on('checkbox(lock_disabled)', function(e){
            var val = parseInt(this.value);
            var id = e.elem.dataset.id;
            console.log(val);
            if(val === 0){ val = 1; }else{ val = 0; }
            $.getJSON("{:url('setField')}",{'id':id,'field':'disabled','val':val}).done(function (data) {
                layer.msg(data.msg);
                if(data.code === 1){
                    table.reload('table_list',{});
                }
            });
        });
    });
</script>
</body>
</html>