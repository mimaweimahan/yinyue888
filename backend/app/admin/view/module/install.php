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
        html,body{background: #fff;}
    </style>
</head>
<body>

    <!--#+++++++++++++++++++++++++++#-->
    <form class="layui-form">
        <input type="hidden" name="module" value="{$config.module}">
        <table class="layui-table" lay-skin="nob">
            <tbody>
                <tr>
                    <th width="100">模块名称：</th>
                    <td >{$config.module_name}</td>
                </tr>
                <tr>
                    <th>模块版本：</th>
                    <td >{$config.version}</td>
                </tr>
                {if  !empty($config['depend'])}
                <tr>
                    <th>依赖模块：</th>
                    <td ><?php echo implode('|',$config['depend']) ?></td>
                </tr>
                {/if}
                <tr>
                    <th>模块简介：</th>
                    <td >{$config.introduce}</td>
                </tr>
                <tr>
                    <th>开发作者：</th>
                    <td>{$config.author}</td>
                </tr>
                <tr>
                    <td colspan="2" style=" text-align: center; ">
                        <button type="button" class="layui-btn" lay-submit lay-filter="submit_btn">确定安装</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll()">取消安装</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <!--#+++++++++++++++++++++++++++#-->
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer', 'table', 'jquery','form'], function(){
        var $ = layui.jquery,form = layui.form;
        //监听行工具事件
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('install')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { parent.layer.closeAll(); },3000);
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>