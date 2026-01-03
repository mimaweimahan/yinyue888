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
</head>
<body class="body-main-p">
<div class="panel-default">
    <div class="panel-heading">
        <div class="panel-lead"><em>{$rule['title']}</em>{$rule['note']}</div>
        <ul class="panel-tab">
            {volist name="config_group_list" id="group"}
            {if $id == $key || ($key == 1 && $id==0)}
            <li class="layui-this"><a href="{:url('index',['id'=>$key])}"> {$group}配置</a></li>
            {else/}
            <li><a href="{:url('index',['id'=>$key])}"> {$group}配置</a></li>
            {/if}
            {/volist}
        </ul>
    </div>
    <div class="panel-body">
        <div class="layui-show">
            <!--#+++++++++++++++++++++++++++#-->
            <div style="height: 50px"></div>
            <form class="layui-form">
                {volist name="lists" id="r"}
                <div class="layui-form-item">
                    <label class="layui-form-label">{$r.title}</label>
                    <div class="layui-input-inline">
                        {switch $r.type}
                        {case 1} <input type="text"  name="config[{$r.name}]" value="{$r.value}" size="60" class="layui-input w-auto"/> {/case}
                        {case 2} <textarea name="config[{$r.name}]" cols="60" rows="8" class="layui-textarea w-auto">{$r.value}</textarea> {/case}
                        {case 3} <textarea name="config[{$r.name}]" cols="30" rows="8" class="layui-textarea w-auto">{$r.value}</textarea> {/case}
                        {case 4}
                        <select name="config[{$r.name}]" style="min-width: 100px;" class="layui-input w-auto">
                            {volist name=":parse_config_attr($r['extra'])" id="vo"}
                            <option value="{$key}" {eq name="r.value" value="$key"} selected {/eq}>{$vo}</option>
                            {/volist}
                        </select>
                        {/case}
                        {case 6}
                        <input type="text" name="config[{$r.name}]" id="{$r.name}" value="{$r.value}" class="layui-input w100" placeholder="点击右侧按钮上传">
                        <button type="button" class="layui-btn layui-bg-green upload-btn" data-id="{$r.name}"> + 点击上传 </button>
                        {/case}
                        {default /} <input type="text"  name="config[{$r.name}]" value="{$r.value}" size="60" class="layui-input w-auto"/>
                        {/switch}
                        <div class="note-tips"> <span class="layui-badge st-red">调用：</span> <a href="javascript:void(0);">getConfig('{$r.name}')</a></div>
                        <p class="remark">{$r.remark}</p>
                    </div>
                </div>
                {/volist}
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" lay-submit lay-filter="submit_btn">立即提交</button>
                        <button type="button" class="layui-btn layui-btn-primary" onclick="history.back();">返回</button>
                    </div>
                </div>
            </form>
            <!--#+++++++++++++++++++++++++++#-->
        </div>
    </div>
</div>
<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer', 'jquery','form'], function(){
        var $ = layui.jquery,
            layer = layui.layer,
            form  = layui.form;
        $('.upload-btn').unbind('click').on('click',function(){
            var id = $(this).data('id');
            layer.open({
                type:2,
                title:'上传文件',
                area: ['600px', '600px'],
                maxmin:true,
                content:"{:url('admin/file/api',['num'=>1,'type'=>'file'])}&val="+id,
                end:function () {}
            });
        });
        form.on('submit(submit_btn)', function(data){
            $.ajax({
                url:"{:url('save')}",
                async: false,
                type:"POST",
                data:data.field,
                dataType:'json',
                success: function(data){
                    layer.msg(data.msg);
                    if(data.code === 1){
                        setTimeout(function () { location.reload(); },3000);
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>