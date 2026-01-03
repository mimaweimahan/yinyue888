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
    <title>区域选择</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
    <style>
        html,body{ background: #fff;}
        .tab-box-main{
            margin: 0;
            padding: 0;
            line-height: 30px;
        }
        .tab-box-main li a{ display: flex; padding: 0 10px; cursor:pointer; border-radius: 3px;}
        .tab-box-main li.ac{
            background-color: #c3e5fa;
        }
        .tab-box-main li:hover{
            background-color: #c3e5fa;
        }
    </style>
</head>
<body>
<div class="page-package">
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li {if $province_id==0 }class="layui-this"{/if}>省份</li>
            <li {if $province_id>0&&$city_id==0 }class="layui-this"{/if}>城市</li>
            <li {if $city_id>0 }class="layui-this"{/if}>区域</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item {if $province_id==0 }layui-show{/if} ">
                <ul class="tab-box-main">
                    {volist name="province_list" id="r"}
                    <li {if $r['id']== $province_id} class="ac" {/if}>
                    <a href="{:url('area',['province_id'=>$r['id']])}">{$r['name']}</a>
                    </li>
                    {/volist}
                </ul>
            </div>
            <div class="layui-tab-item {if $province_id>0&&$city_id==0 }layui-show{/if}" >
                {if count($city_list)}
                <ul class="tab-box-main">
                    {volist name="city_list" id="r"}
                    <li {if $r['id']== $city_id} class="ac" {/if}>
                    <a href="{:url('area',['province_id'=>$province_id,'city_id'=>$r['id']])}">{$r['name']}</a>
                    </li>
                    {/volist}
                </ul>
                {else/}
                <div>请先选择省份</div>
                {/if}
            </div>
            <div class="layui-tab-item {if $city_id>0 }layui-show{/if}">
                {if count($area_list)}
                <ul class="tab-box-main">
                    {volist name="area_list" id="r"}
                    <li class="area" data-id="{$r['id']}">
                        <a>{$r['name']}</a>
                    </li>
                    {/volist}
                </ul>
                {else/}
                <div>请先选择城市</div>
                {/if}
            </div>
        </div>
    </div>

</div>

<script src="{__STATIC__}layui/layui.all.js" charset="utf-8"></script>
<script type="text/javascript">
    const fun = '{$fun}';
    const province_id = parseInt('{$province_id}');
    const city_id = parseInt('{$city_id}');
    layui.config({
        version:1.0,
        base: '{__STATIC__}layui/modules/'
    }).use(['element','layer','jquery'], function(){
        var $ = layui.jquery,
            layer = layui.layer;
        $('li.area').on('click', function (e){
            let id = $(this).data('id');
            //layer.msg('id:'+id);
            if(fun){
                window.parent.run_function("{$fun}",{'province_id':province_id,'city_id':city_id,'area_id':id});
            }else{
                window.parent.run_val("{$val}",id);
            }
            parent.layer.closeAll();
        });
    });
</script>
</body>
</html>