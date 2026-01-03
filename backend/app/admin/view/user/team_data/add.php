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
    <title>新增</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('add')}">
        {if ($referee_phone)}
        <input type="hidden" name="phone" id="phone" disabled="disabled" placeholder="请填写被推荐人手机号" autocomplete="off" class="layui-input">
        <div class="form-item">
            <label for="pid" class="form-label">请选择团队</label>
            <div class="input-block">
                <select name="pid" id="pid">
                    <option value="0">点击选择</option>
                    {if $team_list}
                        {volist name="team_list" id="r"}
                        <option value="{$r['id']}">{$r['nickname']}团队-编号{$r['team_id']}</option>
                        {/volist}
                    {/if}
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="nickname" class="form-label">被推荐人姓名</label>
            <div class="input-block">
                <input type="text" name="nickname" id="nickname" placeholder="请填写被推荐人姓名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="form-item">
            <label for="phone" class="form-label">被推荐人手机</label>
            <div class="input-block">
                <input type="text" name="phone" id="phone" placeholder="请填写被推荐人姓名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="footer-btn-box">
            <div>
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定提交</button>
                <button type="button" class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll()">取消</button>
            </div>
        </div>
        {else/}
        <div class="form-item">
            <label for="referee_phone" class="form-label">推荐人手机号</label>
            <div class="input-block">
                <input type="text" name="referee_phone" value="{$referee_phone}" id="referee_phone" placeholder="请填写推荐人手机号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="footer-btn-box">
            <div>
                <button type="submit" class="layui-btn">下一步</button>
                <button type="button" class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll()">取消</button>
            </div>
        </div>
        {/if}
    </form>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer','jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        //监听提交
        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('create')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                }
            });
            return false;
        });
        $('#bak-btn').on('click',function () {
            layer.closeAll();
        });
    });
</script>
</body>
</html>