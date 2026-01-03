<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>定位模块</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <script type="text/javascript" src="https://3gimg.qq.com/lightmap/components/geolocation/geolocation.min.js"></script>
</head>
<body>
<script type="text/JavaScript">
    var geolocation = new qq.maps.Geolocation("7D2BZ-QYF6I-ELRGY-55KNI-W2K27-EVB6V", "myapp");
    var options = {timeout: 8000};
    var get_location = geolocation.getLocation(showPosition, showErr, options);
    console.log(get_location);
    function showPosition(position) {
        JSON.stringify(position, null, 4)
    }
    function showErr() {
        return '定位失败';
    }
</script>
</body>
</html>