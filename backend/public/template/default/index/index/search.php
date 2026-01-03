<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport"  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="keywords" content="{:getConfig('site_keywords')}"/>
    <meta name="description" content="{:getConfig('site_description')}"/>
    <title>{:getConfig('site_name')}</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="{__FONT_URL__}">
    <link rel="stylesheet" href="{__STATIC__}skin/common.css?={:cms_version();}">
    <style>
        .search-box{ padding:5px 20px;}
        .search-box .list-pic-text li{ margin-bottom: 20px}
        .search-box .list-pic-text li aside{ width: 200px; height: 113px;}
        .search-box .list-pic-text section { height: 113px;}
        .search-box .list-pic-text section h3{ font-size: 1rem}
        .search-box .list-pic-text section p{ font-size: 12px; color: #666; padding:5px 10px;}
        .search-box .list-pic-text section p a{color: #666; }
    </style>
</head>
<body>
{include file="./template/default/article/header.php" /}
<div class="page-banner"><h1>{$w}</h1></div>
<div class="page-container p-top-20">
    <div class="page-left">
        <div class="panel-nav">
            <ul>
                <li class="current"><a>搜索结果</a></li>
            </ul>
        </div>
        <div class="search-box">
            <ul class="list-pic-text flex_img">
                {volist name="lst" id="r"}
                <li>
                    <aside>
                        <a href="{$r['url']}">
                            <img class="lazy" src="{__STATIC__}skin/loading.png" data-original="{:thumb($r['thumb'],320,180)}" alt="{$r['title']}" title="{$r['title']}">
                            {if !empty($r['video']) }
                            <div class="big-video"><i></i></div>
                            {/if}
                            {if !empty($r['video_time']) }
                            <div class="mini-video"><i class="iconfont icon-shipin"></i><b>{$r['video_time']}</b></div>
                            {/if}
                        </a>
                    </aside>
                    <section>
                        <h3><a href="{$r['url']}">{$r['title']}</a></h3>
                        <p><a>{$r['description']}</a></p>
                        <dl>
                            <dt><i class="iconfont icon-jilu"></i> {$r['create_time']}</dt>
                            <dd><i class="iconfont icon-see"></i> {$r['views']}</dd>
                        </dl>
                    </section>
                </li>
                {/volist}
            </ul>
        </div>
        <div class="webpage">
            {$pages|raw}
        </div>
    </div>
    <div class="page-right">
        <div class="hot-so-box public-box">
            <div class="head">
                <i class="iconfont icon color-red icon-hot"></i>
                <h3>热搜榜</h3>
                <a href="javascript:void(0);"><i class="iconfont icon-shuaxin"></i> 换一批</a>
            </div>
            <ul class="list-pic-text flex_img">
                {Cms:get table="article" where="['status'=>1,'is_page'=>0]" order="create_time desc" limit="5"}
                <li>
                    <aside>
                        <a href="{$r['url']}">
                            <img class="lazy" src="{__STATIC__}skin/loading.png" data-original="{:thumb($r['thumb'],320,180)}" alt="{$r['title']}" title="{$r['title']}">
                        </a>
                        <span class="hot-num-{$i}">{$i}</span>
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