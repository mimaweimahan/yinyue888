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
        .grade_box{
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-items: center;
        }
        .grade_box .layui-btn{ margin-left: 5px}
    </style>
</head>
<body>
<div class="panel-default">
    <div class="panel-body">
        <div class="layui-show">
            <form class="layui-form">
                <input type="hidden" name="type" value="{$type}">
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
<script type="text/html" id="referee_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.referee_id }}">{{ d.referee_name }}</a>
</script>

<script type="text/html" id="nickname_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.uid }}">{{ d.nickname }} [第{{ d.level }}层]</a>
</script>

<script type="text/html" id="account_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.uid }}">{{ d.account }}</a>
</script>

<script type="text/html" id="my_team_tpl">
    <a lay-event="my_team">{{ d.my_team }}人</a>
</script>

<script type="text/html" id="zt_team_tpl">
    <a lay-event="zt_team">{{ d.zt_team }}人</a>
</script>

<script type="text/html" id="order_num_tpl">
    自己：<a href="{:url('order/index/index')}?uid={{ d.uid }}">{{ d.my_order_num }}单</a>
    <br />
    团队：{{ d.team_order_num }}单
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="poster"><span><i class="layui-icon layui-icon-share"></i>邀请码</span></a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del"><span><i class="layui-icon layui-icon-delete"></i>删除</span></a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="{__STATIC__}layui/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/lay/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,limit:{$limit}
            ,url: '{$url}&type={$type}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:180, toolbar: '#set_panel'}
                ,{field: 'nickname', title:'用户名', width:150, templet: '#nickname_panel'}
                ,{field: 'account', title:'手机号或账号', width:120, templet: '#account_panel'}
                ,{field: 'grade_name', title:'会员等级', width:100, align: 'center'}
                ,{field: 'amount', title:'余额', width:100, sort:true, align: 'center'}
                ,{field: 'referee_name', title:'推荐人', width:90, templet: '#referee_panel'}
                ,{field: 'my_team', title:'团队人数', width:110, align: 'center', templet:'#my_team_tpl'}
                ,{field: 'zt_team', title: '直推人数', width:110, align: 'center', templet:'#zt_team_tpl'}
                ,{field: 'order_num', title: '报单数', width:150, align: 'center', templet:'#order_num_tpl'}
            ]]
        });

        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id, uid=obj.data.uid, _event = obj.event;
            var nickname = obj.data.nickname;
            if(_event === 'del'){
                layer.confirm('确定要删除吗', function(index){
                    $.getJSON("{:url('group/admin.relation/delete')}",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }
            if(_event === 'poster'){
                parent.layer.open({
                    type:2,
                    title: nickname + '邀请海报',
                    area: ['280px', '500px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('poster')}?uid="+uid+'&q=1'
                });
            }

            if(_event === 'zt_team'){
                parent.layer.open({
                    type:2,
                    title: nickname + '直推团队',
                    area: ['900px', '500px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('team')}?uid="+uid+'&type=1'
                });
            }
            if(_event === 'my_team'){
                parent.layer.open({
                    type:2,
                    title: nickname + '他的团队',
                    area: ['900px', '500px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('team')}?uid="+uid+'&type=2'
                });
            }
        });
        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            var data = checkStatus.data;
            var ids  = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
            }
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
            }
            // 删除
            if(obj.event === 'delete'){
                layer.confirm('确定要删除吗', function(){
                    $.ajax({
                        url:"{:url('group/admin.relation/delete')}",
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