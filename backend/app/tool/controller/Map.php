<?php
/**
 * 百度地图标注
 * Some rights reserved:moretouch.cn
 * Contact email:admin@moretouch.cn
*/
namespace app\tool\controller;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;
class  Map {

    //腾讯地图key(WebServiceAPI)
    protected $KEY = '7D2BZ-QYF6I-ELRGY-55KNI-W2K27-EVB6V';

    //百度地图AK
    protected $AK = 'Wv9GW3toCzacFGiDGVD6RGXNc54eb1f6';

    public function index() {
        //标注
        $marker = input('get.marker', '');
		$marker = explode('|',$marker);
        //缩放等级
        $_zoom = 0;
        if(isset($marker[2])){
            $_zoom = $marker[2];
        }

		if($_zoom>1){
		  $zoom= $_zoom;
		}else{
		  $zoom = 5;
		}

		if(isset($marker[0]) && isset($marker[1])){
            View::assign("lng", $marker[0]);
            View::assign("lat", $marker[1]);
        }
        View::assign("zoom", $zoom);
        View::assign("val", input('get.val', ''));
        return  View::fetch();
    }

    // 手机版调用
    public function api() {
        //标注
        $marker = input('get.marker', '');
        $marker = explode('|',$marker);
        //缩放等级
        $_zoom = 0;
        if(isset($marker[2])){
            $_zoom = $marker[2];
        }

        if($_zoom>1){
            $zoom= $_zoom;
        }else{
            $zoom = 5;
        }

        if(isset($marker[0]) && isset($marker[1])){
            View::assign("lng", $marker[0]);
            View::assign("lat", $marker[1]);
        }

        View::assign("zoom", $zoom);
        View::assign("val", input('get.val', ''));
        return View::fetch();
    }


    /**
     * 区域范围标注
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function range(){
        $station_id  =  input('get.station_id', 0,'intval');

        $api_key = array('7D2BZ-QYF6I-ELRGY-55KNI-W2K27-EVB6V','PORBZ-63C3F-WC2J5-JTBEB-BW5DQ-RGBCD','QZTBZ-4K4WR-7UDWH-WXGV2-ZYDYO-TNFD6','CIWBZ-RZVC2-AVEU4-C74CH-7ORLF-AIBNF');
        View::assign("keys", $api_key[array_rand($api_key)]);
        $station = [];
        if($station_id>0){
            $station = Db::name('water_station')->where('id',$station_id)->field('id,city_id,service_area')->find();
        }

        if(isset($station['city_id']) && $station['city_id']){
            $city_id = $station['city_id'];
        }

        $service_area = $marker = '';

        if($station){
            $service_area = $station['service_area'];
        }

        if($service_area){
            $marker = explode(',',$service_area);
        }
        View::assign("val", input('get.val', ''));
        View::assign("marker", $marker);
        return View::fetch();
    }

    /**
     * @param array $coordinate1  起点经纬度数组
     * @param array $coordinate2  终点经纬度 数组
     * @param int $unit           单位 1:米 2:公里
     * @param int $decimal        精度 保留小数位数
     * @return float              距离
     */
    function getDistance($coordinate1, $coordinate2, $unit = 2, $decimal = 2){
        $radLat1 = deg2rad($coordinate1[0]); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($coordinate2[0]);
        $radLng1 = deg2rad($coordinate1[1]);
        $radLng2 = deg2rad($coordinate2[1]);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;

        if($unit==2){
            $s = $s / 1000;
        }
        return round($s, $decimal);
    }

    /**
     * 腾讯位置服务|根据地址获取当前地址坐标
     * @param $address
     * @return mixed|string
     */
    public function addressGetCoordinate($address)
    {
        $header[] = 'Referer: http://lbs.qq.com/webservice_v1/guide-suggestion.html';
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36';
        $url = "http://apis.map.qq.com/ws/place/v1/suggestion/?&key=".$this->KEY."&keyword=" . $address;

        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        $result = json_decode($output, true);
        if($result['status'] == 0 && count($result['data']) > 0 ){
            $result = implode('|', $result['data'][0]['location']); #将数组合成字符串
            return $result;
        }
    }

    /**
     * 获取当前坐标
     * @return mixed|string
     */
    public function getCoordinate(){
        $address = $this->getAddress();
        $coordinate = $this->addressGetCoordinate($address);
        return $coordinate;
    }

    public function get2(){
        $key_arr = array('7D2BZ-QYF6I-ELRGY-55KNI-W2K27-EVB6V','PORBZ-63C3F-WC2J5-JTBEB-BW5DQ-RGBCD','QZTBZ-4K4WR-7UDWH-WXGV2-ZYDYO-TNFD6','CIWBZ-RZVC2-AVEU4-C74CH-7ORLF-AIBNF');
        $key     = $key_arr[array_rand($key_arr)];
        $ip      = realIp();
        $header[] = 'Referer: https://lbs.qq.com/webservice_v1/guide-ip.html';
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.139 Safari/537.36';
        $url = "https://apis.map.qq.com/ws/location/v1/ip?ip=".$ip."&key=".$key;
        $result = file_get_contents($url);

        $result = json_decode($result,true);
        $json = [];
        if(isset($result['status']) && $result['status'] == 0 && $result['result']){
            $data = $result['result'];
            $json =  ['status'=>1,'city_name'=>$data['ad_info']['city'],'location'=>$data['location']];
        }else{
            $json =  ['status'=>0];
        }
    }

    /**
     * 获取当前地址
     * @return string
     */
    function getAddress(){
        $result = $this->getCity();
        //城市详情
        if( isset($result['status']) && $result['status'] == 0){
            return $result['content']['address'];
        }
    }

    /**
     * 百度公共平台|获取城市及其他信息
     * @return false|mixed|string
     */
    public  function getCity(){
        $IP = $_SERVER["REMOTE_ADDR"];#获取IP
        $url = 'http://api.map.baidu.com/location/ip?ip='.$IP.'&ak='. $this->AK .'&coor=bd09ll';
        $result = file_get_contents($url);
        $result = json_decode($result,true);
        if($result){
            return $result;
        }
    }

    /**
     * 腾讯位置服务|导航
     * @param string $address 导航地址
     * @param string $end_coordinate 导航坐标
     */
    function navigation($address = '', $end_coordinate = ''){

        $coordinate = $this->getCoordinate();#获取当前坐标字符串 起点坐标
        $coordinateArr = [];
        if($coordinate){
            $coordinateArr = explode('|', $coordinate);#将字符串转换成数组
        }
        if(!isset($coordinateArr[0]) || !isset($coordinateArr[1])){
            exit('获取当前定位失败');
        }
        $endCoordinateArr = explode('|', $end_coordinate);#将字符串转换成数组
        $url = 'https://apis.map.qq.com/uri/v1/routeplan?type=drive&from=你的位置&fromcoord='.$coordinateArr[0].','.$coordinateArr[1].'&to='.$address.'&tocoord='.$endCoordinateArr[0].','.$endCoordinateArr[1].'&policy=1&referer='.$this->KEY;
        header('location:'.$url);
        exit;
    }
}