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
    <title>业务员管理</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        .account-box ul li span{
            font-weight: bold;
            color: #0bba5f;
        }
    </style>
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>业务员管理</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <form class="layui-form">
                <ul class="search-box">
                    <li><input type="text" name="keys" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
                    <li>
                        <button type="button" class="layui-btn" lay-submit lay-filter="search_btn">搜索</button>
                    </li>
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
    <span class="layui-badge layui-bg-primary">停用</span>
    {{#  } }}
</script>
<script type="text/html" id="is_account_panel">
    {{#  if(d.is_account === 1){ }}
    <span class="layui-badge layui-bg-green">开启</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-primary">关闭</span>
    {{#  } }}
</script>
<script type="text/html" id="bind_panel">
    {{#  if(d.is_bind === 1){ }}
    <span class="layui-badge layui-bg-green">已绑定</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-primary">未绑定</span>
    {{#  } }}
</script>
<script type="text/html" id="ip_panel">
    <a href="https://www.ip138.com/iplookup.php?ip={{d.last_login_ip}}" target="_blank">{{d.last_ip}}</a>
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="add"><span><i class="layui-icon layui-icon-add-circle"></i>新增</span></button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>删除</span></button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="open">
                <span><i class="layui-icon layui-icon-ok-circle"></i>启用</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="open_off">
                <span><i class="layui-icon layui-icon-close-fill"></i>停用</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="sf">
                <span><i class="layui-icon layui-icon-ok-circle"></i>开启上分</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="sf_off">
                <span><i class="layui-icon layui-icon-close-fill"></i>关闭上分</span>
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
    }).use(['element','layer', 'table', 'jquery','form','laydate'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            laydate = layui.laydate,
            form  = layui.form;

        laydate.render({
            elem: '#start_time'
        });
        laydate.render({
            elem: '#end_time'
        });
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,limit:"{$limit}"
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:120, toolbar: '#set_panel'}
                ,{field: 'worker_id', title: 'ID', width:90, sort: true}
                ,{field: 'worker_user', title:'用户名', minWidth:110}
                ,{field: 'nickname', title: '昵称', width:120}
                ,{field: 'status', title: '状态', width:120, align:'center', toolbar: '#status_panel', sort: true}
                ,{field: 'is_account', title: '上分', width:120, align:'center', toolbar: '#is_account_panel', sort: true}
                ,{field: 'is_bind', title:'谷歌', width:120, align:'center', toolbar: '#bind_panel', sort: true}
                ,{field: 'last_ip', title:'最后登录IP', width:160, hidden:true, toolbar: '#ip_panel'}
                ,{field: 'last_time', title: '最后登录时间', width:180, sort: true}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.worker_id ,_event = obj.event;
            // 编辑
            if(_event === 'edit'){
                layer.open({
                    type:2,
                    title:'编辑',
                    maxmin:true,
                    area: ['500px', '600px'],
                    content:"{:url('edit')}?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗，删除后会删除用户的全部数据', function(index){
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

        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            // 新增
            if(obj.event === 'add'){
                layer.open({
                    type:2,
                    title:'新增',
                    area: ['500px', '600px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('add')}",
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false;
            }
            var checkStatus = table.checkStatus(obj.config.id);
            var data = checkStatus.data;
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
            }
            var ids = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].worker_id);
            }

            if(obj.event === 'open' || obj.event === 'open_off'){
                let open = 1;
                if(obj.event === 'open_off'){
                    open = 0;
                }
                $.ajax({
                    url:"{:url('setField')}",
                    async: false,
                    type:"POST",
                    data:{'val':open,'field':'status','id':ids},
                    dataType:'json',
                    success: function(data){
                        layer.msg(data.msg);
                        if(data.code === 1){
                            table.reload('table_list',{});
                        }
                    }
                });
            }

             if(obj.event === 'sf' || obj.event === 'sf_off'){
                let sf = 1;
                if(obj.event === 'sf_off'){
                    sf = 0;
                }
                $.ajax({
                    url:"{:url('setField')}",
                    async: false,
                    type:"POST",
                    data:{'val':sf,'field':'is_account','id':ids},
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