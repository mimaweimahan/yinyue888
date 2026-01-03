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
    <title>二维码</title>
    <link rel="stylesheet" href="{__STATIC__}layui/css/layui.css" media="all">
    <link rel="stylesheet" href="{__STATIC__}admin/common.css?v={:css_version()}">
</head>
<body>

<div class="page-package">
    <div class="layui-card-body" style="text-align: center;">
        <img  id="show_qrcode" width="210" height="210"  >
        <div id="qrcode" style="display: none;"></div>
        <canvas id="imgCanvas" width="210" height="210" style = "display: none;"></canvas>
        <div>{$address}</div>
    </div>
</div>

<script src="{__STATIC__}extend/jquery.min.js" charset="utf-8"></script>
<script src="{__STATIC__}extend/jquery.qrcode.min.js" charset="utf-8"></script>
<script>
    $().ready(function(){
        var codestr = "{$address}";
        if(codestr!==''){
            try{
                showCodeImage(codestr);
            } catch (e) {

            }
        }
    });

    function showCodeImage(codestr){
        var qrcode = $('#qrcode').qrcode({
            text: codestr,
            width: 200,
            height: 200,
        }).hide();
        var canvas = qrcode.find('canvas').get(0);
        var oldCtx = canvas.getContext('2d');
        var imgCanvas = document.getElementById('imgCanvas');
        var ctx = imgCanvas.getContext('2d');
        ctx.fillStyle = 'white';
        ctx.fillRect(0,0,210,210);
        ctx.putImageData(oldCtx.getImageData(0, 0, 200, 210), 5, 5);
        imgCanvas.style.display = 'none';
        $('#show_qrcode').attr('src', imgCanvas.toDataURL('image/png')).css({
            width: 210,height:210
        });
    }
</script>
</body>
</html>
