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
    <title>订单管理</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>订单管理</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <fieldset>
                <legend>条件搜索</legend>
                <form class="layui-form layui-form-pane searchForm" lay-filter="table-search"  autocomplete="off">
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">业务员ID</label>
                        <div class="layui-input-inline">
                            <select name="worker_id" id="worker_id" class="layui-select">
                                <option value="">请选择</option>
                                {volist name="salesman_list" id="r"}
                                <option value="{$r.worker_id}">{$r.worker_user}</option>
                                {/volist}
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">用户ID</label>
                        <label class="layui-input-inline">
                            <input type="text" name="uid" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">用户性质</label>
                        <label class="layui-input-inline">
                            <select name="user_type" id="user_type" class="layui-select">
                                <option value="">全部</option>
                                <option value="1">普通用户</option>
                                <option value="2">虚拟号</option>
                            </select>
                        </label>
                    </div>

                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">状态</label>
                        <label class="layui-input-inline">
                            <select name="status" id="status" class="layui-select">
                                <option value="">全部</option>
                                <option value="1">待完成</option>
                                <option value="2">已完成</option>
                            </select>
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">是否派单</label>
                        <label class="layui-input-inline">
                            <select name="is_pai" id="is_pai" class="layui-select">
                                <option value="">全部</option>
                                <option value="1">否</option>
                                <option value="2">是</option>
                            </select>
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <button class="layui-btn layui-btn-md " lay-submit lay-filter="search_btn">
                            <i class="layui-icon layui-icon-search"></i> 搜索
                        </button>
                        <button type="reset" class="layui-btn layui-btn-md layui-btn-primary" lay-submit lay-filter="table-reset">
                            <i class="layui-icon layui-icon-refresh"></i>重置
                        </button>
                    </div>
                </form>
                <blockquote class="layui-elem-quote">
                    <div id="reprot_total">
                        <span class="layui-btn layui-btn-primary layui-btn-sm">总数量:<b class="color-red" id="all_total">0</b></span>
                        <span class="layui-btn layui-btn-primary layui-btn-sm">总金额:<b class="color-red" id="all_balance">0</b></span>
                    </div>
                </blockquote>
            </fieldset>
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
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
            ,parseData: function(res){
                $("#all_total").text(res.attach.all_total);
                $("#all_balance").text(res.attach.all_balance);
                return {
                    "code": res.code, //解析接口状态
                    "count": res.count, //解析数据长度
                    "data": res.data //解析数据列表
                };
            },
            cols: [[
                {title: "序号", align: "center", field: "id",width: 80},
                {field:'created_at', width:'160',title:'创建时间',align:'center'},
                {title: "业务员", align: "center", field: "worker_id",width: 100},
                {title: "用户ID", align: "center", field: "uid",width: 100,templet: function (d) {
                        switch (d.user_type) {
                            case 1:
                                return '<span class="color-blue">'+ d.uid +'</span>';
                            case 0:
                                return d.uid;
                        }
                    }},
                {title: "交易号", align: "left", field: "trade_no",width: 120},
                {title: "产品名称", align: "left", field: "goods_name",width: 110},
                {title: "单价", align: "center", field: "price",width: 110},
                {title: "数量", align: "center", field: "num",width: 100},
                {title: "总价", align: "center", field: "total_price",width: 110},
                {title: "利润", align: "center", field: "profit",width: 110},
                {title: "IP", align: "center", field: "Ip",width: 120},
                {title: "完成时间", align: "center", field: "endTime",width: 160},
                {title: "状态", align: "center", field: "status",width: 100,templet: function(d){
                        switch (d.status) {
                            case 0:
                                return '-' ;
                            case 1:
                                return '<span class="color-blue">已完成</span>' ;
                        }
                    }},
                {title: "是否派单", align: "center", field: "is_pai",width: 100,templet: function(d){
                        switch (d.is_pai) {
                            case 0:
                                return '-' ;
                            case 1:
                                return '<span class="color-red">派单</span>' ;
                        }
                    }},

            ]],
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id ,_event = obj.event;
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