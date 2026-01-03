<?php /*a:1:{s:56:"/www/wwwroot/tisktshop.com/app/goods/view/type/index.php";i:1756620696;}*/ ?>
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
    <style>
        .color-box{
            width: 20px;
            height: 20px;
            border: 1px solid #eee;
            border-radius: 3px;
            padding: 1px;
        }
        .color-icon{
            width: 50px;
            height: 50px;
            border-radius: 10px;
            color: #FFFFFF;
            text-align: center;
            font-size: 0.5rem;
            line-height: 50px;
            overflow: hidden;
        }
        .color-icon img{
            width: 60%;
        }
    </style>
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
<script type="text/html" id="sort_panel">
    <input type="text" name="sort[{{ d.id }}]" value="{{ d.sort }}" autocomplete="off" class="layui-input layui-input-25" width="100%" />
</script>

<script type="text/html" id="title_panel">
    <a href="<?php echo url('index'); ?>?pid={{ d.id }}"> {{ d.type_name }} </a>
</script>

<script type="text/html" id="status_panel">
    {{#  if(d.show === 1){ }}
    <span class="layui-badge layui-bg-green">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-danger">否</span>
    {{#  } }}
</script>
<script type="text/html" id="zy_panel">
    {{#  if(d.zy === 1){ }}
    <span class="layui-badge layui-bg-green">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-danger">否</span>
    {{#  } }}
</script>
<script type="text/html" id="color_panel">
    <div class="color-box" style="background:{{ d.color }}"></div>
</script>
<script type="text/html" id="image_panel">
    {{#  if( d.image ){ }}
    <div class="color-icon" style="background:{{ d.color }}">
        <img src="{{ d.image }}" width="50px" />
    </div>
    {{#  } else { }}
    <div class="color-icon" style="background:{{ d.color }}">
        <div>{{ d.type_name }}</div>
    </div>
    {{#  } }}
</script>

<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a class="layui-btn layui-btn-sm" lay-event="add_btn"><span><i class="layui-icon layui-icon-add-circle"></i>新增</span></a>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="cache_btn">
                <span><i class="layui-icon layui-icon-refresh"></i>更新缓存</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-mo layui-btn-sm" lay-submit lay-filter="sort_btn">
                <span><i class="layui-icon layui-icon-cols"></i>排序</span>
            </button>
            <button type="button" class="layui-btn layui-btn-normal layui-btn-sm" lay-event="delete">
                <span><i class="layui-icon layui-icon-delete"></i>删除</span>
            </button>
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
    }).use(['element','layer', 'table', 'jquery','form','element','laytpl'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        //执行一个 table 实例
        var w_height = $(window).height();
        var table_h = 500;
        if(w_height>800){
            table_h = w_height-300;
        }
        table.render({
            elem:'#table_list'
            ,height: table_h
            ,limit: '<?php echo html_entities($limit); ?>'
            ,url: "<?php echo url('index',['pid'=>$pid]); ?>" //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,method:'post'
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:150, align: 'center', toolbar: '#set_panel'}
                ,{field: 'sort', title: '排序', width:100,toolbar: '#sort_panel',sort: true}
                ,{field: 'id', title: 'ID', width:80,sort: true}
                ,{field: 'type_name', title: '分类名称', width:140, toolbar: '#title_panel', sort: true}
                ,{field: 'status', title: '取用', width:90, align: 'center', toolbar: '#status_panel', sort: true}
            ]]
        });

        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var data = obj.data, id = obj.data.id ,_event = obj.event;
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

            // 编辑
            if(_event === 'edit'){
                layer.open({
                    type:2,
                    title:'编辑',
                    area: ['350px', '520px'],
                    maxmin:true,
                    content:"<?php echo url('edit'); ?>?id="+id,
                    end:function () {
                        table.reload('table_list',{});
                    }
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
                        location.reload();
                    }
                }
            });
            return false;
        });
        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            // 更新缓存
            if(obj.event === 'cache_btn'){
                $.ajax({
                    url:"<?php echo url('typeCache'); ?>",
                    async: false,
                    type: "POST",
                    success: function(data){
                        layer.msg(data.msg);
                    }
                });
                return false;
            }

            // 新增
            if(obj.event === 'add_btn'){
                layer.open({
                    type:2,
                    title:'新增',
                    area: ['350px', '520px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"<?php echo url('add'); ?>",
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false;
            }

            var data = checkStatus.data;
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
            }

            var ids = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
            }
            if(obj.event === 'show' || obj.event === 'show_no'){
                let show = 0;
                if(obj.event === 'show'){
                    show = 1;
                }
                $.ajax({
                    url:"<?php echo url('setField',['field'=>'show']); ?>",
                    async: false,
                    type:"POST",
                    data:{'val':show,'id':ids},
                    dataType:'json',
                    success: function(data){
                        layer.msg(data.msg);
                        if(data.code === 1){
                            table.reload('table_list',{});
                        }
                    }
                });
            }
            if(obj.event === 'zy' || obj.event === 'un_zy'){
                let zy = 0;
                if(obj.event === 'zy'){
                    zy = 1;
                }
                $.ajax({
                    url:"<?php echo url('setField',['field'=>'zy']); ?>",
                    async: false,
                    type:"POST",
                    data:{'val':zy,'id':ids},
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