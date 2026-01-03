<?php /*a:1:{s:68:"/www/wwwroot/tisktshop.com/app/agent/view/admin/withdrawal/index.php";i:1762777461;}*/ ?>
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
            <fieldset>
                <legend>条件搜索</legend>
                <form class="layui-form layui-form-pane searchForm" lay-filter="table-search"  autocomplete="off">
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">创建时间</label>
                        <label class="layui-input-inline" style="width: auto; display: flex;align-items: center;">
                            <input type="text" autocomplete="off" name="start_time" id="start_time" class="layui-input inline-block" placeholder="开始时间">
                            <span>-</span>
                            <input type="text" autocomplete="off" name="end_time" id="end_time"  class="layui-input inline-block" placeholder="结束时间">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">业务员ID</label>
                        <div class="layui-input-inline">
                            <select name="worker_id" id="worker_id" class="layui-select">
                                <option value="">请选择</option>
                                <?php if(is_array($salesman_list) || $salesman_list instanceof \think\Collection || $salesman_list instanceof \think\Paginator): $i = 0; $__LIST__ = $salesman_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo html_entities($r['worker_id']); ?>"><?php echo html_entities($r['worker_user']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">用户ID</label>
                        <label class="layui-input-inline">
                            <input type="text" name="uid" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">用户性质</label>
                        <label class="layui-input-inline">
                            <select name="user_type" id="user_type" class="layui-select">
                                <option value="">全部</option>
                                <option value="1">普通用户</option>
                                <option value="2">虚拟号</option>
                            </select>
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">地址类型</label>
                        <label class="layui-input-inline">
                            <select name="address_type" id="address_type" class="layui-select">
                                <option value="">全部</option>
                                <option value="0">TRC</option>
                                <option value="1">ERC</option>
                                <option value="2">BSC</option>
                            </select>
                        </label>
                    </div>

                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">状态</label>
                        <label class="layui-input-inline">
                            <select name="status" id="status" class="layui-select">
                                <option value="">全部</option>
                                <option value="1">待处理</option>
                                <option value="2">已成功</option>
                                <option value="3">已取消</option>
                            </select>
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <button class="layui-btn layui-btn-md " lay-submit lay-filter="search_btn">
                            <i class="layui-icon layui-icon-search"></i> 搜索
                        </button>
                        <button type="reset" class="layui-btn layui-btn-md layui-btn-primary" lay-submit lay-filter="table-reset">
                            <i class="layui-icon layui-icon-refresh"></i>重置
                        </button>
                    </div>
                </form>
                <blockquote class="layui-elem-quote">
                    <div id="reprot_total">
                        <span class="layui-btn layui-btn-primary layui-btn-sm">总数量:<b class="color-red" id="all_total">0</b></span>
                        <span class="layui-btn layui-btn-primary layui-btn-sm">总金额:<b class="color-red" id="all_balance">0</b></span>
                    </div>
                </blockquote>
            </fieldset>
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="table-bar">
    {{# if(d.status==0){ }}
    {{# if(d.user_type==0 ){ }}
    <button type="button" class="layui-btn layui-btn-xs" lay-event="approval">审核</button>
    {{# }else{ }}
    <a class="layui-btn layui-btn-xs">虚拟用户</a>
    {{# } }}
    {{# }else{ }}
    <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="approval">查看</a>
    {{# } }}
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

        laydate.render({
            elem: '#start_time'
        });
        laydate.render({
            elem: '#end_time'
        });
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '数据列表'
            ,limit:"<?php echo html_entities($limit); ?>"
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,parseData: function(res){
                $("#all_total").text(res.attach.all_total);
                $("#all_balance").text(res.attach.all_balance);
                return {
                    "code": res.code, //解析接口状态
                    "count": res.count, //解析数据长度
                    "data": res.data //解析数据列表
                };
            }
            ,cols: [[
                {type: 'checkbox'},
                {title:'操作',width: 80, align: 'center', toolbar: '#table-bar'},
                {field:'id',title:'序号', width:110,align:'center',hide:"true"},
                {field:'status',width:100,title:'订单状态',align:'center',templet: function(d){
                        switch (d.status) {
                            case 0:
                                return '<span class="color-orange">未处理</span>' ;
                            case 1:
                                return '<span class="color-blue">已完成</span>' ;
                            case -1:
                            case 2:
                                return '<span class="color-red">已失败</span>' ;
                        }
                    }},
                {field:'created_at', width:'160',title:'创建时间',align:'center'},
                {title: "代理",  field: "agent_id",width: 120, templet: function (d) {
                        return '[' +d.agent_id + ']' + d.agent_name;
                }},
                {title: "业务员", field: "worker_id",width: 120, templet: function (d) {
                        return '[' +d.worker_id + ']' + d.worker_name;
                }},
                {title: "用户ID", align: "center", field: "uid",width: 100,templet: function (d) {
                        switch (d.user_type) {
                            case 1:
                               return '<span class="color-blue">'+ d.uid +'</span>';
                            case 0:
                                return d.uid;
                        }
                    }},
                {title: "国家", align: "center", field: "phonecode",width: 100},
                {title: "付款编号", align: "center", field: "trade_no",width: 180},
                {title: "地址",  field: "address",width: 380},
                {field:'p_balance',width:120,title:'付款金额',align:'center', templet: function (d) {
                        return parseFloat( d.balance ) - parseFloat(d.withdraw_fee);
                    }},
                {field:'balance',width:120,title:'提现金额',align:'center'},
                {field:'symbol',width:100,title:'币种',align:'center'},
                {field:'withdraw_fee',width:100,title:'手续费',align:'center'},
                {field:'payTime',width:'120',title:'支付时间',align:'center'},

                {width: 150, field:'mark',title:'备注',align:'center'},
            ]]
        });
        //监听行工具事件
        table.on('tool(table_list)', function(obj){
            var id = obj.data.id ,_event = obj.event;

            // 删除
            if(_event === 'del'){
                layer.confirm('确定要删除吗，删除后会删除用户的全部数据', function(index){
                    $.getJSON("<?php echo url('delete'); ?>",{'id':id}).done(function (data) {
                        layer.msg(data.msg);
                        if (data.code === 1) {
                            obj.del();
                            layer.close(index);
                        }
                    });
                });
            }

            // 审核
            if(_event === 'approval'){
                layer.open({
                    type:2,
                    title:'提现编号 '+obj.data.trade_no+' 审核处理',
                    maxmin:true,
                    area: ['600px', '400px'],
                    content:"<?php echo url('approval'); ?>?id="+id,
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
            if (!data.length ){
                return layer.msg('请勾选需要操作的数据');
            }
            var ids = [];
            for(var i=0; i < data.length; i++) {
                ids.push(data[i].id);
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