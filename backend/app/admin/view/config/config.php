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
            {if $id == 0 }
            <li class="layui-this"><a href="{:url('config')}"> 全部</a></li>
            {else/}
            <li><a href="{:url('config')}"> 全部</a></li>
            {/if}
            {volist name="config_group_list" id="group"}
            {if $id == $key }
            <li class="layui-this"><a href="{:url('config',['id'=>$key])}"> {$group}配置</a></li>
            {else/}
            <li><a href="{:url('config',['id'=>$key])}"> {$group}配置</a></li>
            {/if}
            {/volist}
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
    <a href="{:url('index')}?pid={{ d.id }}"> {{#  if(d.icon){ }} <i class="iconfont">&{{ d.icon }}</i> {{#  } }} {{ d.title }} </a>
</script>
<script type="text/html" id="type_panel">
    <span class="layui-badge layui-bg-warm">{{ d.type }}</span>
</script>
<script type="text/html" id="group_panel">
    <span class="layui-badge layui-bg-green">{{ d.group }}</span>
</script>
<script type="text/html" id="set_panel">
    <a href="{:url('edit')}?id={{ d.id }}" type="main" class="layui-btn layui-btn-xs layui-btn-primary">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <a href="{:url('add',['id'=>$id])}" target="main" class="layui-btn layui-btn-sm"><span><i class="layui-icon layui-icon-add-circle"></i>新增</span></a>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-submit lay-filter="sort_btn"><span><i class="layui-icon layui-icon-cols"></i>排序</span></button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>删除</span></button>
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
    }).use(['element','layer', 'table', 'jquery','form','laytpl'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        var w_height = $(window).height();
        var table_h = 550;
        if(w_height>800){
            table_h = parseInt(w_height-300);
        }
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height: table_h
            ,limit: table_h>800?30:"{$limit}"
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{field: 'sort', title: '排序', width:100,toolbar: '#sort_panel',sort: true}
                ,{field: 'id', title: 'ID', width:60, sort: true}
                ,{field: 'title', title: '名称'}
                ,{field: 'name', title:'标题', width:200}
                ,{field: 'group', title: '分组', width:80, toolbar: '#group_panel', sort: true}
                ,{field: 'type', title: '类型', width:80, toolbar: '#type_panel', sort: true}
                ,{title: '管理操作', width:160, toolbar: '#set_panel', sort: true}
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
                        setTimeout(function () { location.reload(); },3000);
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
            var ids = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
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

        $("#add_rule").on('click',function () {
            layer.open({
                type:2,
                title:'新增',
                area: ['350px', '500px'],
                maxmin:true,
                shadeClose: true, //开启遮罩关闭
                content:"{:url('add',['id'=>$id])}",
                end:function () {
                    //location.reload();
                    table.reload('table_list',{});
                }
            });
        });
    });
</script>
</body>
</html>