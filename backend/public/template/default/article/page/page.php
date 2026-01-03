<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="keywords" content="{$seo['keywords']}" />
    <meta name="description" content="{$seo['description']}" />
    <title>{$seo['title']}</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="{__FONT_URL__}">
    <link rel="stylesheet" href="{__STATIC__}skin/common.css?={:cms_version();}">
    <link rel="stylesheet" href="{__STATIC__}skin/view.css?={:cms_version();}">
    <style>
        .recommend{ margin-top: 10px;}
    </style>
</head>
<body>
{include file="./template/default/article/header.php" /}
<div class="page-dh">
    <span> 当前位置 : </span>
    <span> {:getConfig('config_app_name')} </span>
    <span> > </span>
    <a href="{:getCategory($cat_id,'url')}">{:getCategory($cat_id,'cat_name')}</a>
    <span> > </span> 正文
</div>
<div class="page-container">
    <div class="page-left">
        <article>
            <h1 class="article-title">{$title}</h1>
            <dl class="article-sub">
                <dd><i class="iconfont icon-jilu"></i> {:date('m-d',strtotime($create_time))}</dd>
                <dd><i class="iconfont icon-see"></i> 阅读 <span id="view-hits"> {:numFormat($views)}</span> </dd>
                <dd><i class="iconfont icon-hezuo"></i> 作者：{$author}</dd>
            </dl>
            <div class="description"><em>概述</em> {$description|raw}</div>
            <div class="content">
                {if !empty($video) }
                <div class="video-box"><video src="{$video}" poster="{$thumb}" controls="controls"></video></div>
                {/if}
                {$content|raw}
            </div>
            <div class="tips">
            </div>
        </article>

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
    <div class="page-right">
        <div class="hot-so-box public-box">
            <div class="head">
                <i class="iconfont icon color-red icon-tj"></i>
                <h3>最新文章</h3>
                <a href="javascript:void(0);"></a>
            </div>
            <ul class="list-pic-text flex_img">
                {Cms:get table="article" where="['status'=>1,'is_page'=>0]" order="create_time desc" limit="5"}
                <li>
                    <aside>
                        <a href="{$r['url']}">
                            <img class="lazy" src="{__STATIC__}skin/loading.png" data-original="{:thumb($r['thumb'],320,180)}" alt="{$r['title']}" title="{$r['title']}">
                        </a>
                    </aside>
                    <section>
                        <h3><a href="{$r['url']}">{$r['title']}</a></h3>
                        <dl>
                            <dt><i class="iconfont icon-jilu"></i> {:date('m-d',$r['create_time'])}</dt>
                            <dd><i class="iconfont icon-see"></i> {:numFormat($r['views'])}</dd>
                        </dl>
                    </section>
                </li>
                {/Cms:get}
            </ul>
        </div>
    </div>
</div>
{include file="./template/default/article/footer.php" /}
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