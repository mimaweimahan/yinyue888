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
    <div class="recommend public-box">
        <div class="head">
            <i class="iconfont icon color-red icon-tj"></i>
            <h3>相关推荐</h3>
            <a href="javascript:void(0);"><i class="iconfont icon-shuaxin"></i> 换一批</a>
        </div>
        <ul class="list-pic-card flex_img">
            {Cms:get table="article" where="['status'=>1,'is_page'=>0]" order="create_time desc" limit="4"}
            <li>
                <aside>
                    <a href="{$r['url']}">
                        <img class="lazy" src="{__STATIC__}skin/loading.png" data-original="{:thumb($r['thumb'],320,180)}" alt="{$r['title']}">
                        {if $r['video']}
                        <div class="big-video"><i></i></div>
                        {/if}
                        {if $r['video_time']}
                        <div class="mini-video"><i class="iconfont icon-shipin"></i><span>{$r['video_time']}</span></div>
                        {/if}
                    </a>
                </aside>
                <h3><a href="{$r['url']}">{$r['title']}</a></h3>
                <dl>
                    <dt><i class="iconfont icon-jilu"></i> {:date('m-d',$r['create_time'])}</dt>
                    <dd><i class="iconfont icon-see"></i> {:numFormat($r['views'])}</dd>
                </dl>
            </li>
            {/Cms:get}
        </ul>
    </div>
    <div class="public-box new-list">
        <div class="head">
            <i class="iconfont icon color-red icon-hot"></i>
            <h3>最新推荐</h3>
            <a href="javascript:void(0);"></a>
        </div>
        <ul class="list-pic-box">
            {Cms:get table="article" where="['status'=>1,'is_page'=>0]" order="create_time desc" limit="4"}
            <li>
                <div class="img">
                    <a href="{$r['url']}">
                        <img class="lazy" src="/static/skin/loading.png" data-original="{:thumb($r['thumb'],500,300)}" alt="{$r['title']}" />
                        {if !empty($r['video']) }
                        <div class="big-video"><i></i></div>
                        {/if}
                    </a>
                </div>
                <div class="text">
                    <h2><a href="{$r['url']}">{$r['title']}</a></h2>
                    <aside><a href="{$r['url']}">{$r['description']}</a></aside>
                    <dl>
                        <dt><i class="iconfont icon-jilu"></i> {:date('m-d',$r['create_time'])}</dt>
                        <dd><i class="iconfont icon-see"></i> {:numFormat($r['views'])}</dd>
                    </dl>
                </div>
            </li>
            {/Cms:get}
        </ul>
    </div>
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