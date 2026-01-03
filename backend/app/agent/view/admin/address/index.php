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
            <fieldset>
                <legend>条件搜索</legend>
                <form class="layui-form layui-form-pane searchForm" lay-filter="table-search" autocomplete="off">
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">业务员ID</label>
                        <div class="layui-input-inline">
                            <select name="worker_id" id="worker_id">
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
                        <label class="layui-form-label">地址类型</label>
                        <label class="layui-input-inline">
                            <select name="address_type" id="address_type" class="layui-select">
                                <option value="">全部</option>
                                <option value="0">TRC</option>
                                <option value="1">ERC</option>
                                <option value="2">BSC</option>
                            </select>
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">地址</label>
                        <label class="layui-input-inline">
                            <input type="text" name="address" value="" autocomplete="off" class="layui-input">
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
<script type="text/html" id="table-bar">
    <a class="layui-btn layui-btn-xs" lay-event="balance">查询</a>
    <a class="layui-btn layui-btn-xs layui-btn-checked" lay-event="qrcode">收款</a>
    <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
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
            }
            ,cols: [[
                {type: 'checkbox'},
                {title: "序号", align: "center", field: "id", width: 80},
                {title: "业务员", align: "center", field: "worker_id",width: 80},
                {title: "用户ID", align: "center", field: "uid",width: 80,templet: function (d) {
                        switch (d.user_type) {
                            case 1:
                                return '<span class="color-blue">'+ d.uid +'</span>';
                            case 0:
                                return d.uid;
                        }
                    }},
                {title: "地址",  field: "address", minWidth: 390,templet: function (d) {
                        switch (d.address_type) {
                            case 1:
                                return '<span class="layui-badge layui-bg-cyan">ERC</span>&nbsp;' + d.address;
                            case 2:
                                return '<span class="layui-badge layui-bg-orange">BSC</span>&nbsp;'+ d.address;
                            case 0:
                                return '<span class="layui-badge layui-bg-green">TRC</span>&nbsp;'+ d.address;
                        }
                    }},
                {title: "余额",  field: "balance",sort: true,
                    width: 125,
                    templet: function (d) {
                        switch (d.address_type) {
                            case 2:
                                return '<span class="usdt">' + d.usdt_balance + '</span><hr class="mr5" />' + '<span class="bnb">' + d.balance + '</span>';
                            case 1:
                                return '<span class="usdt">' + d.usdt_balance + '</span><hr class="mr5" />' + '<span class="eth">' + d.balance + '</span>';
                            default:
                                return '<span class="usdt">' + d.usdt_balance + '</span><hr class="mr5" />' + '<span class="trx">' + d.balance + '</span>';
                        }
                    }},
                {field: 'updated_at',align: 'center', title: '创建/更新时间', width: 150,templet: function(d){
                        return '<div class="layui-font-12">'+d.created_at +'<hr class="mr5" /><span class="color-blue">'+ (d.updated_at ? d.updated_at : '-') +'</span><div>';
                    }},
                {align: 'center', title: '状态', width: 80,templet: function(d){
                        return d.is_collect === 1 ? '<span class="color-blue">待归集</span>' : '-' ;
                    }},
                {title: '-',width: 200, align: 'center', toolbar: '#table-bar'}
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
                    area: ['350px', '500px'],
                    content:"{:url('edit')}?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗，删除后不能恢复', function(index){
                    $.getJSON("{:url('delete')}",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }

            if(_event === 'balance'){
                let loading = layer.load(2, {shade: [0.1,'#000']});
                $.ajax({
                    url: "{:url('index')}",
                    data: {},
                    dataType: "json",
                    type: "post",
                    success: function (res) {
                        layer.close(loading);
                        if (res.code) {
                            return layui.popup.failure(res.msg);
                        }
                        return layui.popup.success("查询成功", table.reload('table_list',{}) );
                    }
                })
            }
            if(_event === 'qrcode'){
                layer.open({
                    type: 2,
                    title: "收款二维码",
                    shade: 0.1,
                    maxmin: true,
                    area: ["330px","330px"],
                    content:  "{:url('qrcode')}?id=" + id
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