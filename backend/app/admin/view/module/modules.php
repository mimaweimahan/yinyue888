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
    <title>{$rule['title']}</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        body{ overflow-x: hidden;}
        .app-main{
            display: -webkit-flex; /* Safari */
            display: flex;
            align-items:center;
            justify-content: space-between; /* 横向中间自动空间 */
            padding: 20px;
            border-radius: 3px;
            color: #666;
        }
        .app-main .icon{ width:60px; text-align: center; border-right: 1px #eee solid;}
        .app-main .icon .iconfont{ font-size:40px; color: rgba(61, 81, 89, 0.86);}
        .app-main dl{ padding-left: 15px; flex: 1;}
        .app-main dl dt{ font-weight: bold; line-height:35px; }
        .app-main ul li{ margin: 2px;}
        .app-main ul li a{ display: flex; align-items:center;}
        @media (max-width:300px){
            .app-main{flex-flow: column; text-align: center;}
            .app-main .icon{ border: 0;}
        }
        @media (max-width:600px){
            .app-list{ padding: 10px;}
        }
    </style>
</head>
<body class="body-main-p">
    <div class="app-body">
        <div class="layui-show layui-col-space15 app-list">
            <!--#+++++++++++++++++++++++++++#-->
            {volist name="data" id="r"}
            <div class="layui-col-xs12 layui-col-md4 layui-col-md2">
                <div class="app-main layui-card">
                    <div class="icon">
                        <i class="iconfont">{if $r['icon']}{$r['icon']|raw};{else/}&#xe6c5;{/if}</i>
                    </div>
                    <dl>
                        <dt>{$r['module_name']}</dt>
                        <dd>目录：{$r['module']}</dd>
                        <dd>版本：{$r['version']}</dd>
                    </dl>
                    <ul>
                        <li>
                            <a href="{:url($r['admin_url'])}" class="layui-btn layui-btn-sm layui-btn-primary">
                                <i class="layui-icon layui-icon-code-circle"></i>
                                <span>应用管理</span>
                            </a>
                        </li>
                        <li>
                            <a href="{:url($r['web_url'])}" target="_blank" class="layui-btn layui-btn-sm layui-btn-primary">
                                <i class="layui-icon layui-icon-set-sm"></i>
                                <span>应用前端</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            {/volist}
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
    <script src="{__STATIC__}layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript">
        layui.config({
            version:1.0,
            base: '{__STATIC__}layui/modules/'
        }).use(['element'], function(){});
    </script>
</body>
</html>