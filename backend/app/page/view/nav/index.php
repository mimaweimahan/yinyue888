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
    <style>
        .color-icon{
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
        }
        .color-icon img{ width: 50%;  height: 50%;}
    </style>
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>{$rule['title']}</em>{$rule['note']}</div>
        <ul class="panel-tab">
            <li class="layui-this">{$rule['title']}</li>
            <li id="add_rule"><a href="{:url('add')}">新增</a></li>
        </ul>
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
<script type="text/html" id="sort_panel">
    <input type="text" name="sort[{{ d.id }}]" value="{{ d.sort }}" autocomplete="off" class="layui-input layui-input-25" width="100%" />
</script>

<script type="text/html" id="title_panel">
    <a href="{:url('edit')}?id={{ d.id }}"> {{ d.name }} </a>
</script>

<script type="text/html" id="status_panel">
    {{#  if(d.status === 1){ }}
    <span class="layui-badge layui-bg-green">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-danger">否</span>
    {{#  } }}
</script>

<script type="text/html" id="image_panel">
    {{#  if( d.image ){ }}
    <div class="color-icon" style="background:{{ d.color }}">
        <img src="{{ d.image }}" width="50px" />
    </div>
    {{#  } else { }}
    <div class="color-icon" style="background:{{ d.color }}">
        <div>{{ d.name }}</div>
    </div>
    {{#  } }}
</script>

<script type="text/html" id="set_panel">
    <a href="{:url('edit')}?id={{d.id}}" class="layui-btn layui-btn-xs layui-btn-primary">管理</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-mo layui-btn-sm" lay-submit lay-filter="sort_btn">
                <span><i class="layui-icon  layui-icon-cols"></i>排序</span>
            </button>
            <button type="button" class="layui-btn layui-btn-normal layui-btn-sm" lay-event="delete">
                <span><i class="layui-icon layui-icon-delete"></i>删除</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="show">
                <span><i class="layui-icon layui-icon-ok-circle"></i>启用</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="show_no">
                <span><i class="layui-icon layui-icon-close-fill"></i>关闭</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form','element','laytpl'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height:600
            ,limit:11
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:120, toolbar: '#set_panel'}
                ,{field: 'sort', title: '排序', width:100,toolbar: '#sort_panel', align:'center',sort: true}
                ,{field: 'name', title: '菜单名称', width:120,toolbar: '#title_panel', sort: true}
                ,{field: 'status', title: '状态', width:100, toolbar: '#status_panel', align:'center', sort: true}
                ,{field: 'image', title: '图标', width:110,toolbar: '#image_panel', align:'center'}
                ,{field: 'url', title: '图标', minWidth:180}
            ]]
        });

        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var data = obj.data, id = obj.data.id ,_event = obj.event;
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗', function(index){
                    $.getJSON("{:url('delete')}",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }
        });

        //排序
        form.on('submit(sort_btn)', function(data){
            console.log(data.field);
            $.ajax({
                url:"{:url('sort')}",
                async: false,
                type:"POST",
                data:data.field,
                dataType:'json',
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        location.reload();
                    }
                }
            });
            return false;
        });

        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            var data = checkStatus.data;
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
            }
            var show = 0;
            switch(obj.event){
                case 'show':
                    show = 1;
                    break;
                case 'show_no':
                    show = 0;
                    break;
            }
            var ids = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
            }
            if(obj.event === 'show' || obj.event === 'show_no'){
                $.ajax({
                    url:"{:url('setField',['field'=>'status'])}",
                    async: false,
                    type:"POST",
                    data:{'val':show,'id':ids},
                    dataType:'json',
                    success: function(data){
                        layer.msg(data.msg);
                        if(data.code === 1){
                            table.reload('table_list',{});
                        }
                    }
                });
            }
            // 删除
            if(obj.event === 'delete'){
                layer.confirm('确定要删除吗', function(){
                    $.ajax({
                        url:"{:url('delete')}",
                        async: false,
                        type: "POST",
                        data:{'id':ids},
                        dataType:'json',
                        success: function(data){
                            layer.msg(data.msg);
                            if(data.code === 1){
                                table.reload('table_list',{});
                            }
                        }
                    });
                });
            }
            return false;
        });
    });
</script>
</body>
</html>