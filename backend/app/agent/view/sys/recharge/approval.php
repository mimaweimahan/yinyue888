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
    <title>充值审批</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post">
        <!--
        <div class="form-item">
            <label for="mark" class="form-label">付款截图</label>
            <div class="input-block layer-photos">
                <img data-src="{$att}" width="100" height="100" class="picView" src="{$att}">
            </div>
        </div>
        <div class="form-item">
            <label for="txid" class="form-label">交易哈希</label>
            <div class="input-block">
                <input type="text" id="txid" value="{$txid}" readonly placeholder=" 交易哈希 " autocomplete="off" class="layui-input" />
            </div>
        </div>
        -->
        <div class="form-item">
            <label for="status" class="form-label">审批结果</label>
            <div class="input-inline">
                <div style="width: 180px">
                    <select name="status" id="status" class="layui-select">
                        <option value="1" {if $status == 1} selected {/if}>审批通过并给用户上分</option>
                        <option value="2" {if $status == 2} selected {/if}>充值无效</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-item">
            <label for="mark" class="form-label">审批说明</label>
            <div class="input-inline"> <textarea class="layui-textarea">{$remark}</textarea> </div>
        </div>
    </form>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer;

        $('.picView').on('click',function () {
            let src = $(this).data('src');
            parent.layer.open({
                type:1,
                title:'充值截图',
                maxmin:true,
                area: ['650px', '650px'],
                content: '<img src='+src+' width="100%" />'
            });
        })
        $('#bak-btn').on('click',function () {
            layer.closeAll();
        });
    });
</script>
</body>
</html>
