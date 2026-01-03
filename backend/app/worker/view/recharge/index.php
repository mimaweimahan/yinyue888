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
    <title>用户充值记录</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>用户充值记录</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <fieldset>
                <legend>条件搜索</legend>
                <form class="layui-form layui-form-pane searchForm" lay-filter="table-search"  autocomplete="off">
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">创建时间</label>
                        <label class="layui-input-inline" style="width: auto; display: flex;align-items: center;">
                            <input type="text" autocomplete="off" name="start_time" id="start_time" class="layui-input inline-block" placeholder="开始时间">
                            <span>-</span>
                            <input type="text" autocomplete="off" name="end_time" id="end_time"  class="layui-input inline-block" placeholder="结束时间">
                        </label>
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
                        <label class="layui-form-label">状态</label>
                        <label class="layui-input-inline">
                            <select name="status" id="status" class="layui-select">
                                <option value="">全部</option>
                                <option value="1">待处理</option>
                                <option value="2">已成功</option>
                                <option value="3">已取消</option>
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
<script type="text/html" id="table-bar">
    <button class="layui-btn layui-btn-xs tool-btn" lay-event="balance">查询</button>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="onRefresh">开启自动刷新</button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="offRefresh">关闭自动刷新</button>
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
                {field:'recharge_id',title:'序号', width:'80',align:'center',hide:"true"},
                {field:'created_at', width:'160',title:'创建时间',align:'center'},
                {title: "代理",  field: "agent_id",width: 120, templet: function (d) {
                        return '[' +d.agent_id + ']' + d.agent_name;
                }},
                {title: "业务员", field: "worker_id",width: 120, templet: function (d) {
                        return '[' +d.worker_id + ']' + d.worker_name;
                }},
                {title: "用户ID", align: "center", field: "uid",width: 80,templet: function (d) {
                        switch (d.user_type) {
                            case 1:
                                return '<span class="blue">'+ d.uid +'</span>';
                            case 0:
                                return d.uid;
                        }
                    }},
                {title: "国家", align: "center", field: "phonecode",width: 80},
                {title: "付款编号", align: "center", field: "trade_no",width: 180},
                {title: "地址",  field: "address",width: 380},
                {field:'balance',width:'100',title:'充值金额',align:'center'},
                {field:'symbol',width:'100',title:'币种',align:'center'},
                {field:'total_balance',width:'100',title:'总金额',align:'center'},
                {field:'status',width:'100',title:'订单状态',align:'center',templet: function(d){
                        switch (d.status) {
                            case 0:
                                return '未处理' ;
                            case 1:
                                return '<span class="blue">已完成</span>' ;
                            case -1:
                                return '<span class="red">已失败</span>' ;
                        }
                    }},
                {title: '-',width: 100, align: 'center', toolbar: '#table-bar'}
            ]]
        });
        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            if(obj.event ==='onRefresh'){
                var timerId = setInterval(function(){
                    table.reload('table_list');
                }, 5000)
                localStorage.setItem('refresh_id', timerId);
                layer.msg('已开启自动刷新');
                return false;
            }
            if(obj.event ==='offRefresh'){
                var refreshTimerId = localStorage.getItem('refresh_id');
                clearInterval(refreshTimerId);
                layer.msg('自动刷新已关闭');
                return false;
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