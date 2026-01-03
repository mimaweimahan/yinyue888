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
</head>
<body>
{include file="./template/default/article/header.php" /}
<div class="page-banner"><h1>{$seo['title']}</h1></div>
<div class="page-container p-top-20">
    <div class="page-left">
        <div class="panel-nav">
            <ul>
                <li {if $is_top == 0}class="current"{/if}><a href="{$category['url']}">最新</a></li>
                <li {if $is_top == 1}class="current"{/if}><a href="/{$category['catdir']}_top/1.html">精选</a></li>
            </ul>
        </div>
        <ul class="list-pic-card flex_img">
            {Cms:get table="article" where="$where" order="$order" limit="12" page="true" page_url="$page_url"}
            <li>
                <aside>
                    <a href="{$r['url']}">
                        <img class="lazy" src="{__STATIC__}skin/loading.png" data-original="{:thumb($r['thumb'],500,281)}" alt="{$r['title']}">
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
    <div class="page-right">
        <div class="hot-so-box public-box">
            <div class="head">
                <i class="iconfont icon color-red icon-tj"></i>
                <h3>为你推荐</h3>
                <a href="javascript:void(0);"><i class="iconfont icon-shuaxin"></i> 换一批</a>
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
</body>
</html>