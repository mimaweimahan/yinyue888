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
        <ul class="panel-tab">
            <li class="layui-this"><a>模板管理</a></li>
            <li><a href="{:url('add')}">新增模板</a></li>
            <li><a href="{:url('sms/index/index')}">发送记录</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <form class="layui-form">
                <ul class="search-box">
                    <li><input type="text" name="keys" value="" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
                    <li><button type="button" class="layui-btn" lay-submit lay-filter="search_btn">搜索</button></li>
                </ul>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="status_panel">
    {{#  if(d.status === 1){ }}
    <span class="layui-badge layui-bg-green">启用</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-black">停用</span>
    {{#  } }}
</script>
<script type="text/html" id="set_panel">
    <a href="{:url('edit')}?id={{d.id}}" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>删除</span></button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="status">
                <span><i class="layui-icon layui-icon-ok-circle"></i>开启</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="status_no">
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
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        //执行一个 table 实例
        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-300;
        }
        table.render({
            elem:'#table_list'
            ,height:table_h
            ,limit:{$limit}
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{field: 'template_id', title: '模板ID', width:200}
                ,{field: 'template_name', title: '模板名称', width:160}
                ,{field: 'status', title: '模板状态', width:120, toolbar: '#status_panel'}
                ,{field: 'content', title: '模板内容', minWidth:200}
                ,{title: '管理操作', width:160, toolbar: '#set_panel'}
            ]]
        });

        //监听行工具事件
        table.on('tool(table_list)', function(e){
            var id = e.data.id ,_event = e.event;
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗', function(index){
                    $.getJSON("{:url('delete')}",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            e.del();
                            layer.close(index);
                        }
                    });
                });
            }
        });
        //头工具栏事件
        table.on('toolbar(table_list)', function(e){
            var checkStatus = table.checkStatus(e.config.id);
            var data = checkStatus.data;
            var ids = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
            }
            if(e.event === 'status' || e.event === 'status_no'){
                var status = 0;
                switch(e.event){
                    case 'status':
                        status = 1;
                        break;
                    case 'status_no':
                        status = 0;
                        break;
                }
                if (!data.length ){
                    return layer.msg('请勾选需要操作的数据');
                }
                $.ajax({
                    url:"{:url('setField')}",
                    async: false,
                    type:"POST",
                    data:{'val':status,'field':'status','id':ids},
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
            if(e.event === 'delete'){
                if (!data.length ){
                    return layer.msg('请勾选需要操作的数据');
                }
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
        //搜索
        form.on('submit(search_btn)', function(data){
            table.reload('table_list',{
                where: data.field
            });
            return false;
        });
    });
</script>
</body>
</html>