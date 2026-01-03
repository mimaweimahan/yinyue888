<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>推广海报</title>
    <style>
        html,body{
            margin: 0;
            padding: 0;
            background: #fff;
            text-align: center;
        }
        h2{ padding: 20px; text-align: center}
        img{
            max-width: 500px;
        }
    </style>
</head>
<body>
    {if $png}
        <img src="{$png}" width="100%"/>
    {else}
        <h2>生成失败</h2>
    {/if}
</body>
</html>