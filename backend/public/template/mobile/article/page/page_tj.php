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
    <meta name="keywords" content="{$seo['keywords']}" />
    <meta name="description" content="{$seo['description']}" />
    <title>{$title}</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="{__FONT_URL__}">
    <link rel="stylesheet" href="{__STATIC__}skin/mobile.css?={:cms_version();}">
    <link rel="stylesheet" href="{__STATIC__}skin/mobile_view.css?={:cms_version();}">
    <link rel="canonical" href="{:getConfig('config_app_url')}{$url}"/>
    <style>
        .recommend{ margin-top: 5px;}
    </style>
</head>
<body class="{$video?'video-fixed':''}">
{include file="./template/mobile/article/header.php" /}
<div class="page-container">
    <div style="height: 50px"></div>
    <article>
        <div class="content">
            {$content|raw}
        </div>
    </article>

    <div class="recommend public-box">
        <div class="head">
            <i class="iconfont icon color-red icon-tj""></i>
            <h3>相关推荐</h3>
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
                    <!--
                    <a href="{$r['url']}" class="category">生活百科</a>
                    -->
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