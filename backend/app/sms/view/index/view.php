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
        <div class="panel-lead"><em>学校</em></div>
        <ul class="panel-tab">
            <li><a href="{:url('index')}">学校管理</a></li>
            <li class="layui-this"><a href="javascript:void(0);">新增学校</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <!--#+++++++++++++++++++++++++++#-->
        <form class="layui-form" method="post" action="{:url('add')}">
            <br />
            <div class="layui-form-item">
                <label for="school_name" class="layui-form-label">学校名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="school_name" id="school_name" class="layui-input" size="68" placeholder="请填写学校名称">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="status" class="layui-form-label">开通状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" id="status" value="1" title="是" checked="checked" />
                    <input type="radio" name="status" value="0" title="否" />
                </div>
            </div>
            <div class="layui-form-item">
                <label for="city_id" class="layui-form-label">所在城市</label>
                <div class="layui-input-inline">
                    <select name="city_id" id="city_id" class="am-input-sm">
                        <option value="">选择城市</option>
                        {volist name="city_list" id="r"}
                        <option value="{$r['id']}">{$r['name']}</option>
                        {/volist}
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="address" class="layui-form-label">学校地址</label>
                <div class="layui-input-inline">
                    <input type="text" name="address" id="address" class="layui-input" size="68" placeholder="请填写仓库地址">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="coordinate" class="layui-form-label">地址标注</label>
                <div class="layui-input-inline">
                    <button type="button" class="layui-btn layui-btn-danger coordinate-btn"><i class="layui-icon layui-icon-location"></i> 坐标标注</button>
                    <br/>
                    <input type="text" name="coordinate" id="coordinate" class="layui-input" size="68" placeholder="坐标地址">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="address" class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <button type="submit" class="layui-btn" lay-submit lay-filter="submit_btn">确定提交</button>
                    <button type="button" class="layui-btn layui-btn-primary" onclick="window.history.back()">返回</button>
                </div>
            </div>
        </form>
        <!--#+++++++++++++++++++++++++++#-->
    </div>
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

        $('.coordinate-btn').on('click',function () {
            layer.open({
                type:2,
                title:'地图标注',
                area: ['80%', '60%'],
                maxmin:true,
                shadeClose: true, //开启遮罩关闭
                content:"{:url('tool/map/index',['val'=>'coordinate','city_id'=>$city_id])}",
                end:function () {}
            });
        });

        form.on('submit(submit_btn)', function (data) {
            $.ajax({
                url:"{:url('add')}",
                async: false,
                type:"POST",
                data:data.field,
                success: function(data){
                    layer.msg(data.msg);
                }
            });
            return false;
        });
    });
</script>
</body>
</html>