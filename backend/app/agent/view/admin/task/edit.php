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
    <title>编辑模版</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
    </style>
</head>
<body>
<div class="page-package">
    <form class="layui-form" method="post" action="{:url('edit')}">
        <input type="hidden" name="id" value="{$id}" />
        <div class="form-item">
            <label for="agent_id" class="form-label">所属代理</label>
            <div class="input-block">
                <select name="agent_id" id="agent_id">
                    <option value="">请选择</option>
                    {volist name="agent_list" id="r"}
                    <option value="{$r.agent_id}" {if $agent_id==$r['agent_id']} selected {/if}> {$r.username} </option>
                    {/volist}
                </select>
            </div>
        </div>
        <div class="form-item">
            <label for="agent_id" class="form-label">模版名称</label>
            <div class="input-inline">
                <input type="text" name="name" value="{$name}"  required lay-verify="required" placeholder="请输入模版名称" autocomplete="off" class="layui-input" />
            </div>
        </div>
        <div class="form-item">
            <label for="agent_id" class="form-label">任务编号</label>
            <div class="input-inline">
                <input type="text" name="task_no" value="{$task_no}" required lay-verify="required" placeholder="1/5/8" autocomplete="off" class="layui-input" />
            </div>
        </div>
        <div class="form-item">
            <label for="agent_id" class="form-label">最小派单</label>
            <div class="input-inline">
                <input type="text" name="start_balance" value="{$start_balance}" autocomplete="off" placeholder="3/10/20" class="layui-input" />
            </div>
        </div>
        <div class="form-item">
            <label for="agent_id" class="form-label">最大派单</label>
            <div class="input-inline">
                <input type="text" name="end_balance" value="{$end_balance}" autocomplete="off" placeholder="8/20/40" class="layui-input" />
            </div>
        </div>
        <div class="form-item">
            <label for="agent_id" class="form-label">收益倍数</label>
            <div class="input-inline">
                <input type="text" name="task_rate" value="{$task_rate}" autocomplete="off" placeholder="1/2/3" class="layui-input" />
                <div class="color-desc">
                    每一个派单以'/'分隔,例如任务编号”1/5/8“代表第1,5,8单，最小派单”3/10/20“代表第一单最小卡4，第二单最小卡10，第三单最小卡20，以此类推...
                </div>
            </div>
        </div>
        <div class="footer-btn-box">
            <div>
                <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定编辑</button>
                <button type="button" class="layui-btn layui-btn-primary" onclick="parent.layer.closeAll()">取消</button>
            </div>
        </div>
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
                url:"{:url('edit')}",
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
