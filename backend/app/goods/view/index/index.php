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
    <style>
        .panel-body{ position: relative}
        .left-type{ width: 150px; height: 100%; position: absolute; top:0; left: 0; }
        .layui-show{ padding-left: 150px;}
        .left-type h2{ position: relative; font-size: 14px; line-height: 52px; height: 52px; border-bottom: 1px #eee solid; padding-left: 20px}
        .left-type .open-btn{width: 100%; position: relative; }
        .left-type .open-btn .icon-box{ width: 30px; height: 30px; cursor: pointer;  color: #fff; font-size: 10px; line-height: 30px;  border-radius: 3px; position: absolute; top:12px; left: 120px; z-index: 100; text-align: center; background: #58616c;}
        .left-type .open-btn .icon-box .layui-icon{ color: #FFFFFF}

        #left-type-box{ margin-top: 10px; overflow-y: auto; height:calc(100% - 80px);}
        .hide-left .left-type{ width: 0; }
        .hide-left .left-type .icon-box{ left: -18px; width: 25px; border-radius: 5px 0 0 5px;}
        .hide-left .left-type .layui-icon-left{ display: none;}
        .hide-left h2{ display: none}
        .hide-left #left-type-box{ display: none}
        .hide-left .layui-show{ padding-left: 0; }
        .attribute{ display: flex; align-items: center; margin: 5px 0;}
        .attribute .name{ padding: 0 5px;}
    </style>
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>{$rule['title']}</em>{$rule['note']}</div>
    </div>
    <div class="panel-body hide-left">
        <div class="left-type">
            <div class="open-btn">
                <span class="icon-box">
                    <i class="layui-icon layui-icon-left"></i>
                    <i class="layui-icon layui-icon-right"></i>
                </span>
            </div>
            <h2>商品分类 </h2>
            <div id="left-type-box"></div>
        </div>
        <div class="layui-show">
            <form class="layui-form">
                <input type="hidden" name="type_id" value="{$type_id}">
                <ul class="search-box">
                    <li><input type="text" name="keys" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
                    <li>
                        <select name="type_id" id="type_id">
                            <option value="0">商品分类</option>
                            {$type_list|raw}
                        </select>
                    </li>
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

<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a href="{:url('add',['type_id'=>$type_id])}" class="layui-btn layui-btn-sm"><span><i class="layui-icon layui-icon-add-circle"></i>新增</span></a>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>删除</span></button>
        </div>

        <div class="layui-btn-group">
            <!--
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-submit lay-filter="sort_btn">
                <span><i class="layui-icon layui-icon-cols"></i>排序</span>
            </button>
            -->
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-submit lay-filter="up_btn">
                <span><i class="layui-icon layui-icon-refresh"></i>批量更新</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="status_1">
                <span><i class="layui-icon layui-icon-up"></i>上架</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="status_0">
                <span><i class="layui-icon layui-icon-down"></i>下架</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="top_1">
                <span><i class="layui-icon layui-icon-praise"></i>推荐</span>
            </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="top_0">
                <span><i class="layui-icon layui-icon-tread"></i>取消</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="move">
                <span><i class="layui-icon layui-icon-transfer"></i>转移分类</span>
            </button>
        </div>
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script type="text/html" id="price_panel">
    <input type="text" name="price[ {{ d.id }} ]" value="{{d.price}}" class="layui-input" style="width:100px;" placeholder="0" />
</script>
<script type="text/html" id="daily_panel">
    <input type="text" name="daily_sale[ {{ d.id }} ]" value="{{d.daily_sale}}" class="layui-input" style="width:100px;" placeholder="0" />
</script>
<script type="text/html" id="total_panel">
    <input type="text" name="total_sales[ {{ d.id }} ]" value="{{d.total_sales}}" class="layui-input" style="width:100px;" placeholder="0" />
</script>
<script type="text/html" id="incr_rate_panel">
    <input type="text" name="incr_rate[ {{ d.id }} ]" value="{{d.incr_rate}}" class="layui-input" style="width:100px;" placeholder="0" />
</script>
<script type="text/html" id="sort_panel">
    <input type="text" name="sort[{{ d.id }}]" value="{{ d.sort }}" autocomplete="off" class="layui-input layui-input-25" width="100%" />
</script>
<script type="text/html" id="status_panel">
    {{#  if(d.status === 1){ }}
    <span class="layui-badge layui-bg-green">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-danger">否</span>
    {{#  } }}
</script>
<script type="text/html" id="top_panel">
    {{#  if(d.is_top === 1){ }}
    <span class="layui-badge layui-bg-green">是</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-danger">否</span>
    {{#  } }}
</script>
<script type="text/html" id="img_panel">
    <img src="{{ d.image }}" width="50" height="50">
</script>

<script type="text/html" id="set_panel">
    <a href="{:url('edit')}?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-primary">编辑</a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del">删除</a>
</script>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form','util','tree'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        layui.tree.render({
            elem: '#left-type-box',
            showLine: true,
            id:'left-type-box-ck',
            showCheckbox:false,
            click:function(e){
                let map = {'type_id':e.data.id,};
                table.reload('table_list',{
                    where: map
                });
            },
            data: {$goods_type|raw}
        })
        $('.icon-box').on('click',function (){
            if($('.panel-body').hasClass('hide-left')){
                $('.panel-body').removeClass('hide-left');
            }else {
                $('.panel-body').addClass('hide-left');
            }
        });

        table.render({
            elem:'#table_list'
            ,height: 'full-200'
            ,limit:{$limit}
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:120, toolbar: '#set_panel'}
                ,{field: 'id', title: 'ID', width:80, sort: true, hide: true}
                ,{field: 'sort', title: '排序', width:100,toolbar: '#sort_panel',sort: true, hide: true}
                ,{field: 'pic', title:'商品图', width:100, toolbar: '#img_panel', hide: false}
                ,{field: 'title', title:'商品名称', minWidth:200}
                ,{field: 'type_name', title:'所属分类', width:110, hide: true}
                ,{field: 'price', title: '价格', width:150, toolbar: '#price_panel',sort: true}
                ,{field: 'daily_sale', title: '日销售额', width:150, toolbar: '#daily_panel',sort: true}
                ,{field: 'total_sales', title: '总销售额', width:150, toolbar: '#total_panel',sort: true}
                ,{field: 'incr_rate', title: '日增长率', width:150, toolbar: '#incr_rate_panel',sort: true}
                ,{field: 'status', title:'上架', width:80, toolbar: '#status_panel',align: 'center', sort: true}
                ,{field: 'is_top', title: '推荐', width:80, toolbar: '#top_panel',align: 'center', sort: true}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id ,_event = obj.event;
            if(_event === 'del'){
                layer.confirm('确定要删除吗', function(index){
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

        //批量更新
        form.on('submit(up_btn)', function(data){
            console.log(data.field);
            $.ajax({
                url:"{:url('config')}",
                async: false,
                type:"POST",
                data:data.field,
                dataType:'json',
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { table.reload('table_list',{}); },3000);
                    }
                }
            });
            return false;
        });
        //排序
        form.on('submit(sort_btn)', function(data){
            $.ajax({
                url:"{:url('sort')}",
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
            // 新增
            if(obj.event === 'add'){
                layer.open({
                    type:2,
                    title:'新增',
                    area: ['350px', '400px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('add')}",
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false;
            }
            var checkStatus = table.checkStatus(obj.config.id);
            var data = checkStatus.data;
            var ids  = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
            }
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
            }
            if(obj.event === 'status_1' || obj.event === 'status_0'){
                var status;
                if(obj.event === 'status_1'){
                    status = 1;
                }else{
                    status = 0;
                }
                $.ajax({
                    url:"{:url('setField')}",
                    async: false,
                    type:"POST",
                    data:{'val':status,'field':'status','id':ids},
                    dataType:'json',
                    success: function(data){
                        layer.msg(data.msg);
                        if(data.code === 1){
                            table.reload('table_list',{});
                        }
                    }
                });
            }
            //转移商城
            if(obj.event === 'move'){
                layer.open({
                    type:2,
                    title:'商品转移',
                    area: ['300px', '450px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('move')}?ids="+ids,
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false;
            }

            if(obj.event === 'top_1' || obj.event === 'top_0'){
                var top = 0;
                if(obj.event === 'top_1'){
                    top = 1;
                }else{
                    top = 0;
                }
                $.ajax({
                    url:"{:url('setField')}",
                    async: false,
                    type:"POST",
                    data:{'val':top,'field':'is_top','id':ids},
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