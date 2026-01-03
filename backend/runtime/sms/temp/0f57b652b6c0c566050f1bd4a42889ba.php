<?php /*a:1:{s:55:"/www/wwwroot/tisktshop.com/app/sms/view/index/index.php";i:1661007166;}*/ ?>
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
    <title><?php echo html_entities($rule['title']); ?></title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em><?php echo html_entities($rule['title']); ?></em><?php echo html_entities($rule['note']); ?></div>
        <ul class="panel-tab">
            <li class="layui-this"><a href="<?php echo url('index'); ?>">记录管理</a></li>
            <li><a href="<?php echo url('send'); ?>">发送短信</a></li>
            <li><a href="<?php echo url('sms/template/index'); ?>">短信模版</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <div style="height:35px; color:#666;">
                短信余额:<?php echo html_entities($balance); ?>条, 已使用:<?php echo html_entities($transactional_balance); ?>条
            </div>
            <form class="layui-form">
                <ul class="search-box">
                    <li>
                        <div class="layui-form-item">
                            <label for="start_time" class="layui-form-label">时间筛选：</label>
                            <div class="layui-input-inline">
                                <input type="text" name="start_time" id="start_time" autocomplete="off" placeholder="开始时间" class="layui-input">
                            </div>
                            <div class="layui-input-inline">
                                <input type="text" name="end_time" id="end_time" autocomplete="off"  placeholder="结束时间" class="layui-input">
                            </div>
                        </div>
                    </li>
                    <li><input type="text" name="keys" value="" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
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
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="reply">重发</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
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
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form','laydate'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            laydate = layui.laydate,
            form  = layui.form;
        //执行一个 table 实例
        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-300;
        }
        laydate.render({
            elem: '#start_time'
        });
        laydate.render({
            elem: '#end_time'
        });
        table.render({
            elem:'#table_list'
            ,height:table_h
            ,limit:<?php echo html_entities($limit); ?>
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{field: 'phone', title: '手机号', width:160}
                ,{field: 'content', title: '短信内容', minWidth:200}
                ,{field: 'status', title: '发送状态', width:150}
                ,{field: 'result', title: '返回提示', width:160}
                ,{field: 'create_time', title: '发送时间', width:200}
                ,{title: '管理操作', width:160, toolbar: '#set_panel'}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(e){
            var id = e.data.id ,_event = e.event;
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗', function(index){
                    $.getJSON("<?php echo url('delete'); ?>",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            e.del();
                            layer.close(index);
                        }
                    });
                });
            }
        });
        //头工具栏事件
        table.on('toolbar(table_list)', function(e){
            var checkStatus = table.checkStatus(e.config.id);
            var data = checkStatus.data;
            var ids = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
            }
            // 删除
            if(e.event === 'delete'){
                if (!data.length ){
                    return layer.msg('请勾选需要操作的数据');
                }
                layer.confirm('确定要删除吗', function(){
                    $.ajax({
                        url:"<?php echo url('delete'); ?>",
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