<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{__STATIC__}extend/express-detail.css">
    <title>列表</title>
    <style>
        html,body{
            background: #fff;
        }
        .container{
            padding: 10px;
        }
        .container ul li {
            display: block;
            height: 30px;
            line-height: 30px;
        }
        .container ul li dl{
            width: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .pages{
            margin: 10px;
        }
        .pagination{
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        .pagination li{ width: 30px; height: 30px; margin: 1px; line-height:30px; text-align: center; border: 1px solid #eeeeee}
    </style>
</head>
<body>
    <a href="{:url('query')}" style="padding: 10px">跟目录</a>
    <div class="container">
        <ul>
            {volist name="lists" id="r"}
            <li>
                <dl>
                    <dd>
                        {if $r['type']=='folder'}
                        <a href="{:url('query',['file_id'=>$r['file_id']])}">[目录]-{$r['name']}</a>
                        {else/}
                        <a>{$r['name']}</a>
                        {/if}
                    </dd>
                    <dd>
                        {if $r['type']=='folder'}
                        <a href="https://www.aliyundrive.com/s/{$r['share_id']}/folder/{$r['file_id']}" target="_blank">打开目录</a>
                        {else/}
                        <a href="https://www.aliyundrive.com/s/{$r['share_id']}/folder/{$r['parent_folder']}" target="_blank">打开目录</a>
                        {/if}
                    </dd>
                </dl>
            </li>
            {/volist}
        </ul>
        <div class="pages">{$pages|raw}</div>
    </div>
</body>
</html>