<?php /*a:1:{s:55:"/www/wwwroot/tisktshop.com/app/agent/view/index/log.php";i:1758032109;}*/ ?>
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
    <title>资金明细</title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>资金明细</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <fieldset>
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

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>

<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '数据列表'
            ,limit:"<?php echo html_entities($limit); ?>"
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,parseData: function(res){
                $("#all_total").text(res.attach.all_total);
                return {
                    "code": res.code, //解析接口状态
                    "count": res.count, //解析数据长度
                    "data": res.data //解析数据列表
                };
            }
            ,cols: [[
                { title: "序号",align: "center",field: "id",width: 80},
                { title: "代理ID",align: "center",field: "agent_id",width: 100},
                { title: "创建时间",align: "center",field: "created_at",width: 160},
                { title: "变动金额",align: "left",field: "balance",width: 160},
                { title: "当前余额",align: "left",field: "current_balance",width: 160},
                { title: "备注",align: "left",field: "remark",width: 300}
            ]]
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