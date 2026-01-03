<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <title>城市选择</title>
    <link href="__PLUGIN__/amazeui/css/amazeui.min.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">
        body{background: #EBEBEB;}
        .city-box{ margin:5px 0; font-size: 1.4rem;}
        .city-header{ padding: 12px; border-bottom: 1px solid #ccc;}
        .city-line-title{ margin: 10px 10px 0 10px; height: 25px; line-height: 25px; position: relative; }
        .city-line-title>span{ position: absolute; font-size: 13px; top:0; left: 0; padding-right: 10px; height: 25px; background: #EBEBEB; color: #0e90d2; z-index: 2;}
        .city-line-title>i{ display: block; width: 100%; height: 1px; position: absolute; z-index: 1; border-bottom: 1px solid #dbdbdb; font-size: 0; top:13px;}
        .public-city-box .section{ padding: 0 10px;}
        .public-city-box .section>a{
            display: inline-block;
            padding: 0 10px;
            outline: 0;
            text-decoration: none;
            white-space: nowrap;
            margin: 1px;
            cursor: pointer;
            font-size: 13px;
        }
        .search-box{ display: none;}
        .public-city-box a{
            background: #fff;
            border: 1px solid #cdcdcd;
            border-radius: 0.3rem;
            color: #8d8d8d;
        }
        .public-city-box a:hover{
            border: 1px solid #00a0e9;
            background: #00a0e9; color: #fff;
        }
        .city-list{ margin:0; border-top:1px solid #ccc;}
        .city-list dl{ margin: 0; padding: 0; list-style: none;}
        .city-list dl>dt{ padding: 0 10px; line-height: 28px;  background: #ddd; font-weight:100;}
        .city-list dl>dd{ margin: 0;  padding:10px;  background: #fff;}
        .city-list dl>dd>a{
            display: inline-block;
            padding: 0 10px;
            outline: 0;
            text-decoration: none;
            white-space: nowrap;
            margin: 1px;
            cursor: pointer;
            font-size: 13px;
        }
        .top-quick{ padding-bottom: 10px; background: #EBEBEB;}
        .top-quick div{ padding: 0 10px;}
        .top-quick a{
            display: inline-block;
            padding: 0 10px;
            outline: 0;
            text-decoration: none;
            white-space: nowrap;
            margin: 1px;
            cursor: pointer;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="city-box">
    <div class="city-header">
        <div class="am-input-group am-input-group-secondary ">
            <input type="text" name="key" class="am-form-field am-radius" id="search-key" placeholder="输入城市关键词">
            <span class="am-input-group-btn">
				<button class="am-btn am-btn-secondary am-radius" type="button"><i class="am-icon-search"></i></button>
			</span>
        </div>
    </div>
    <div class="public-city-box search-box">
        <div class="city-line-title"><span style="color: #00B83F">搜索结果</span><i></i></div>
        <div class="section">

        </div>
    </div>
    {if $history}
        <div class="public-city-box">
            <div class="city-line-title"><span>最近选择的城市</span><i></i></div>
            <div class="section history">
                {volist name="history" id="r"}
                    <a data-id="{$r['id']}">{$r['name']}</a>
                {/volist}
            </div>
        </div>
    {/if}
    {if $hot_city}
        <div class="public-city-box">
            <div class="city-line-title"><span>热门城市</span><i></i></div>
            <div class="section">
                {volist name="hot_city" id="r"}
                    <a data-id="{$r['id']}">{$r['name']}</a>
                {/volist}
            </div>
        </div>
    {/if}
    <div data-am-sticky class="public-city-box top-quick">
        <div class="city-line-title"><span>按字母检索</span><i></i></div>
        <div>
            {foreach name="city_list" item="r" key="k" }
              <a href="#{$k}" >{$k}</a>
            {/foreach}
        </div>
    </div>
    <div class="city-list section">
        {foreach $city_list as $k=>$v}
              <dl>
                <dt><a name="{$k}" class="city-{$k}">{$k}</a> </dt>
                <dd>
                    {volist name="v['cities']" id="r"}
                        <a data-id="{$r['id']}">{$r['name']}</a>
                    {/volist}
                </dd>
            </dl>
        {/foreach}
    </div>
</div>
<script type="text/javascript" src="__PLUGIN__/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="__PLUGIN__/amazeui/js/amazeui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/public/common.js"></script>
<script type="text/javascript">
    var $fun="{$fun|default='city_fun'}";
    $(function(){
        $('a[href*=#],area[href*=#]').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var $target = $(this.hash);
                $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
                if ($target.length) {
                    var targetOffset = $target.offset().top;
                    $('html,body').animate({
                            scrollTop: targetOffset-120
                        },
                        1000);
                    return false;
                }
            }
        });
        //城市搜索
        $("#search-key").keyup(function() {
            var $key = $(this).val();
            if($key){
                var $time_out_event = setTimeout(function () { $(".hide-box").hide(500)}, 5000);
                $.getJSON("{:url('search')}",{'key':$key}).done(function (data) {
                    if (data.status == 0) {
                        $(".search-box").show().addClass('hide-box').find('.section').html("<i>没有找到！</i>");
                    } else{
                        clearTimeout($time_out_event);
                        var city = '';
                        var json = data.list;
                        for(var i = 0; i<json.length;i++){
                            city += '<a data-id="'+json[i]['id']+'">'+json[i]['name']+'</a>';
                        }
                        $(".search-box").show().removeClass('hide-box').find('.section').html(city);
                        choose();
                    }
                });
            }
        });
        choose();
    });
    /**
     * 设置值
     * @param data
     */
    function setVal(id,name) {
        $.getJSON("{:url('history')}",{'id':id,'name':name}).done(function (data) {
            if (data.list) {
                var city = '';
                var json = data.list;
                for(var i = 0; i<json.length;i++){
                    city += '<a data-id="'+json[i]['id']+'">'+json[i]['name']+'</a>';
                }
                if(json){
                    $(".history").html(city);
                }
                choose();
            }
            window.parent.run_function($fun,{'id':id,'name':name},'<?php echo $frame;?>');
        });

    }
    function choose() {
        $(".section a").unbind();
        $(".section a").on("click",function(){
            setVal($(this).data('id'),$(this).text());
        });
    }
</script>
</body>
</html>