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
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="statusTpl">
    {{#  if(d.status == 1){ }}
    <span class="layui-btn layui-btn-normal layui-btn-xs" lay-event="state">启用</span>
    {{#  } else if(d.status != 1) { }}
    <span class="layui-btn layui-btn-warm layui-btn-xs" lay-event="state">停用</span>
    {{#  } }}
</script>
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
    }).use(['element','table', 'jquery','form','okUtils','okLayer'], function(){
        var $ = layui.jquery,
            table = layui.table,
            okLayer = layui.okLayer,
            okUtils = layui.okUtils;
        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-300;
        }
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height: table_h
            ,escape: false
            ,limit:'{$limit}'
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {field: "title", title: "插件名称", width:160},
                {field: "version", title: "版本", width: 100},
                {field: "description", title: "简述", minWidth: 420},
                {field: "author", title: "作者", width: 120},
                //{field: "price", title: "价格", width: 80},
                //{field: "sales", title: "销量", width: 80},
                {field: "status", title: "状态", templet: "#statusTpl", width: 80},
                {field: "button", title: "操作按钮", width:180},
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(e){
            var id = e.data.id ,_event = e.event ,data=e.data;
            switch (e.event) {
                case "install":
                    install(data.name);
                    break;
                case "uninstall":
                    uninstall(data.name);
                    break;
                case "config":
                    config(data.name);
                    break;
                case "state":
                    state(data.name);
                    break;
            }
        });

        /**
         * 安装本地插件
         *
         */
        function install(id) {
            okLayer.confirm("确定要安装吗？", function () {
                okUtils.ajax("{:url('install')}", "get", {id: id}, true).done(function (e) {
                    if(e.code===1){
                        console.log(e);
                        okLayer.greenTickMsg(e.msg, function () {
                            table.reload('table_list',{});
                        })
                    }else{
                        okLayer.redCrossMsg(e.msg, function () { })
                    }
                }).fail(function (error) {
                    console.log(error)
                });
            })
        }

        /**
         * 配置
         * @param id
         */
        function config(id) {
            okLayer.open("配置", "config?name="+id, "400px", "450px", function (layero) { }, function () {
                table.reload('table_list',{});
            })
        }

        /**
         * 卸载
         * @param id
         */
        function uninstall(id) {
            okLayer.confirm("确定要卸载安装吗？", function () {
                okUtils.ajax("{:url('uninstall')}", "get", {id: id}, true).done(function (e) {
                    if(e.code===1){
                        console.log(e);
                        okLayer.greenTickMsg(e.msg, function () {
                            table.reload('table_list',{});
                        })
                    }else{
                        okLayer.greenTickMsg(e.msg, function () { })
                    }
                }).fail(function (error) {
                    console.log(error)
                });
            })
        }

        /**
         * 状态测试
         * @param id
         */
        function state(id) {
            okLayer.confirm("确定执行此操作吗？", function () {
                okUtils.ajax("{:url('state')}", "get", {id: id}, true).done(function (e) {
                    if(e.code===1){
                        console.log(e);
                        okLayer.greenTickMsg(e.msg, function () {
                            table.reload('table_list',{});
                        })
                    }else{
                        okLayer.greenTickMsg(e.msg, function () { })
                    }
                }).fail(function (error) {
                    console.log(error)
                });
            })
        }

    });
</script>
</body>
</html>