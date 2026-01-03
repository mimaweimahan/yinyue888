<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport"  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="keywords" content="{$keywords}"/>
    <meta name="description" content="{$description|raw}"/>
    <title>{$title}</title>
    <link rel="alternate" hreflang="zh-Hans" media="only screen and (max-width: 640px)" href="{$url}" />
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="{__FONT_URL__}">
    <link rel="stylesheet" href="{__STATIC__}skin/common.css?={:cms_version();}">
    <link rel="stylesheet" href="{__STATIC__}skin/view.css?={:cms_version();}">
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
            {if $files_list}
            <ul class="extend">
                {volist name="files_list" id="r"}
                {if isset($extend[$r['field']]) && $extend[$r['field']] }
                <li><span>{$r['name']}：</span><span>{$extend[$r['field']]}</span></li>
                {/if}
                {/volist}
            </ul>
            {/if}
            <div class="description"><em>概述</em> {$description|raw}</div>
            <div class="content">
                {if !empty($video) }
                <div class="video-box"><video src="{$video}" poster="{$thumb}" controls="controls"></video></div>
                {/if}
                {$content|raw}
            </div>

        </article>
        <dl class="last-next">
            <dt>
                <div>上一篇</div>
                <div>下一篇</div>
            </dt>
            <dd>
                <div>{if $last_article} <a href="{$last_article['url']}">{$last_article['title']}</a> {else/} 没有了 {/if}
                </div>
                <div>{if $next_article} <a href="{$next_article['url']}">{$next_article['title']}</a> {else/} 没有了 {/if}
                </div>
            </dd>
        </dl>
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