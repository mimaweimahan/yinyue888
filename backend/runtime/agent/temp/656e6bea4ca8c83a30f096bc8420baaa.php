<?php /*a:1:{s:61:"/www/wwwroot/tisktshop.com/app/agent/view/admin/pai/index.php";i:1762764651;}*/ ?>
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
        .layui-table-tool-temp, .layui-btn-container{ margin-top: 0;}
        @media (max-width: 768px){
            .layui-table-tool-temp,.layui-btn-container{ margin-top: 0;!important;}
        }
    </style>
</head>
<body class="body-main-p">
<div class="page-package">
    <div class="layui-card-body">
        <div class="layui-show">
            <form class="layui-form" action="<?php echo url('add'); ?>">
                <div class="layui-row layui-col-space16">
                    <div class="layui-col-xs3">
                        <label class="relative block">
                            <span class="color-green font-w7">任务编号</span>
                            <span class="color-desc margin-left-5">Task Num</span>
                            <input type="text" name="task_no" value="0"  placeholder="请填写数字" class="layui-input">
                            <span class="color-desc"></span>
                        </label>
                    </div>
                    <div class="layui-col-xs3">
                        <label class="relative block">
                            <span class="color-green font-w7">收益倍数</span>
                            <span class="color-desc margin-left-5">Rate</span>
                            <input type="text" name="task_rate" value="1" lay-verify="number" placeholder="收益倍数" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-col-xs3">
                        <label class="relative block">
                            <span class="color-green font-w7">派单最小值</span>
                            <span class="color-desc margin-left-5">Start</span>
                            <input type="text" name="start_balance" value="0" lay-verify="number" placeholder="最小金额" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-col-xs3">
                        <label class="relative block">
                            <span class="color-green font-w7">派单最大值</span>
                            <span class="color-desc margin-left-5">End</span>
                            <input type="text" name="end_balance" value="0" lay-verify="number" placeholder="最大金额" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item">
                        <input type="hidden" name="uid" value="<?php echo html_entities($uid); ?>">
                        <input type="hidden" name="agent_id" value="<?php echo html_entities($agent_id); ?>">
                        <input type="hidden" name="worker_id" value="<?php echo html_entities($worker_id); ?>">
                        <input type="hidden" name="user_type" value="<?php echo html_entities($user_type); ?>">
                        <button type="button" style="float: right" class="layui-btn" lay-submit lay-filter="submit_btn">提交</button>
                    </div>
                </div>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="action">
    <a class="layui-btn layui-btn-xs layui-btn-warm" lay-event="del">删除</a>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="import"> 一键导入 </button>
            <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" lay-event="clear"> 清空所有任务 </button>
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
            ,limit:"<?php echo html_entities($limit); ?>"
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar:false
            ,cols: [[
                {field: 'pai_id', hide:true},
                {field: 'created_at', title: '时间',width: 160},
                {field: 'task_no', align:'center', title: '任务编号', width: 110},
                {field: 'start_balance',align: 'center', title: '最小', width: 100},
                {field: 'end_balance',align: 'center', title: '最大', width: 100},
                {field: 'task_rate',align: 'center', title: '倍率', width: 60},
                {field: 'status',align: 'center',width:60,title: '状态',templet: function(d){
                        return  (d.status === 1 ? '<span class="color-red">完成</span>' : '-') ;
                    }},
                {title: '-',width: 100, align: 'center', toolbar: '#action'}
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id ,_event = obj.event;
            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗，删除后不能恢复', function(index){
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

        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            var checkStatus = table.checkStatus(obj.config.id);
            if(obj.event === 'import'){
                parent.layer.open({
                    type:2,
                    title:'导入',
                    area: ['720px', '480px'],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"<?php echo url('import'); ?>?uid=<?php echo html_entities($uid); ?>",
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

            // 清空
            if(obj.event === 'clear'){
                layer.confirm('确定要执行清空吗？操作后不能恢复', function(){
                    $.ajax({
                        url:"<?php echo url('clear'); ?>",
                        async: false,
                        type: "POST",
                        data:{'uid':"<?php echo html_entities($uid); ?>"},
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
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"<?php echo url('add'); ?>",
                async: false,
                type:"POST",
                data:data.field,
                success: function(res){
                    layer.msg(res.msg);
                    if(res.code===1){
                        table.reload('table_list',{});
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>