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
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>团队管理</em></div>
        <ul class="panel-tab">
            <li><a href="{:url('admin/user.team/index')}"> 团队列表</a></li>
            <li class="layui-this"><a href="{:url('admin/user.teamData/index')}"> 团队成员 </a></li>
        </ul>
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
<script type="text/html" id="referee_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.referee_id }}">{{ d.referee_name }}</a>
</script>

<script type="text/html" id="parent_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.parent_uid }}">{{ d.parent_name }}</a>
</script>

<script type="text/html" id="nickname_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.uid }}">{{ d.nickname }}</a>
</script>

<script type="text/html" id="username_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.uid }}">{{ d.username }}</a>
</script>

<script type="text/html" id="my_team_tpl">
    <a lay-event="my_team">{{ d.team_num }}人</a>
</script>



<script type="text/html" id="reward_tpl">
    {{#  if(d.reward === 1){ }}
    <span class="layui-badge layui-bg-green">已奖励</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-orange">待执行</span>
    {{#  } }}
</script>

<script type="text/html" id="complete_tpl">
    {{#  if(d.complete === 1){ }}
    <span class="layui-badge layui-bg-green">已排满</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-orange">待排满</span>
    {{#  } }}
</script>

<script type="text/html" id="position_tpl">
    {{#  if(d.parent_position == 'left'){ }}
    <span class="layui-badge layui-bg-gray">左边</span>
    {{#  } }}

    {{#  if(d.parent_position == 'center'){ }}
    <span class="layui-badge layui-bg-gray">中间</span>
    {{#  } }}

    {{#  if(d.parent_position == 'right'){ }}
    <span class="layui-badge layui-bg-gray">右边</span>
    {{#  } }}
</script>

<script type="text/html" id="set_panel">
    <!--
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="poster"><span><i class="layui-icon layui-icon-share"></i>邀请码</span></a>
    -->
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="reward"><span>执行奖励</span></a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="add"><span><i class="layui-icon layui-icon-add-1"></i>快捷加入</span></a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del"><span><i class="layui-icon layui-icon-delete"></i>删除</span></a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="add"><span><i class="layui-icon layui-icon-add-circle"></i>添加团队成员</span></button>
        </div>
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
            ,height: 'full-80'
            ,limit: {$limit}
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:250, toolbar: '#set_panel'}
                ,{field: 'nickname', title:'用户名', width:120, templet: '#nickname_panel'}
                ,{field: 'team_id', title:'团队编号', width:100}
                ,{field: 'username', title:'手机号或账号', width:120, templet: '#username_panel'}
                ,{field: 'parent_name', title:'父级', width:120, templet: '#parent_panel'}
                ,{field: 'referee_name', title:'直推', width:120, templet: '#referee_panel'}
                ,{field: 'reward', title:'奖励状态', width:110, align: 'center', templet:'#reward_tpl'}
                ,{field: 'complete', title:'是否排满', width:110, align: 'center', templet:'#complete_tpl'}
                ,{field: 'parent_position', title:'位置', width:80, align: 'center', templet:'#position_tpl'}
                ,{field: 'my_team', title:'团队人数', width:110, align: 'center', templet:'#my_team_tpl'}
                ,{field: 'add_time', title:'加入时间', width:180, align: 'center'}
            ]]
        });

        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id, uid=obj.data.uid, _event = obj.event;
            var nickname = obj.data.nickname;
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
            if(_event === 'add'){
                parent.layer.open({
                    type:2,
                    title: '给'+nickname+'添加新成员',
                    area: ['350px', '420px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('create')}?pid="+id,
                    end:function(e){
                        table.reload('table_list',{});
                    }
                });
                return false;
            }
            if(_event === 'poster'){
                parent.layer.open({
                    type:2,
                    title: nickname+'邀请海报',
                    area: ['280px', '500px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('poster')}?uid="+uid+'&q=1'
                });
            }

            if(_event === 'reward'){
                layer.confirm('确定要执行吗', function(index){
                    $.getJSON("{:url('reward')}",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }

            if(_event === 'zt_team'){
                parent.layer.open({
                    type:2,
                    title: nickname+'的直推团队',
                    area: ['900px', '530px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('team')}?uid="+uid+'&type=1'
                });
            }
            if(_event === 'my_team'){
                parent.layer.open({
                    type:2,
                    title: nickname+'的团队',
                    area: ['60vw', '60vh'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('view')}?id="+id
                });
            }
        });
        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            if(obj.event === 'add'){
                parent.layer.open({
                    type:2,
                    title: '新增团队成员',
                    area: ['350px', '420px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('add')}",
                    end:function(e){
                        table.reload('table_list',{});
                    }
                });
                return false;
            }
            var checkStatus = table.checkStatus(obj.config.id);
            var data = checkStatus.data;
            var ids  = [];
            var uids  = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
                uids.push(data[i].uid);
            }
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
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
            //设置等级
            if(obj.event === 'set'){
                layer.confirm('确定要设置勾选用户的等级吗？', function(){
                    var grade_id = $("select[name='grade_select']").val();
                    $.ajax({
                        url:"{:url('grade')}",
                        async: false,
                        type: "POST",
                        data:{'id':uids,'grade_id': grade_id},
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