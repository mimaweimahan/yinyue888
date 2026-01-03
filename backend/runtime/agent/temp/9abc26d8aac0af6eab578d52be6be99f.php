<?php /*a:1:{s:60:"/www/wwwroot/tisktshop.com/app/agent/view/index/withdraw.php";i:1758028068;}*/ ?>
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
    <title>申请提现</title>
    <link rel="stylesheet" href="/statics/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/statics/admin/common.css?v=<?php echo css_version(); ?>">
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>申请提现</em></div>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <div class="layui-card-body" style="padding: 15px;">
                <blockquote class="layui-elem-quote" style="font-size: 14px;">
                    <p>最低提现：<b class="red"><?php echo getConfig('agent_min_tx'); ?></b> USDT,提现手续费：<b class="red"><?php echo getConfig('agent_tx_rate'); ?></b> USDT。</p>
                </blockquote>
                <fieldset>
                    <legend>可用余额：<b class="red" style="font-size: 18px"><?php echo html_entities($balance); ?></b> USDT</legend>
                    <form class="layui-form layui-form-pane form-search" autocomplete="off">
                        <div class="layui-form-item ">
                            <label class="layui-form-label">提现地址</label>
                            <label class="layui-input-inline" style="width: 60%;">
                                <input type="text" name="address" value="<?php echo html_entities($withdrawal_address); ?>" lay-verify="required" placeholder="请先绑定提现地址" disabled class="layui-input"/>
                            </label>
                        </div>
                        <div class="layui-form-item ">
                            <label class="layui-form-label">提现数量</label>
                            <label class="layui-input-inline">
                                <input type="number" name="balance" value="0.00" lay-verify="number"  placeholder="请输入提现金额" class="layui-input" />
                            </label>
                        </div>
                        <div class="layui-form-item layui-inline">
                            <label class="layui-form-label">谷歌验证码</label>
                            <label class="layui-input-inline">
                                <input type="password" name="google_auth" lay-verify="required" placeholder="请输入谷歌验证码" class="layui-input" />
                            </label>
                        </div>
                        <div class="layui-form-item layui-inline">
                            <button class="layui-btn layui-btn-primary" lay-submit lay-filter="formRefund">提交申请</button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <!--#+++++++++++++++++++++++++++#-->
            <div class="layui-card-body">
                <fieldset>
                    <legend>条件搜索</legend>
                    <form class="layui-form layui-form-pane searchForm" lay-filter="table-search"  autocomplete="off">
                        <div class="layui-form-item layui-inline input-line">
                            <label class="layui-form-label">提现时间</label>
                            <label class="layui-input-inline">
                               <div style="width: 180px;display: flex; align-items: center;">
                                   <input type="text" autocomplete="off" name="start_time" id="start_time" class="layui-input inline-block" placeholder="开始时间">
                                   <span>-</span>
                                   <input type="text" autocomplete="off" name="end_time" id="end_time" class="layui-input inline-block" placeholder="结束时间">
                               </div>
                            </label>
                        </div>
                        <div class="layui-form-item layui-inline input-line">
                            <label class="layui-form-label">提现地址</label>
                            <label class="layui-input-inline">
                                <input type="text" name="address" value="" autocomplete="off" class="layui-input">
                            </label>
                        </div>
                        <div class="layui-form-item layui-inline input-line">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                <select name="status" id="status" class="layui-select">
                                    <option value="">请选择</option>
                                    <option value="1">待审核</option>
                                    <option value="2">已支付</option>
                                    <option value="3">已取消</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item layui-inline input-line">
                            <button class="layui-btn layui-btn-md layui-btn-primary" lay-submit lay-filter="search_btn"><i class="layui-icon layui-icon-search"></i> 搜索
                            </button>
                            <button type="reset" class="layui-btn layui-btn-md" lay-submit lay-filter="table-reset">
                                <i class="layui-icon layui-icon-refresh"></i>重置
                            </button>
                        </div>
                    </form>
                </fieldset>
                <table class="layui-table" id="table_list" lay-filter="table_list"></table>
            </div>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="table-bar">
    <a class="layui-btn layui-btn-xs" lay-event="del">删除</a>
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
    function is_mobile(){
        return window.screen.width <= 768;
    }
    layui.config({
        version:1.0,
        base: '/statics/layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form','laydate'], function(){
        var $ = layui.jquery,
            table   = layui.table,
            layer   = layui.layer,
            laydate = layui.laydate,
            form    = layui.form;

        laydate.render({
            elem: '#start_time'
        });
        laydate.render({
            elem: '#end_time'
        });
        // 表头参数
        let cols = [
            {title: "序号", align: "center", field: "id", width: 80},
            {title: "创建时间", align: "center", field: "created_at", width: 160},
            {title: "订单号", align: "center", field: "order_sn", width: 180},
            {title: "提现地址", align: "center", field: "address",},
            {title: "提现金额", align: "center", field: "balance", width: 120},
            {title: "手续费", align: "center", field: "fee", width: 120},
            {title: "备注", align: "center", field: "mark",},
            {
                title: "状态", align: "center", field: "status", width: 120,
                templet: function (d) {
                    switch (d.status) {
                        case 0:
                            return '<span>待审核</span>';
                        case 1:
                            return '<span class="color-blue">已支付</span>';
                        case -1:
                            return '<span class="color-red">已取消</span>';

                    }
                }
            },
            {title: "支付时间", align: "center", field: "paid_at", width: 160}
        ];

        // 渲染表格
        table.render({
            elem: "#table_list",
            url: "<?php echo html_entities($url); ?>",
            page: true,
            cols: [cols],
            method:"POST",
            autoSort: false,
            defaultToolbar: [{
                title: "刷新",
                layEvent: "refresh",
                icon: "layui-icon-refresh",
            }, "filter", "print", "exports"],
            parseData: function(res){
                $("#all_total").text(res.attach.all_total);
                $("#all_balance").text(res.attach.all_balance);
                return {
                    "code": res.code, //解析接口状态
                    "count": res.count, //解析数据长度
                    "data": res.data //解析数据列表
                };
            }
        });

        // 编辑或删除行事件
        table.on("tool(table_list)", function (obj) {
            if (obj.event === "check") {
                let value = 1
                layer.open({
                    type: 2,
                    title: "审核",
                    shade: 0.1,
                    maxmin: true,
                    area: [is_mobile() ? "100%" : "750px", is_mobile() ? "100%" : "600px"],
                    content: ''
                });
            }
        });

        // 表格顶部搜索事件
        form.on("submit(table_list)", function (data) {
            table.reload("table_list", {page: {curr: 1}, where: data.field})
            return false;
        });
        //表格顶部搜索重置事件
        form.on("submit(table_list)", function (data) {
            table.reload("table_list", {where: []})
        });

        // 刷新表格数据
        window.refreshTable = function (param) {
            table.reloadData("table_list", {
                scrollPos: "fixed"
            });
        }
        form.on('submit(formRefund)', function (data) {
            $.ajax({
                url: "<?php echo url('withdraw'); ?>",
                type: 'POST',
                data: data.field,
                dataType: 'json',
                success: function (res) {
                    layer.msg(res.msg);
                    if(res.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                },
            });
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