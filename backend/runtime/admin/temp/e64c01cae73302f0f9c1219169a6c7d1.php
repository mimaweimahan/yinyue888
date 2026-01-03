<?php /*a:1:{s:57:"/www/wwwroot/tisktshop.com/app/admin/view/admin/index.php";i:1762839427;}*/ ?>
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

<script type="text/html" id="status_panel">
    {{#  if(d.status === 1){ }}
    <span class="layui-badge layui-bg-warm">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-primary">否</span>
    {{#  } }}
</script>

<script type="text/html" id="group_panel">
    <span class="layui-badge layui-bg-green">{{ d.title }}</span>
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="binding">谷歌验证</a>
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
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="show">
                <span><i class="layui-icon layui-icon-ok-circle"></i>启用</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="show_no">
                <span><i class="layui-icon layui-icon-close-fill"></i>关闭</span>
            </button>
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
        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-300;
        }
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height: table_h
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '数据列表'
            ,limit:"<?php echo html_entities($limit); ?>"
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:200, toolbar: '#set_panel'}
                ,{field: 'id', title: 'ID', width:80, sort: true}
                ,{field: 'phone', title:'手机号', width:150}
                ,{field: 'nickname', title:'昵称', width:120}
                ,{field: 'email', title: '邮箱', width:180}
                ,{field: 'is_bind', title: '绑定验证', width:110,templet: function (d) {
                        switch (d.is_bind) {
                            case 0:
                                return '<span class="layui-badge">待绑定</span>';
                            case 1:
                                return '<span class="layui-badge layui-bg-green">已绑定</span>';
                        }
                    }}
                ,{field: 'title', title: '角色', toolbar: '#group_panel'}
                ,{field: 'status', title: '开启状态', width:120, toolbar: '#status_panel', sort: true}
            ]]
        });

        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var data = obj.data, id = obj.data.id ,_event = obj.event;
            // 编辑
            if(_event === 'edit'){
                layer.open({
                    type:2,
                    title:'编辑',
                    maxmin:true,
                    area: ['350px', '400px'],
                    content:"<?php echo url('edit'); ?>?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
            // 谷歌验证
            if(_event === 'binding'){
                layer.open({
                    type:2,
                    title:'谷歌验证',
                    maxmin:true,
                    area: ['350px', '500px'],
                    content:"<?php echo url('binding'); ?>?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
            }
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗', function(index){
                    $.getJSON("<?php echo url('delete'); ?>",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }
        });
        //排序
        form.on('submit(sort_btn)', function(data){
            console.log(data.field);
            $.ajax({
                url:"<?php echo url('sort'); ?>",
                async: false,
                type:"POST",
                data:data.field,
                dataType:'json',
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                }
            });
            return false;
        });

        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            // 新增
            if(obj.event === 'add'){
                layer.open({
                    type:2,
                    title:'新增',
                    area: ['350px', '400px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"<?php echo url('add'); ?>",
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
                    url:"<?php echo url('status'); ?>",
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
    });
</script>
</body>
</html>