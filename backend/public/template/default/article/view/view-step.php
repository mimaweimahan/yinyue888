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
    <style>
        .step-top{ padding-bottom: 10px}
        .step-box{
            border-left: 1px solid #eee;
            margin-left: 20px;
            padding: 10px;
        }
        .step-box .step-head{
            position: relative;
            display: flex;
            align-items: center;
        }
        .step-box .step-head .step-num{
            position: relative;
            top: 0;
            left: -28px;
            width: 36px;
            height: 36px;
            line-height: 36px;
            text-align: center;
            background: #2dc26b;
            border-radius: 18px;
            color: #fff;
            font-weight: bold;
        }
        .step-box .step-head .step-name{
            position: relative;
            top: 0;
            left: -10px;
            font-size: 20px;
            font-weight: bold;
        }
        .step-box .step-note{
            padding: 10px 30px;
        }
        .set-end{ padding-left: 5px; color: #ccc;}
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
                {if $author}<dd><i class="iconfont icon-hezuo"></i> 作者：{$author}</dd>{/if}
            </dl>
            <div class="description">{$content|raw}</div>
            <div class="content">
                <div class="step-top">操作/步骤</div>
                {volist name="experience" id="r"}
                <div class="step-box">
                    <div class="step-head">
                        <span class="step-num">{$r['exp_on']}</span>
                        <h3 class="step-name">{$r['exp_name']}</h3>
                    </div>
                    <p class="step-note">
                        {if $r['exp_pic']}
                        <div class="step-pic">
                            <img src="{$r['exp_pic']}" alt="{$r['exp_name']}" />
                        </div>
                        {/if}
                        {$r['exp_note']}
                    </p>
                </div>
                {/volist}
                <div class="set-end">
                    <div>END</div>
                </div>
            </div>
        </article>
        <dl class="last-next">
            <dt>
                <div>上一篇</div>
                <div>下一篇</div>
            </dt>
            <dd>
                <div>{if $last_article} <a href="{$last_article['url']}">{$last_article['title']}</a> {else/} 没有了 {/if} </div>
                <div>{if $next_article} <a href="{$next_article['url']}">{$next_article['title']}</a> {else/} 没有了 {/if}</div>
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
    $(function (){
        $.get("{:url('article/hits/index',['id'=>$id])}", function (data) {
            $("#hits").html(data.views);
        }, "json");
        /*等比例缩放图片*/
        window.onload = function(){
            $(".content img").each(function(){
                if( $(this).width()>820 ){
                    $(this).css({"width":"100%","height":"auto"});
                }
            })
        };
        $
    })
</script>
</body>
</html>