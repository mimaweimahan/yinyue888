<?php if (!defined('APP_PATH')) exit(); ?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <title>地图标注</title>
    <style type="text/css">
        html,body{ margin:0; padding:0; font-family:"微软雅黑"; font-size:12px; width:100%; height:100%;}
        #map_body{width:100%; height:100%; z-index:1; top:0; left:0;}
        #search{ position:absolute; z-index:2; padding:5px ; top:10px; right:5px; background: rgba(51, 51, 51, 0.8); color:#fff; border-radius:5px; font-weight:bold;}
        #search input{ width:180px; border: 0; height: 25px; line-height: 25px; padding:0 10px;}
        #close-btn{ width: 60px; height: 35px; border-radius: 5px; line-height: 35px; text-align: center; background: rgba(0, 0, 0, 0.68); color: #fff; position:absolute; top:10px; left:10px; z-index:3;}
        #btn-box{width:50%;text-align: center;  position:absolute; bottom:30px; left:25%; z-index:3;}
        #btn-box>span{ border-radius: 5px; padding:5px 8px; background: rgba(0, 0, 0, 0.82); color: #fff;}
        #btn-box>div{ display: block; height:40px; margin-top: 10px; border-radius: 5px; line-height:40px; background: rgba(56, 118, 255, 0.82); color: #fff;}
    </style>
    <script type="text/javascript" src="{__STATIC__}/extend/jquery.min.js"></script>
    <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=CIWBZ-RZVC2-AVEU4-C74CH-7ORLF-AIBNF"></script>
</head>
<body>
<div id="close-btn">关闭</div>
<div id="search">
    <input type="text" name="address" id="address" placeholder="例子：贵阳 黄河路118号"> <button onclick="codeAddress();">搜索</button>
</div>
<input type="hidden" name="zoom" size="5" id="zoom" value="{$zoom}" placeholder="缩放">
<input type="hidden" name="points" id="points" size="10" value="<?php if(isset($lng)&&isset($lat)){echo $lng."|".$lat;}?>" placeholder="坐标">
<div id="btn-box">
    <span>注:点击地图进行标注</span>
    <div>保存标记</div>
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
            map.setCenter(result.detail.location);
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
        $("#btn-box div").click(function(){
            var marker = $("#points").val()+"|"+$("#zoom").val();
            try {
                window.parent.document.getElementById("{$val}").value = marker;
                window.parent.layer.closeAll();
            }catch (e) {
                console.log(e);
            }
        });
        $("#close-btn").click(function(){
            try {
                window.parent.layer.closeAll();
            }catch (e) {
                console.log(e);
            }
        });
    });
</script>
</body>
</html>