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
    <title>详情</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        .public-title-box{
            border-bottom: 1px dashed #eee;
            height: 40px;
            line-height: 40px;
        }
        .shop-info{ border-bottom: 1px #eee solid;}
        .shop-info dl dt{ height: 50px; line-height: 50px; font-weight: bold;}
        .shop-info dl{ line-height:35px;}
        .shop-info dl dd span{ font-weight: bold; color: #666;}
        span.price{ font-weight: bold; color:#dd1144!important;}
    </style>
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>用户管理</em></div>
        <ul class="panel-tab">
            <li><a href="{:url('admin/user.index/index')}">用户列表</a></li>
            <li class="layui-this"><a>用户详情</a></li>
            <li><a href="javascript:history.back();">返回</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <!--#+++++++++++++++++++++++++++#-->
        <div class="layui-row layui-col-space10 shop-info">
            <h3 class="public-title-box">基本信息</h3>
            <div class="layui-col-md4">
                <dl>
                    <dd><span>用户名称：</span>{$nickname}</dd>
                    <dd><span>用户账号：</span>{$account}</dd>
                    <dd><span>用户手机：</span>{$mobile}</dd>
                    <dd>
                        <span>账号状态：</span>
                        {if $status == 1}
                        <span class="layui-badge layui-bg-green">开启</span>
                        {else/}
                        <span class="layui-badge layui-bg-red">关闭</span>
                        {/if}
                    </dd>
                </dl>
            </div>
            <div class="layui-col-md4">
                <dl>
                    <dd><span>会员编号：</span> {$user_number}</dd>
                    <dd><span>登陆次数：</span> {$login} 次</dd>
                    <dd><span>最后登陆：</span> {:date('Y-m-d H:i:s',$last_login_time)}</dd>
                    <dd><span>最后登陆IP：</span> {$last_login_ip}</dd>
                </dl>
            </div>
            <div class="layui-col-md4">
                <dl>
                    <dd>
                        <span>余额：</span>
                        <span class="price">{$amount}</span>
                    </dd>
                    <dd><span>积分：</span>{$integral}</dd>
                    <dd style="display: none"><span>虚拟币：</span>{$bi} 元</dd>
                </dl>
            </div>
        </div>
        <!--#+++++++++++++++++++++++++++#-->
        <br />
        <div class="layui-row">
            <h3 class="public-title-box">账户明细</h3>
            <!--#+++++++++++++++++++++++++++#-->
            <form class="layui-form">
                <table class="layui-hide" id="table_list" lay-filter="table_list"></table>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script type="text/html" id="type_panel">
    {{ d.type_name }}
</script>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','table','jquery'], function(){
        var table = layui.table;
        var $ = layui.jquery;
        //执行一个 table 实例
        var w_height = $(window).height();
        var table_h = 480;
        if(w_height>800){
            table_h = w_height-200;
        }
        table.render({
            elem:'#table_list'
            ,height: table_h
            ,url: '{$url}' //数据接口
            ,title: '数据列表'
            ,limit:"{$limit}"
            ,page: true //开启分页
            ,cols: [[ //表头
                {field: 'type', title: '记录类型', width:100, toolbar: '#type_panel'}
                ,{field: 'integral', title: '积分', width:120}
                ,{field: 'amount', title: '余额', width:120}
                ,{field: 'bi', title: '虚拟币', width:120}
                ,{field: 'note', title: '记录说明', minWidth:220}
                ,{field: 'order_number', title:'单号', width:180}
                ,{field: 'admin_name', title: '操作人',  width:120}
                ,{field: 'add_time', title: '记录时间', width:200, sort: true}
            ]]
        });
    });
</script>
</body>
</html>