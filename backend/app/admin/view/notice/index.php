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
    <title>公告管理</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>公告管理</em>统一公告系统，可发布到首页展示</div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <form class="layui-form">
                <ul class="search-box">
                    <li><input type="text" name="keys" value="{$keys}" placeholder="请输入公告标题关键词" autocomplete="off" class="layui-input"></li>
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
    {{#  if(d.status == 1){ }}
    <span class="layui-badge layui-bg-green">显示</span>
    {{#  } else { }}
    <span class="layui-badge">隐藏</span>
    {{#  } }}
</script>
<script type="text/html" id="show_home_panel">
    {{#  if(d.show_home == 1){ }}
    <span class="layui-badge layui-bg-blue">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-gray">否</span>
    {{#  } }}
</script>
<script type="text/html" id="title_panel">
    <a href="javascript:;" lay-event="view">{{ d.title }}</a>
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="add"><span><i class="layui-icon layui-icon-add-circle"></i>添加公告</span></button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>批量删除</span></button>
        </div>
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    function is_mobile(){
        return window.screen.width <= 768;
    }
    
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;

        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height: 'full-180'
            ,limit:'{$limit}'
            ,url: '{$url}' //数据接口
            ,title: '公告列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                 {type: 'checkbox', fixed: 'left'}
                ,{field: 'id', title: 'ID', width:80, sort: true}
                ,{field: 'title', title: '公告标题', minWidth:200, toolbar: '#title_panel'}
                ,{field: 'content', title:'公告内容', minWidth:300, templet: function(d){
                    var content = d.content || '';
                    if(content.length > 50){
                        return content.substring(0, 50) + '...';
                    }
                    return content;
                }}
                ,{field: 'status', title:'状态', width:80, toolbar: '#status_panel'}
                ,{field: 'show_home', title:'首页展示', width:100, toolbar: '#show_home_panel'}
                ,{field: 'sort', title: '排序', width:80, sort: true}
                ,{title: '管理操作', width:150, toolbar: '#set_panel', fixed: 'right'}
            ]]
        });

        //监听搜索
        form.on('submit(search_btn)', function(data){
            var keys = data.field.keys;
            table.reload('table_list', {
                where: {keys: keys},
                page: {curr: 1}
            });
            return false;
        });

        //监听头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            var _event = obj.event;
            console.log('toolbar event:', _event); // 调试用
            
            if(_event === 'add'){
                console.log('打开添加公告窗口'); // 调试用
                layer.open({
                    type: 2,
                    title: '添加公告',
                    shade: 0.1,
                    maxmin: true,
                    area: ['800px', '600px'],
                    content: "{:url('notice/add')}",
                    end:function(){
                        table.reload('table_list',{});
                    },
                    error: function(layero, index){
                        console.error('打开窗口失败');
                        layer.msg('打开添加页面失败，请检查路径是否正确');
                    }
                });
            }
            
            if(_event === 'delete'){
                var data = checkStatus.data;
                if(data.length === 0){
                    layer.msg('请选择要删除的数据');
                    return;
                }
                layer.confirm('确定要删除选中的 ' + data.length + ' 条公告吗？', function(index){
                    var ids = [];
                    for(var i = 0; i < data.length; i++){
                        ids.push(data[i].id);
                    }
                    $.post("{:url('notice/del')}", {ids: ids}, function(res){
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
            
            if(_event === 'view'){
                layer.msg('公告内容：' + (data.content || ''));
            }
            
            if(_event === 'edit'){
                layer.open({
                    type: 2,
                    title: '编辑公告',
                    shade: 0.1,
                    maxmin: true,
                    area: ['800px', '600px'],
                    content: "{:url('notice/edit')}?id=" + data.id,
                    end:function(){
                        table.reload('table_list',{});
                    }
                });
            }
            
            if(_event === 'del'){
                layer.confirm('确定要删除这条公告吗？', function(index){
                    $.post("{:url('notice/del')}", {id: data.id}, function(res){
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

