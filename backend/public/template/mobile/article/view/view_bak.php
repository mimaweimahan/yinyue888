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
        {if $files_list}
        <ul class="extend">
            {volist name="files_list" id="r"}
            {if isset($extend[$r['field']]) && $extend[$r['field']] }
            <li><span>{$r['name']}：</span><span>{$extend[$r['field']]}</span></li>
            {/if}
            {/volist}
        </ul>
        {/if}
        <div class="description"><em>最佳答案</em> {$description|raw}</div>
        <div class="content">
            {$content|raw}
        </div>
        <div class="tips">
            声明：楚天网所有作品（图文、音视频）均由用户自行上传分享，仅供网友学习交流。若您的权利被侵害，请联系 office@ct10000.com
        </div>
    </article>
    <ul class="last-next">
        <li><span>上一篇</span> {if $last_article} <a href="{$last_article['url']}">{$last_article['title']}</a> {else/} <a>没有了</a>{/if}</li>
        <li><span>下一篇</span> {if $next_article} <a href="{$next_article['url']}">{$next_article['title']}</a> {else/} 没有了 {/if}</li>
    </ul>
    <div class="recommend public-box">
        <div class="head">
            <i class="iconfont icon color-red icon-hot"></i>
            <h3>猜你喜欢</h3>
            <a href="javascript:void(0);"><i class="iconfont icon-shuaxin"></i> 换一批</a>
        </div>
        <ul class="list-pic-card flex_img">
            {Cms:get table="article" where="['status'=>1,'is_page'=>0]" order="create_time desc" limit="6"}
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