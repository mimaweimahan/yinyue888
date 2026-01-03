<?php /*a:1:{s:60:"/www/wwwroot/tisktshop.com/app/agent/view/sys/pai/import.php";i:1762764600;}*/ ?>
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
    <title>模版选择</title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
    <style>
        .body-main-p{padding: 0;}
        .panel-body{ position: relative}
        @media (max-width: 768px){
            .layui-table-tool-temp,.layui-btn-container{ margin-top: 0;!important;}
        }
    </style>
</head>
<body class="body-main-p">
<div class="panel-default">
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
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-normal layui-btn-sm" lay-event="choose"><span><i class="layui-icon layui-icon-cols"></i>选中并关闭</span></button>
        </div>
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
            ,limit:<?php echo html_entities($limit); ?>
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: []
            ,cols: [[ //表头
                {type:'radio'},
                {field: 'id', hide:'true', width: 80},
                {field: 'name', align: 'center',title: '产品名称', width: 120},
                {field: 'task_no', sort:true, title: '任务编号', width: 120},
                {field: 'start_balance', sort:true, title: '最小金额', width: 120},
                {field: 'end_balance', sort:true, title: '最大金额', width: 120},
                {field: 'task_rate', sort:true, title: '收益倍数', width: 120, align: 'center'},
            ]]
        });

        $('#all_list').on('click',function (e) {
            table.reload('table_list',{ where: [],page:1 });
        });

        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            let checkStatus = table.checkStatus(obj.config.id); //获取选中行状态
            let data = checkStatus.data;
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
            }
            const radio = data[0];
            // 确定选择
            if(obj.event === 'choose'){
                $.ajax({
                    url:"<?php echo url('import'); ?>",
                    async: false,
                    type: "POST",
                    data:{'uid':"<?php echo html_entities($uid); ?>",'tpl_id':radio.id},
                    dataType:'json',
                    success: function(data){
                        layer.msg(data.msg);
                        if(data.code === 1){
                            parent.layer.close();
                        }
                    }
                });
            }
            return false;
        });
    });
</script>
</body>
</html>