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
    <link rel="stylesheet" href="{__STATIC__}skin/mobile.css?={:cms_version();}">
    <style>
        .body-panel{ min-height: 460px}
    </style>
</head>
<body>
{include file="./template/mobile/article/header.php" /}
<div class="page-banner"><h1>{$seo['title']}</h1></div>
<div class="panel-nav">
    <ul>
        <li {if $is_top == 0}class="current"{/if}><a href="{$category['url']}">最新</a></li>
        <li {if $is_top == 1}class="current"{/if}><a href="/{$category['catdir']}_top/1.html">精选</a></li>
    </ul>
</div>
<div class="body-panel">
    <ul class="list-pic-card flex_img">
        {Cms:get table="article" where="$where" order="$order" limit="12" page="true" page_url="$page_url"}
        <li>
            <aside>
                <a href="{$r['url']}">
                    <img class="lazy" src="{__STATIC__}skin/loading.png" data-original="{:thumb($r['thumb'],500,281)}" alt="{$r['title']}">
                    {if !empty($r['video']) }
                    <div class="big-video"><i></i></div>
                    {/if}
                    {if !empty($r['video_time']) }
                    <div class="mini-video"><i class="iconfont icon-shipin"></i><span>{$r['video_time']}</span></div>
                    {/if}
                </a>
                <a href="{$category['url']}" class="category">{$category['cat_name']}</a>
            </aside>
            <h3><a href="{$r['url']}">{$r['title']}</a></h3>
            <dl>
                <dt><i class="iconfont icon-jilu"></i> {:date('m-d',$r['create_time'])}</dt>
                <dd><i class="iconfont icon-see"></i> {:numFormat($r['views'])}</dd>
            </dl>
        </li>
        {/Cms:get}
    </ul>
    <div class="webpage">
        <ul>
            {$pages|raw}
        </ul>
    </div>
</div>
{include file="./template/mobile/article/footer.php" /}
</body>
</html>