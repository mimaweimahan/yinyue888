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
    <title>管理面板</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        .portal-block-container {
            font-size: 14px;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .think-box-shadow {
            border: 1px solid #ebebeb;
            border-radius: 5px;
            padding: 20px 0;
        }
        .notselect {
            user-select: none;
            -ms-user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
            margin: 0 10px;
        }
        .portal-block-container .portal-block-item {
            color: #fff;
            padding: 15px 25px;
            position: relative;
            line-height: 3em;
            border-radius: 5px;
            box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);
        }
        .portal-block-container .portal-block-item>div:nth-child(2) {
            font-size: 46px;
            line-height: 46px;
        }
        .portal-block-container .portal-block-icon {
            top: 45%;
            right: 8%;
            font-size: 65px;
            position: absolute;
            color: rgba(255,255,255,.4);
        }

        .portal-block-container {
            font-size: 14px;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        .portal-block-container .portal-block-item {
            color: #fff;
            padding: 15px 25px;
            position: relative;
            line-height: 3em;
            border-radius: 5px;
            box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);
        }
        .portal-block-container .portal-block-item>div:nth-child(2) {
            font-size: 46px;
            line-height: 46px;
        }
        .portal-block-container .portal-block-icon {
            top: 45%;
            right: 8%;
            font-size: 65px;
            position: absolute;
            color: rgba(255,255,255,.4);
        }
    </style>
</head>
<body class="body-main-p">
<div class="layui-tab panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>平台首页</em>用于展示当前系统中的统计数据、统计报表及重要实时数据</div>
        <ul class="layui-tab-title">
            <li class="layui-this">控制台</li>
        </ul>
    </div>
    <div class="layui-tab-content panel-body">
        <div class="layui-tab-item layui-show">
            <!--#+++++++++++++++++++++++++++#-->
            <div class="think-box-shadow portal-block-container notselect" style="padding:10px;border: 0">
                <div class="layui-row layui-col-space15" >
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background:linear-gradient(-125deg,#57bdbf,#2f9de2)">
                            <div>在线用户</div>
                            <div>{$online_user_num}</div>
                            <div>当前在线用户数</div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-fire"></i>
                    </div>
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background: linear-gradient(-125deg,#ff8f7d,#fb522c);">
                            <div>注册用户</div>
                            <div>{$new_user_num}</div>
                            <div>今日新注册用户数</div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-diamond"></i>
                    </div>
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background: linear-gradient(-113deg,#91d843,#739277);">
                            <div>任务人数</div>
                            <div>{$task_user_num}</div>
                            <div>正在执行任务总数</div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-chart"></i>
                    </div>

                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background: linear-gradient(-141deg,#3b7ef9,#b32121);">
                            <div>今日首冲</div>
                            <div>{$sc_amount}</div>
                            <div>首冲人数：<span>{$sc_user_num}</span></div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-dollar"></i>
                    </div>

                </div>
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background:linear-gradient(-141deg,#ecca1b,#f39526)">
                            <div>充值总额</div>
                            <div>{$recharge_amount}</div>
                            <div>充值人数：<span>{$recharge_num}</span></div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-dollar"></i>
                    </div>

                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background: linear-gradient(-125deg,#57bdbf,#2fe2b9);">
                            <div>提现总额</div>
                            <div>{$withdrawal_amount}</div>
                            <div>提现人数：<span>{$withdrawal_num}</span></div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-fire"></i>
                    </div>
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background:linear-gradient(-125deg,#ff7d7d,#fb2c95)">
                            <div>赠送总额</div>
                            <div>0</div>
                            <div>赠送人数:<span>0</span></div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-diamond"></i>
                    </div>
                    <div class="layui-col-sm6 layui-col-md3">
                        <div class="portal-block-item nowrap" style="background:linear-gradient(-113deg,#c543d8,#925cc3)">
                            <div>今日盈亏</div>
                            <div>{$day_yk}</div>
                            <div><span>今日充提差</span></div>
                        </div>
                        <i class="portal-block-icon layui-icon layui-icon-chart"></i>
                    </div>
                </div>
                <!--#--------#-->
                <div class="layui-row layui-col-space15 margin-top-10">
                    <div class="layui-col-xs12 layui-col-md6">
                        <div class="think-box-shadow">
                            <div id="main2" style="width:100%;height:350px"></div>
                        </div>
                    </div>
                    <div class="layui-col-xs12 layui-col-md6">
                        <div class="think-box-shadow">
                            <div id="main3" style="width:100%;height:350px; padding: 0 10px;"></div>
                        </div>
                    </div>
                </div>
                <label class="layui-hide">
                    <textarea id="jsondata1">{$charts_data}</textarea>
                </label>

            </div>
            <!--#+++++++++++++++++++++++++++#-->

        </div>
    </div>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript" src="{__STATIC__}/extend/require.js"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['layer','jquery','element'], function(){
        let $ = layui.jquery, layer = layui.layer;
        require(['{__STATIC__}/extend/echarts.min.js'], function (echarts) {

            var data1 = JSON.parse($('#jsondata1').html());
            var days = data1.map(function (item) {
                return item['当天日期'];
            });
            (function (charts) {
                window.addEventListener("resize", function () {
                    charts.resize()
                });
                charts.setOption({
                    title: [{left: 'center', text: '新增会员'}],
                    tooltip: {trigger: 'axis', show: true, axisPointer: {type: 'cross', label: {}}},
                    xAxis: [{data: days, gridIndex: 0}],
                    yAxis: [
                        {
                            splitLine: {show: true}, gridIndex: 0, type: 'value', axisLabel: {
                                formatter: '{value} 个'
                            }
                        }
                    ],
                    grid: [{left: '10%', right: '3%', top: '25%'}],
                    series: [
                        {
                            smooth: true, showBackground: true,
                            areaStyle: {color: 'rgba(180, 180, 180, 0.5)'},
                            type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                            label: {normal: {position: 'top', formatter: '{c} 条', show: true}},
                            data: data1.map(function (item) {
                                return item['数量'];
                            }),
                        }
                    ]
                });
            })(echarts.init(document.getElementById('main2')));

            (function (charts) {
                window.addEventListener("resize", function () {
                    charts.resize()
                });
                charts.setOption({
                    title: [{left: 'center', text: '充值/提现'}],
                    tooltip: {trigger: 'axis', show: true, axisPointer: {type: 'cross', label: {}}},
                    legend: {
                        data: ['充值', '提现']
                    },
                    xAxis: [{data: days, gridIndex: 0}],
                    yAxis: [
                        {
                            splitLine: {show: true}, gridIndex: 0, type: 'value', axisLabel: {
                                formatter: '${value}'
                            }
                        }
                    ],
                    grid: [{left: '10%', right: '3%', top: '25%'}],
                    series: [
                        {
                            smooth: true, showBackground: false,
                            type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                            label: {normal: {position: 'top', formatter: '$ {c}', show: true}},
                            data: data1.map(function (item) {
                                return item['充值'];
                            }),
                        },
                        {
                            smooth: true, showBackground: true,
                            type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                            label: {normal: {position: 'top', formatter: '$ {c}', show: true}},
                            data: data1.map(function (item) {
                                return item['提现'];
                            }),
                        }
                    ]
                });
            })(echarts.init(document.getElementById('main3')));
        });
    });
</script>
</body>
</html>
