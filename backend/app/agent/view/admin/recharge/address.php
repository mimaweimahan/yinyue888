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
            <form class="layui-form">
                <ul class="search-box">
                    <li>
                        <select name="agent_id" id="agent_id">
                            <option value="0">选择代理</option>
                            {volist name="agent_list" id="r"}
                            <option value="{$r['agent_id']}">{$r['nickname']}</option>
                            {/volist}
                        </select>
                    </li>
                    <li><input type="text" name="keys" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
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
<script type="text/html" id="sort_panel">
    <input type="text" name="sort[{{ d.id }}]" value="{{ d.sort }}" autocomplete="off" class="layui-input layui-input-25" width="100%" />
</script>

<script type="text/html" id="status_panel">
    {{#  if(d.status === 1){ }}
    <span class="layui-badge layui-bg-green">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-danger">否</span>
    {{#  } }}
</script>

<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>
<script type="text/javascript" id="icon_panel">
    <img src="{{ d.icon }}" width="20" height="20" />
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a class="layui-btn layui-btn-sm" lay-event="add_btn"><span><i class="layui-icon layui-icon-add-circle"></i>新增</span></a>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-mo layui-btn-sm" lay-submit lay-filter="sort_btn">
                <span><i class="layui-icon layui-icon-cols"></i>排序</span>
            </button>
            <button type="button" class="layui-btn layui-btn-normal layui-btn-sm" lay-event="delete">
                <span><i class="layui-icon layui-icon-delete"></i>删除</span>
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

        table.render({
            elem:'#table_list'
            ,limit: '{$limit}'
            ,url: "{:url('address')}" //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,method:'post'
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:150, align: 'center', toolbar: '#set_panel'}
                ,{field: 'sort', title: '排序', width:100,toolbar: '#sort_panel',sort: true}
                ,{field: 'icon', title: '图标', width:80,toolbar: '#icon_panel'}
                ,{field: 'title', title: '网络类型', width:180}
                ,{field: 'name', title: '类型名称', width:120}
                ,{field: 'address', title: '地址', minWidth:180, sort: true}
            ]]
        });

        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var data = obj.data, id = obj.data.id ,_event = obj.event;
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗', function(index){
                    $.getJSON("{:url('deldz')}",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }

            // 编辑
            if(_event === 'edit'){
                layer.open({
                    type:2,
                    title:'编辑',
                    area: ['90vw', '600px'],
                    maxmin:true,
                    content:"{:url('editdz')}?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
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
        //搜索
        form.on('submit(search_btn)', function(data){
            table.reload('table_list',{
                where: data.field
            });
            return false;
        });
        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);

            // 新增
            if(obj.event === 'add_btn'){
                layer.open({
                    type:2,
                    title:'新增',
                    area: ['90vw', '600px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('adddz')}",
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false;
            }

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
                        url:"{:url('deldz')}",
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