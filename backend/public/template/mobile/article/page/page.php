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