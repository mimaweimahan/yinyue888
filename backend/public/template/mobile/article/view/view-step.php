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
    <style>
        .step-top{ padding-bottom: 10px}
        .step-box{
            border-left: 2px solid #D3E6DD;
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
{include file="./template/mobile/article/header.php" /}
<div class="page-container">
    <article>
        <h1 class="article-title">{$title}</h1>
        <dl class="article-sub">
            <dd><i class="iconfont icon-jilu"></i> {:date('m-d',strtotime($create_time))}</dd>
            <dd><i class="iconfont icon-see"></i> 阅读 <span id="view-hits"> {:numFormat($views)}</span> </dd>
            <dd><i class="iconfont icon-hezuo"></i> 作者：{$author}</dd>
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