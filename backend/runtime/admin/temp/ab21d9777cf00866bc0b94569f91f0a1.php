<?php /*a:1:{s:56:"/www/wwwroot/tisktshop.com/app/admin/view/file/index.php";i:1729043023;}*/ ?>
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
            <form class="layui-form">
                <ul class="search-box">
                    <li><input type="text" name="keys" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
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
<script type="text/html" id="size_panel">
    {{ d.size }} {{ d.unit }}
</script>
<script type="text/html" id="ext_panel">
    .{{ d.ext }}
</script>
<script type="text/html" id="name_panel">
    <a lay-event="img_open">{{ d.name }} </a>
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="upload"><span><i class="layui-icon layui-icon-add-circle"></i>上传文件</span></button>
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
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;

        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height: 'full-180'
            ,limit:'<?php echo html_entities($limit); ?>'
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                 {type: 'checkbox'}
                ,{field: 'id', title: 'ID', width:80, sort: true}
                ,{field: 'name', title: '文件名称', width:250,toolbar: '#name_panel'}
                ,{field: 'ext', title:'后缀', width:60,toolbar: '#ext_panel'}
                ,{field: 'size', title:'大小', width:120,toolbar: '#size_panel'}
                ,{field: 'driver', title: '上传驱动', width:120}
                ,{field: 'app', title: '所属应用', width:110}
                ,{field: 'url', title: '访问地址', nimWidth:200}
                ,{field: 'create_time', title: '上传时间', width:160, sort: true}
                ,{title: '管理操作', width:100, toolbar: '#set_panel'}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(e){
            var id = e.data.id ,_event = e.event ,data=e.data;
            // 编辑
            if(_event === 'edit'){
                layer.open({
                    type:2,
                    title:'编辑',
                    maxmin:true,
                    area: ['350px', '450px'],
                    content:"<?php echo url('edit'); ?>?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false
            }
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
                return false
            }
            // 账户
            if(_event === 'account'){
                layer.open({
                    type:2,
                    title:'账户设置',
                    maxmin:true,
                    area: ['300px','250px'],
                    content:"<?php echo url('account'); ?>?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false
            }
            // 打开图片
            if(_event === 'img_open'){
                let tpl = '<div style="padding: 10px;"><img src="'+data.url+'" width="100%" /></div>';
                layer.open({
                    type:1,
                    title:'图片预览',
                    maxmin:true,
                    area: ['300px','320px'],
                    content:tpl
                });
                return false
            }
        });

        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            // 新增
            if(obj.event === 'upload'){
                layer.open({
                    type:2,
                    title:'文件上传',
                    area: ['800px', '550px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"<?php echo url('api',['app'=>'file']); ?>",
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