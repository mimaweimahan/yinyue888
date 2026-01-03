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
        .account-box ul li span{
            font-weight: bold;
            color: #0bba5f;
        }
    </style>
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
                    <li><input type="text" name="start_time" id="start_time" autocomplete="off" placeholder="开始时间" class="layui-input"></li>
                    <li><input type="text" name="end_time" id="end_time" autocomplete="off"  placeholder="结束时间" class="layui-input"></li>
                    <li><input type="text" name="keys" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
                    <li>
                        <select name="by_amount" id="by_amount">
                            <option value="0">默认</option>
                            <option value="1">按余额排序</option>
                        </select>
                    </li>
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
    <span class="layui-badge layui-bg-primary">停用</span>
    {{#  } }}
</script>

<script type="text/html" id="nickname_panel">
    <a href="{:url('view')}?id={{ d.id }}">{{ d.nickname }}</a>
</script>

<script type="text/html" id="type_panel">
    <span class="layui-badge layui-bg-green">{{ d.type_name }}</span>
</script>

<script type="text/html" id="grade_panel">
    <span class="layui-badge layui-bg-blue">{{ d.grade_name }}</span>
</script>
<script type="text/html" id="ip_panel">
    注册IP: {{d.reg_ip}}<br/>
    登陆IP: {{d.last_login_ip}}
</script>
<script type="text/html" id="account_panel">
    <div lay-event="account" class="account-box">
        <ul>
            <li>现金: <span>{{ d.amount }}</span></li>
            <!--<li>虚拟币: <span>{{ d.bi }}</span></li>-->
            <!--<li>积分: <span>{{ d.integral }}</span></li>-->
         </ul>
     </div>
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">注销</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="add"><span><i class="layui-icon layui-icon-add-circle"></i>新增</span></button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>注销</span></button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="show">
                <span><i class="layui-icon layui-icon-ok-circle"></i>启用</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="show_no">
                <span><i class="layui-icon layui-icon-close-fill"></i>停用</span>
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

        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-200;
        }
        laydate.render({
            elem: '#start_time'
        });
        laydate.render({
            elem: '#end_time'
        });
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height: table_h
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,limit:"{$limit}"
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:120, toolbar: '#set_panel'}
                ,{field: 'id', title: 'ID', width:90, sort: true}
                ,{field: 'nickname', title:'昵称', width:120, toolbar: '#nickname_panel'}
                ,{field: 'grade_name', title: '会员身份', align:'center', toolbar: '#grade_panel', width:110}
                ,{field: 'status', title: '用户状态', width:120, align:'center', toolbar: '#status_panel', sort: true}
                ,{title: '账户(点击充值)', width:180, toolbar: '#account_panel'}
                ,{field: 'mobile', title:'手机号', width:120}
                //,{field: 'type_name', title: '类型', align:'center', toolbar: '#type_panel', width:110}
                ,{field: 'ip', title:'IP', minWidth:220,toolbar: '#ip_panel'}
                ,{field: 'reg_time', title: '注册时间', width:180, sort: true}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id ,_event = obj.event;
            // 编辑
            if(_event === 'edit'){
                layer.open({
                    type:2,
                    title:'编辑',
                    maxmin:true,
                    area: ['350px', '560px'],
                    content:"{:url('edit')}?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要注销吗，注销后会删除用户的全部数据', function(index){
                    $.getJSON("{:url('delete')}",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }
            // 账户
            if(_event === 'account'){
                layer.open({
                    type:2,
                    title:'账户充值',
                    maxmin:true,
                    area: ['300px','450px'],
                    content:"{:url('account')}?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
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
                    area: ['350px', '560px'],
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
                    url:"{:url('status')}",
                    async: false,
                    type:"POST",
                    data:{'val':show,'field':'show','id':ids},
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
            data.field.search=1;
            table.reload('table_list',{
                where: data.field
            });
            return false;
        });
    });
</script>
</body>
</html>