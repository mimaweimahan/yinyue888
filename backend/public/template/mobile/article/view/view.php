<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="{$keywords}"/>
    <meta name="description" content="{$description|raw}"/>
    <title>{$title}</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="{__FONT_URL__}">
    <link rel="stylesheet" href="{__STATIC__}skin/mobile.css?={:cms_version();}">
    <link rel="stylesheet" href="{__STATIC__}skin/mobile_view.css?={:cms_version();}">
    <link rel="canonical" href="{:getConfig('config_app_url')}{$url}"/>
    {if !empty($video) }
    <style>
        .video-fixed header{ background:transparent;}
        .video-fixed .header-bar aside .iconfont{display: none}
        .video-fixed .video-fixed-box{ position: fixed; z-index: 1;width: 100%;top: 0;left: 0;}
    </style>
    {/if}
</head>
<body class="{$video?'video-fixed':''}">
{include file="./template/mobile/article/header.php" /}
{if !empty($video) }
<div class="video-fixed-box">
    <div class="video-box"><video src="{$video}" poster="{$thumb}" controls="controls"></video></div>
</div>
{/if}
<div class="page-container">
    <article>
        <h1 class="article-title">{$title}</h1>
        <dl class="article-sub">
            <dd><i class="iconfont icon-jilu"></i> {:date('m-d',strtotime($create_time))}</dd>
            <dd><i class="iconfont icon-see"></i> 阅读 <span id="view-hits"> {:numFormat($views)}</span> </dd>
            <dd><i class="iconfont icon-hezuo"></i> 作者：{$author}</dd>
        </dl>
        <div class="description"><em>概述</em> {$description|raw}</div>
        {if $files_list}
        <ul class="extend">
            {volist name="files_list" id="r"}
            {if isset($extend[$r['field']]) && $extend[$r['field']] }
            <li><span>{$r['name']}：</span><span>{$extend[$r['field']]}</span></li>
            {/if}
            {/volist}
        </ul>
        {/if}
        <div class="content">
            {$content|raw}
        </div>
    </article>
</div>
{include file="./template/mobile/article/footer.php" /}
{if !empty($video) }
<script type="text/javascript">
   $(function (){
       var video = $('.video-fixed-box').height();
       $('.page-container').css({'margin-top':(video-50)+'px'});
   });
</script>
{/if}
<script type="text/javascript">
    $(function () {
        $.get("{:url('article/hits/index',['id'=>$id])}", function (data) {
            $("#hits").html(data.views);
        }, "json");
        /*等比例缩放图片*/
        window.onload = function () {
            $(".content img").each(function () {
                if ($(this).width() > 820) {
                    $(this).css({"width": "100%", "height": "auto"});
                }
            })
        };
    })
</script>
</body>
</html>