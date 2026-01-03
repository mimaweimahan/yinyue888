<?php /*a:1:{s:60:"/www/wwwroot/tisktshop.com/app/agent/view/sys/user/index.php";i:1767130230;}*/ ?>
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
    <title>用户管理</title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>用户管理</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <fieldset>
                <legend>条件搜索</legend>
                <form class="layui-form layui-form-pane searchForm" lay-filter="table-search"  autocomplete="off">
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
                        <label class="layui-form-label">用户ID</label>
                        <label class="layui-input-inline">
                            <input type="text" name="uid" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">推荐人ID</label>
                        <label class="layui-input-inline">
                            <input type="text" name="referee_id" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div></div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">区号</label>
                        <label class="layui-input-inline">
                            <input type="text" name="country_code" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">手机</label>
                        <label class="layui-input-inline">
                            <input type="text" name="phone" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">邮箱</label>
                        <label class="layui-input-inline">
                            <input type="text" name="email" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">IP地址</label>
                        <label class="layui-input-inline">
                            <input type="text" name="ip" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">备注</label>
                        <label class="layui-input-inline">
                            <input type="text" name="remark" value="" autocomplete="off" class="layui-input">
                        </label>
                    </div>
                    <div></div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">状态</label>
                        <label class="layui-input-inline">
                            <select name="status" id="status" class="layui-select">
                                <option value="0">全部</option>
                                <option value="2">正常</option>
                                <option value="1">禁止</option>
                            </select>
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">在线</label>
                        <label class="layui-input-inline">
                            <select name="is_online" id="is_online" class="layui-select">
                                <option value="0">全部</option>
                                <option value="2">在线</option>
                                <option value="1">离线</option>
                            </select>
                        </label>
                    </div>
                    <div class="layui-form-item layui-inline input-line">
                        <label class="layui-form-label">抢单</label>
                        <label class="layui-input-inline">
                            <select name="is_task" class="layui-select">
                                <option value="">全部</option>
                                <option value="1">已开启</option>
                                <option value="2">进行中</option>
                                <option value="3">未开启</option>
                                <option value="4">已开启未开始</option>
                                <option value="5">已完成</option>
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
                    <div id="reprot_total"></div>
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
<script type="text/html" id="status_panel">
    {{#  if(d.status === 1){ }}
    <span class="layui-badge layui-bg-green">启用</span>
    {{#  } else { }}
    <span class="layui-badge layui-bg-primary">停用</span>
    {{#  } }}
</script>

<script type="text/html" id="task">
    <input type="checkbox" name="is_task" value="{{d.uid}}" lay-skin="switch" lay-text="开启|关闭" lay-filter="task" {{ d.is_task == 1 ? 'checked' : '' }}>
</script>

<!-- 表格行工具栏 -->
<script type="text/html" id="table-bar">
    <a class="layui-btn layui-btn-sm" lay-event="more">操作<i class="layui-icon layui-icon-down"></i></a>
</script>
<script type="text/html" id="is_top">
    <input type="checkbox" name="is_top" value="{{d.uid}}" lay-skin="switch" lay-text="ON|OFF" lay-filter="is_top" {{ d.is_top == 1 ? 'checked' : '' }}>
</script>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <div class="layui-btn-group">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="add"><span><i class="layui-icon layui-icon-add-circle"></i>新增</span></button>
            <button type="button" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="delete"><span><i class="layui-icon layui-icon-delete"></i>注销</span></button>
        </div>

        <div class="layui-btn-group">
            <a href="javascript:history.back();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-left"></i>返回</span></a>
            <a href="javascript:location.reload();" class="layui-btn layui-btn-sm layui-btn-primary"><span><i class="layui-icon layui-icon-refresh"></i>刷新</span></a>
        </div>
    </div>
</script>
<script src="/statics/layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    function is_mobile(){
        return window.screen.width <= 768;
    }
    // 相关常量
    const ACCOUNT_API = "<?php echo url('agent/sys.wallet/index'); ?>";
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form','dropdown','laydate'], function(){
        var $ = layui.jquery,
            table = layui.table,
            layer = layui.layer,
            dropdown = layui.dropdown,
            laydate = layui.laydate,
            form  = layui.form;

        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-200;
        }
        laydate.render({
            elem: '#start_time'
        });
        laydate.render({
            elem: '#end_time'
        });
        //执行一个 table 实例
        table.render({
            elem:'#table_list'
            //,height: table_h
            ,url: '<?php echo html_entities($url); ?>' //数据接口
            ,title: '数据列表'
            ,limit:"<?php echo html_entities($limit); ?>"
            ,page: true //开启分页
            ,toolbar: '#toolbar' //开启头部工具栏，并为其绑定左侧模板
            ,cols: [[
                {title: "操作", toolbar: "#table-bar", align: "center", width: 90},
                {
                    title: "ID", align: "center", field: "id",width: 80,
                    templet: function (d) {
                        var str = d.id + '<br /><br />';
                        str += (d.is_online === 0 ?  '<span class="layui-badge-rim">离线</span>' : '<span class="layui-btn layui-btn-xs">在线</span>');
                        return  str;
                    }
                },
               {field: 'updated_time', align: 'left', sort:true, title: '活跃信息', width: 190, templet: function(d){
                        var str = '<span class="layui-badge-rim layui-bg-green">登录 </span> ' + (d.last_login_ip ? d.last_login_ip : (d.reg_ip || '-')) +'<hr class="mr5" />';
                        // 地区显示：优先显示last_area，如果没有则显示'-'
                        var area = d.last_area || '-';
                        str += '<span class="layui-badge-rim layui-bg-orange">地区 </span> ' + area +'<hr class="mr5" />';
                        str += '<span class="layui-badge-rim layui-bg-blue">登陆时间 </span> ' + d.last_login_time +'<hr class="mr5" />';
                        // 显示活跃时间（如果有值且不为空）
                        if(d.is_online_time && d.is_online_time !== '' && d.is_online_time !== null && d.is_online_time !== undefined){
                            str += '<span class="layui-badge-rim" style="background-color: #dc2fbf; color: #fff;">活跃 </span> ' + d.is_online_time;
                        }
                        return  str;
                    }
                },
                {
                    title: "代/业/推", align: "center", field: "agent_id",width: 80,event:'viewReport',
                    templet: function (d) {
                        return (d.agent_id === 0 ?  '-' : d.agent_id) +'<hr class="mr5" />' + (d.worker_id === 0 ?  '-' : d.worker_id) + '<hr class="mr5" />' + (d.referee_id ? d.referee_id: '-' );
                    }
                },
                {
                    title: "手机/邮箱/邀请码/注册时间", align: "center", field: "created_at", width: 220,sort:true,
                    templet: function(d){
                        switch (d.user_type) {
                            case 1 :
                                return  '<b class="color-blue" title="'+d.nickname+'">+' + (d.country_code+' '+ d.phone ? d.country_code+' '+ d.phone : '-') + '</b><hr class="mr5" />' + (d.email ? d.email : '-') + '<hr class="mr5" />' + d.invite+ '<hr class="mr5" />' + d.reg_time;
                            default :
                                return '+' + '<span title="'+d.nickname+'">'+(d.country_code+' '+ d.phone ? d.country_code+' '+ d.phone : '-')+'</span>' +'<hr class="mr5" />' + (d.email ? d.email : '-') +  '<hr class="mr5" />' + d.invite+ '<hr class="mr5" />' + d.reg_time;
                        }
                    }
                },
                {field: 'balance',align: 'center',title: '账户余额', sort:true,width: 110},
                {field: 'freeze_balance',align: 'center',title: '交易/差额',width: 96,templet: function(d){
                        return d.freeze_balance + '<hr class="mr5" />' + (d.frozen  ? d.frozen : '-');
                    }},
                {field: 'is_task',align: 'center', title: '抢单开关', width: 100,toolbar: '#task'},
                {field: 'task_num',align: 'center',title: '任务数', width: 90,templet: function(d){
                        return '<b style="font-size: 16px">'+ d.task_done + '/' + d.task_num  +'</b><hr class="mr5" />' +  d.task_rate + '%' ;
                    }},
                {
                    title: "充值/提现", align: "center", field: "in_balance", width:90,
                    templet: function (d) {
                        return (d.in_balance === 0 ?  '-' : d.in_balance) +'<hr class="mr5" />' + (d.out_balance === 0 ?  '-' : d.out_balance) ;
                    }
                },    
                {field: 'trade',align: 'center',title: '赠金/收益',sort:true, width: 110,templet: function(d){
                        return  d.give_balance +'<hr class="mr5" />'+  d.trade_profit;
                    }},
                {field: 'invite',align: 'left',title: '分享收益', sort:true,width: 110,templet: function(d){
                        var str = '<span class="layui-badge-rim">总</span>' + d.trade_invite_balance +'<hr class="mr5" />';
                        str += '<span class="layui-badge-rim">提</span>' + d.trade_invite_receive +'<hr class="mr5" />';
                        str += '<span class="layui-badge-rim">剩</span>' + d.trade_invite_remainder ;
                        return  str;
                    }},
                {field: 'is_ip_repeat',align: 'center',event:"see",title: '备注',templet: function(d){
                        return (d.remark ? '<span class="blue">'+ d.remark + '</span>' : '') +  (d.is_ip_repeat === 1 ? '<hr class="mr5" /><span class="layui-badge-rim">IP</span>' : '')   +  (d.is_guid_repeat === 1 ? '<hr class="mr5" /><span class="layui-badge-rim">设备</span>' : '无') ;
                }},
                {field: 'is_top',align: 'center', title: '置顶', width: 88,toolbar: '#is_top'},
            ]]
            ,defaultToolbar: ['filter', 'exports', 'print']
            ,done: function (res, curr, count) {
                $("#reprot_total").html('');
                if (res.attach) {
                    var html = '<span class="layui-btn layui-btn-primary layui-btn-sm">用户总数:<b class="color-red">'+ res.attach.total +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">账户总额:<b class="color-red">'+ res.attach.total_balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">可用账户:<b class="color-red">'+ res.attach.balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">交易账户:<b class="color-red">'+ res.attach.freeze_balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">体验金:<b class="color-red">'+ res.attach.frozen_balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">个人收益:<b class="color-red">'+ res.attach.trade_profit +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">个人奖金:<b class="color-red">'+ res.attach.trade_bonus +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">分享收益:<b class="color-red">'+ res.attach.trade_invite_balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">分享领取:<b class="color-red">'+ res.attach.trade_invite_remainder +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">分享剩余:<b class="color-red">'+ res.attach.trade_invite_remainder +'</b></span>' +
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">充值:<b class="color-red">'+ res.attach.in_balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">提现:<b class="color-red">'+ res.attach.out_balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">赠金:<b class="color-red">'+ res.attach.give_balance +'</b></span>'+
                        '<span class="layui-btn layui-btn-primary layui-btn-sm">利润:<b class="color-red">'+ res.attach.diff_balance +'</b></span>';
                    $("#reprot_total").html(html);
                }
            }
        });

        table.on("tool(table_list)", function (obj) {
            var data = obj.data,that = this;
            if (obj.event === 'more') {
                dropdown.render({
                    elem: that
                    ,show: true
                    ,data: [
                        {title: '派单管理',id: 'pai'},
                        {title: '用户设置',id: 'edit'},
                        {title: '公告设置',id: 'notice'},
                        {title: '可用账户',id: 'balance'},
                        {title: '交易账户',id: 'freeze_balance'},
                        {title: '解绑谷歌',id: 'unbind'},
                        {title: '删除用户',id: 'del'}]
                    ,click: function(res){

                        if (res.id === 'balance'){
                            let value = data.id;
                            layer.open({
                                type: 2,
                                title: "可用账户：" + value,
                                shade: 0.1,
                                maxmin: true,
                                area: [is_mobile() ? "100%" : "750px", is_mobile() ? "100%" : "600px"],
                                content: ACCOUNT_API + "?acType=0&id=" + value,
                                end:function(){
                                    table.reload('table_list',{});
                                }
                            });
                        }  else if (res.id === 'frozen_balance') {
                            let value = data.id;
                            layer.open({
                                type: 2,
                                title: "体验金：" + value,
                                shade: 0.1,
                                maxmin: true,
                                area: [is_mobile() ? "100%" : "750px", is_mobile() ? "100%" : "600px"],
                                content: ACCOUNT_API + "?acType=1&id=" + value,
                                end:function(){
                                    table.reload('table_list',{});
                                }
                            });
                        }  else if (res.id === 'freeze_balance')  {
                            let value = data.id;
                            layer.open({
                                type: 2,
                                title: "交易账户：" + value,
                                shade: 0.1,
                                maxmin: true,
                                area: [is_mobile() ? "100%" : "750px", is_mobile() ? "100%" : "600px"],
                                content: ACCOUNT_API + "?acType=2&id=" + value,
                                end:function(){
                                    table.reload('table_list',{});
                                }
                            });
                        }  else if (res.id === 'pai')   {
                            let value = data.id;
                            layer.open({
                                type: 2,
                                title: "派单管理：" + value,
                                shade: 0.1,
                                maxmin: true,
                                area: [is_mobile() ? "100%" : "750px", is_mobile() ? "100%" : "600px"],
                                content: "<?php echo url('agent/sys.pai/index'); ?>?id=" + value,
                            });
                        }  else if (res.id === 'notice')  {
                            let value = data.id;
                            layer.open({
                                type: 2,
                                title: "公告管理：" + value,
                                shade: 0.1,
                                maxmin: true,
                                area: [is_mobile() ? "100%" : "550px", is_mobile() ? "100%" : "500px"],
                                content: "<?php echo url('agent/sys.notice/save'); ?>?uid=" + value,
                            });
                        }  else if (res.id === 'edit')  {
                            let value = data.id;
                            layer.open({
                                type: 2,
                                title: "编辑用户",
                                shade: 0.1,
                                maxmin: true,
                                area: [is_mobile() ? "100%" : "750px", is_mobile() ? "100%" : "600px"],
                                content: "<?php echo url('edit'); ?>?id=" + value,
                                end:function () {
                                    table.reload('table_list',{});
                                }
                            });
                        }  else if (res.id === 'unbind') {
                            layer.confirm('确定要执行吗', function(){
                                $.ajax({
                                    url: "<?php echo url('setField'); ?>",
                                    async: false,
                                    type: "POST",
                                    data: {'val': 0, 'field': 'is_bind', 'id': data.id},
                                    dataType: 'json',
                                    success: function (res) {
                                        layer.msg(res.msg);
                                        if (res.code === 1) {
                                            table.reload('table_list', {});
                                        }
                                    }
                                })
                            });
                        } else if (res.id === 'del')  {
                            layer.confirm('<b class=\"color-red\">此操作将删除会员相关的所有数据！！！确认删除吗?</b>', function(){
                                $.ajax({
                                    url:"<?php echo url('delete'); ?>",
                                    async: false,
                                    type: "POST",
                                    data:{'id':data.id},
                                    dataType:'json',
                                    success: function(data){
                                        layer.msg(data.msg);
                                        if(data.code === 1){
                                            table.reload('table_list',{});
                                        }
                                    }
                                })
                            });
                        }
                    }
                    ,align: 'right'
                    ,style: 'box-shadow: 1px 1px 10px rgb(0 0 0 / 12%);'
                });
            }
            else if (obj.event === "see")
            {
                layer.open({
                    title:"查看设备标识:" + data.id,
                    content : data.guid,
                });
            }
            else if (obj.event === 'viewReport') {
               layer.open({
                    type: 2,
                    title :'查看下级用户：' + data.id,
                    content: "<?php echo url('xj'); ?>?is_first=1&pid=" + data.id,
                    area: ['90%', '80%'],
                    shadeClose: true,
                    shade: 0.8,
                });
            }
        });

        //头工具栏事件
        table.on('toolbar(table_list)', function(obj){
            // 新增
            if(obj.event === 'add'){
                layer.open({
                    type:2,
                    title:'新增',
                    area: [is_mobile() ? "100%" : "750px", is_mobile() ? "100%" : "600px"],
                    maxmin:true,
                    shadeClose: true, //开启遮罩关闭
                    content:"<?php echo url('add'); ?>",
                    end:function () {
                        table.reload('table_list',{});
                    }
                });
                return false;
            }
            return false;
        });
        //搜索
        form.on('submit(search_btn)', function(data){
            data.field.search=1;
            table.reload('table_list',{
                where: data.field
            });
            return false;
        });

        form.on('switch(task)', function(obj){
            let is_task = obj.elem.checked===true?1:0;
            let ck = obj.elem.checked;
            let id = this.value;
            layer.confirm(ck ? '确定开启抢单？' : '<b class="red">确认关闭抢单吗?</b>', {
                btn1: function (index) {
                    layer.close(index);
                    let loading = layer.load(1, {shade: [0.1, '#fff']});
                    $.ajax({
                        url: "<?php echo url('ontask'); ?>",
                        data: {'val': is_task, 'field': 'is_task', 'id': id},
                        async: false,
                        type: "POST",
                        dataType: 'json',
                        success: function (result) {
                            layer.close(loading);
                            //if (result.code) {
                            //    return layui.popup.failure(result.msg);
                            //}
                            layer.msg("操作成功");
                            refreshTable();
                        },
                        error: function () {
                            layer.close(loading);
                            layer.msg('请求失败', {time: 2000, icon: 2});
                        }
                    });
                },
                btn2: function () {
                    obj.elem.checked = !ck;
                    form.render('checkbox');
                },
                cancel: function () {
                    obj.elem.checked = !ck;
                    form.render('checkbox');
                }
            })
        });
        form.on('switch(is_top)', function(obj){
            let is_top = obj.elem.checked===true?1:0;
            let id = this.value;
            let loading = layer.load(1, {shade: [0.1, '#fff']});
            $.ajax({
                url: "<?php echo url('setField'); ?>",
                data: {'val': is_top, 'field': 'is_top', 'id': id},
                type: 'POST',
                dataType: 'json',
                success: function (result) {
                    layer.close(loading);
                    //if (result.code) {
                    //    return layui.popup.failure(result.msg);
                    //}
                    layer.msg("操作成功");
                    refreshTable();
                },
                error: function () {
                    layer.close(loading);
                    layer.msg('请求失败', {time: 2000, icon: 2});
                }
            });
        });

        // 刷新表格数据
        window.refreshTable = function (param) {
            table.reloadData("table_list", {
                scrollPos: "fixed"
            });
        }
    });
</script>
</body>
</html>