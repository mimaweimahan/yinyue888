<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{__STATIC__}extend/express-detail.css">
    <title>物流详情</title>
    <style>
        .mcn .cp-info .cp-info_thumb{ position: relative; z-index: 20; display: block; border-radius: 5px; }
        .cp-info_thumb img{ border-radius: 5px;}
    </style>
</head>
<body class="mcn">
<div class="container">
    {if isset($express['cpLogUrl'])}
    <div class="cp-info physical-border">
        {if $express['cpLogUrl']}
        <a href="{$express['webUrl']}" class="cp-info_thumb"><img width="70" src="{$express['cpLogUrl']}" /></a>
        {/if}
        <div class="cp-info_detail">
            {if isset($packageStatus['newStatusDesc'])}
            <div class="package-status">{$packageStatus['newStatusDesc']}</div>
            {else/}
            <div class="package-status">查询无结果</div>
            {/if}
            <div class="cp-info_name">{$express['tpName']}：<a href="javascript:void(0);">{$mailNo}</a></div>
            {if isset($express['tpContact']) && $express['tpContact'] }
            <div class="cp-info_tel">
                官方电话：<a href="tel:{$express['tpContact']}">{$express['tpContact']}</a>
            </div>
            {/if}
        </div>
    </div>
    {/if}

    <div class="feed-container">
        {if $data}
        <ul class="feed">
            {volist name="data" id="r"}
            <li class="feed-item">
                <div class="feed-item_datetime">
                    <div class="feed-item_time">{$r['time']}</div>
                    <div class="feed-item_date">{$r['date']}</div>
                </div>
                {if $r['status'] == 'AGENT_SIGN' || $r['status'] == 'SIGN' }
                <div class="feed-item_icon">
                    <img class="big" src="{$r['statusIcon']}" />
                </div>
                {else/}
                <div class="feed-item_icon">
                    <img src="{$r['sectionIcon']}" />
                </div>
                {/if}
                <div class="feed-item_content">{$r['standerdDesc']}</div>
            </li>
            {/volist}
        </ul>
        {else/}
        <div class="feed-empty" >
            <div class="feed-empty_text">暂无物流信息</div>
            <img src="//gw.alicdn.com/tps/TB1ZW2KNXXXXXXqXXXXXXXXXXXX-398-370.png" width="100" />
        </div>
        {/if}
    </div>
    <div class="loading" style="display: none;"></div>
</div>
</body>
</html>