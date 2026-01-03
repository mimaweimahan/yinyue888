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
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>{$rule['title']}</em>{$rule['note']}</div>
        <ul class="panel-tab">
            <li class="layui-this"><a> 用户列表</a></li>
            <li><a id="add_user"> 新增推荐关系 </a></li>
        </ul>
    </div>
    <div class="panel-body">
        <li class="layui-show">
            <form class="layui-form">
                <ul class="search-box">
                    <li><input type="text" name="keys" placeholder="请输入关键词" autocomplete="off" class="layui-input"></li>
                    <li>
                        <select name="grade_id">
                            <option value="0">全部会员</option>
                            {volist name="grade_list" id="r"}
                            <option value="{$r['id']}">{$r['grade_name']}</option>
                            {/volist}
                        </select>
                    </li>
                    <li>
                        <div class="layui-input-inline">
                            <button type="button" class="layui-btn layui-btn-normal" lay-submit lay-filter="search_btn">搜索</button>
                            <button type="button" class="layui-btn layui-bg-green" lay-submit lay-filter="export_btn">导出数据</button>
                        </div>
                    </li>
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
<script type="text/html" id="account_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.uid }}">{{ d.account }}</a>
</script>
<script type="text/html" id="nickname_panel">
    <a href="{:url('admin/user.index/view')}?id={{ d.uid }}">[{{ d.uid }}] {{ d.nickname }}</a>
</script>
<script type="text/html" id="agent_area_panel">
    <div style="width: auto">
        {{# layui.each(d.agent_area, function(i,item){ }}
        {{item}}
        {{#  }); }}
    </div>
</script>
<script type="text/html" id="set_panel">
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="poster"><span>邀请码</span></a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="agent"><span>代理地区</span></a>
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="del"><span>删除</span></a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
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
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            form  = layui.form;

        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,height:'full-190'
            ,limit:{$limit}
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,cols: [[ //表头
                {type: 'checkbox'}
                ,{title: '管理操作', width:220, toolbar: '#set_panel'}
                ,{field: 'nickname', title: '会员名称', width:150, toolbar: '#nickname_panel'}
                ,{field: 'account', title:'会员账号', width:120, toolbar: '#account_panel'}
                ,{field: 'grade_name', title:'会员等级', width:120, sort: true , align: 'center'}
                ,{field: 'referee_name', title:'推荐人', width:120, toolbar: '#referee_panel'}
                ,{field: 'referee_time', title:'推荐时间', width:180}
                ,{field: 'agent_area', title: '代理区域', minWidth:120, toolbar: '#agent_area_panel'}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            console.log(obj);
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
            //
            if(_event === 'agent'){
               layer.open({
                    id:'agent_win',
                    type:2,
                    title: nickname+'代理区域设置',
                    area: ['380px', '500px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"{:url('agentarea')}?uid="+uid+'&q=1',
                    end:function () {
                       table.reload('table_list',{});
                    }
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
        $("#add_user").on('click',function () {
            layer.open({
                type:2,
                title:'新增',
                area: ['350px', '450px'],
                maxmin:true,
                shadeClose: true, //开启遮罩关闭
                content:"{:url('add')}",
                end:function () {
                    table.reload('table_list',{});
                }
            });
        });
        //搜索
        form.on('submit(search_btn)', function(data){
            table.reload('table_list',{
                where: data.field
            });
            return false;
        });
        //导出
        form.on('submit(export_btn)', function(data){
            $.ajax({
                url:"{:url('index',['export'=>1])}",
                async: false,
                type:"POST",
                data: data.field,
                dataType:'json',
                success: function(res){
                    layer.msg(res.msg);
                    table.exportFile([
                        'ID','姓名','手机号','等级ID','等级名称','推荐人','推荐人手机号'
                    ], res.data, {
                        type: 'csv', //导出的文件格式，支持: csv,xls
                        title: '订单数据'
                    });
                }
            });
            return false;
        });
    });
</script>
</body>
</html>