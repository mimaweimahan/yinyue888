<?php if (!defined('SYS_VERSION')) exit(); ?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <title>地图标注</title>
    <style type="text/css">
        html,body{ margin:0; padding:0; font-family: "微软雅黑", serif; font-size:12px; width:100%; height:100%; overflow-x: hidden}
        #forms{ height:30px; line-height:30px; background:#F6F6F6; position:absolute; bottom:0; left:0; z-index:3; width:100%; border-top:1px solid #C2D1D8; padding:3px 0px;}
        #forms span{ padding:2px 8px;}
        #forms a{ background:#336FC9; color:#FFF; padding:3px 10px; border-radius:15px; text-decoration:none;}
        #forms a:hover{ background:#333;}
        #map_body{width:100%; height:100%; z-index:1; top:0; left:0;}
        #tip{ position:absolute; z-index:2; padding:5px 15px; top:20px; left:65px; background:#333; color:#fff; border-radius:15px; font-weight:bold;}
        #search{ position:absolute; z-index:2; padding:3px 15px; top:20px; left:180px; background:#333; color:#fff; border-radius:15px; font-weight:bold;}
        #search input{ border: 1px solid #333;}
    </style>
    <script type="text/javascript" src="{__STATIC__}/extend/jquery.min.js"></script>
    <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=OB4BZ-D4W3U-B7VVO-4PJWW-6TKDJ-WPB77"></script>
</head>
<body>
<div id="forms">
   <span>
   缩放：<input name="zoom" type="text" size="5" id="zoom" value="{$zoom}">
   坐标：<input name="points" type="text" id="points" size="10" value="<?php if(isset($lng)&&isset($lat)){echo $lng."|".$lat;}?>">
   <a href="javascript:void(0);" class="submit_btn">保存</a>
   </span>
</div>
<div id="tip">点击标注并拖动!</div>
<div id="search">
    <input type="text" name="address" id="address" placeholder="贵阳 南明区 兰花广场" style="width: 120px;"> <button onclick="codeAddress();">搜索</button>
</div>
<div id="map_body"></div>
<script type="text/javascript">
    var myLatLng = new qq.maps.LatLng(26.610630,106.676559);
    var map = new qq.maps.Map(document.getElementById("map_body"),{
        center: myLatLng,
        zoom: <?php if($zoom>5){ echo $zoom;}else{ echo '11';};?>
    });
    var marker='';
    document.getElementById("zoom").value = map.getZoom();
    <?php
    if(isset($lng) && isset($lng)){
        echo ' /*添加监听事件   获取鼠标单击事件*/';
        echo ' marker = new qq.maps.Marker({position:new qq.maps.LatLng('.$lng.', '.$lat.'),draggable: true,map:map});';
        echo '/*绑定拖动事件*/';
        echo "qq.maps.event.addListener(marker, 'dragend', function(e) { document.getElementById('points').value = e.latLng.getLat().toFixed(6) + '|' + e.latLng.getLng().toFixed(6); });";
    }
    ?>
    qq.maps.event.addListener(map, 'click', function(event) {
        if(typeof(marker)=="object"){
            marker.setMap(null);
        }
        var marker_new= new qq.maps.Marker({
            position:event.latLng,
            draggable: true,
            map:map
        });
        qq.maps.event.addListener(map, 'click', function() {
            marker_new.setMap(null);
        });
        document.getElementById("points").value =  event.latLng.getLat().toFixed(6) + "|" + event.latLng.getLng().toFixed(6);
        //绑定拖动事件
        qq.maps.event.addListener(marker_new, 'dragend', function(e) {
            document.getElementById("points").value =  e.latLng.getLat().toFixed(6) + "|" + e.latLng.getLng().toFixed(6);
        });
    });
    qq.maps.event.addListener(map,'zoom_changed',function() {
        document.getElementById("zoom").value = map.getZoom();
    });
    //调用地址解析类
    geocoder = new qq.maps.Geocoder({
        complete : function(result){
            var pt = result.detail.location;
            document.getElementById("points").value = (pt.lat).toFixed(6) + "|" + (pt.lng).toFixed(6);

            map.setCenter(pt);
            marker = new qq.maps.Marker({
                map:map,
                position: result.detail.location
            });
        }
    });
    //设置定时器每隔2秒改变地图中心点位置
    setTimeout(function() {
        //经纬度信息
        {if isset($lat)}
        map.panTo(new qq.maps.LatLng(<?php echo $lng;?>,<?php echo $lat;?>));
        {else/}
            map.panTo(new qq.maps.LatLng(26.610630,106.676559));
            {/if}
            }, 2000);

    function codeAddress() {
        var address = document.getElementById("address").value;
        //通过getLocation();方法获取位置信息值
        geocoder.getLocation(address);
    }

    $(function(){
        $(".submit_btn").click(function(){
            //var marker = $("#points").val()+"|"+$("#zoom").val();
            let lat  = $("#points").val().split("|")[0];
            let lng  = $("#points").val().split("|")[1];
            let zoom = $("#zoom").val();
            window.parent.run_val("{$val}",'{"lng":'+lng+',"lat":'+lat+',"zoom":'+zoom+'}');
            parent.layer.closeAll();
        });
    });
</script>
</body>
</html>