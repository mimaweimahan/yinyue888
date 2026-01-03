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
    <title>重粉检测</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>重粉检测</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <fieldset>
                <legend>号码添加</legend>
                <form class="layui-form layui-form-pane searchForm" lay-filter="table-submit" method="post" action="{:url('add')}"  autocomplete="off">
                    <div class="form-item" style="width: 360px;">
                        <label class="form-label">手机号</label>
                        <label class="input-inline">
                            <input type="text" id="phone" name="phone" lay-verify="required" style="width: 150px;" value="" autocomplete="off" class="layui-input">
                        </label>

                        <input type="hidden" name="created_at" value="{:time()}" />

                        <button class="layui-btn" lay-submit lay-filter="submit_btn">添加 </button>

                    </div>
                    <div class="layui-form-item ">
                        <input type="radio" name="comefrom" value="其他" title="其他" checked >
                        <input type="radio" name="comefrom" value="TikTok" title="TikTok" >
                        <input type="radio" name="comefrom" value="X" title="X" >
                        <input type="radio" name="comefrom" value="Facebook" title="Facebook" >
                        <input type="radio" name="comefrom" value="Instagram" title="Instagram" >
                        <input type="radio" name="comefrom" value="Telegram" title="telegram" >
                        <input type="radio" name="comefrom" value="Whatsapp" title="whatsapp" >
                        <input type="radio" name="comefrom" value="Line" title="Line" >
                    </div>
                </form>
            </fieldset>
            <!-- 顶部查询表单 -->
            <fieldset>
                <legend>条件搜索</legend>
                <form class="layui-form layui-form-pane searchForm" lay-filter="table-search" autocomplete="off">
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">创建时间</label>
                        <label class="layui-input-inline" id="start_time" style="width: auto; display: flex;align-items: center;">
                            <input type="text" autocomplete="off" name="start_time[]" id="start_time" class="layui-input inline-block" placeholder="开始时间">
                            <span>-</span>
                            <input type="text" autocomplete="off" name="end_time[]" id="end_time"  class="layui-input inline-block" placeholder="结束时间">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">业务员</label>
                        <label class="layui-input-inline">
                            <input type="text" name="worker_id" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">手机号</label>
                        <label class="layui-input-inline">
                            <input type="text" name="mobile" value=""  autocomplete="off" class="layui-input">
                        </label>
                    </div>

                    <div class="layui-form-item layui-inline input-line">
                        <button class="layui-btn layui-btn-md " lay-submit lay-filter="search_btn">
                            <i class="layui-icon layui-icon-search"></i> 搜索
                        </button>
                        <button type="reset" class="layui-btn layui-btn-md" lay-submit lay-filter="table-reset">
                            <i class="layui-icon layui-icon-refresh"></i>重置
                        </button>
                    </div>
                </form>
                <blockquote class="layui-elem-quote">
                    <div id="reprot_total">
                        <span class="layui-btn layui-btn-primary layui-btn-sm">总数量:<b class="color-red" id="all_total">0</b></span>
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
    <a class="layui-btn layui-btn-xs" lay-event="del">删除</a>
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
            table   = layui.table,
            layer   = layui.layer,
            laydate = layui.laydate,
            form    = layui.form;

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
            //,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            //,defaultToolbar: ['filter', 'exports', 'print']
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
                {title: "序号", align: "center", width:100, field: "id",},
                {title: "代理", align: "center",width:100, field: "agent_id",},
                {title: "业务员", align: "center",width:100, field: "worker_id",},
                {title: "手机号", align: "center",width:200, field: "phone",},
                {title: "来源", align: "center",width:100, field: "comefrom"},
                {title: "添加时间", align: "center",width:170, field: "created_at",},
                {title: "操作", toolbar: "#table-bar", width:120,align: "center"}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id ,_event = obj.event;
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
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('add')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { location.reload(); },3000);
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
    });
</script>
</body>
</html>