<?php
// +----------------------------------------------------------------------
// | TT[ 管理系统 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2020~2030 https://www.x.com All rights reserved
// +----------------------------------------------------------------------
// | Licensed TT[管理系统]并不是自由软件，未经许可不能去掉TT相关版权及二次开发
// +----------------------------------------------------------------------
// | Author: TT
// +----------------------------------------------------------------------
namespace core\utils;
class Geohash {
    const coding = "0123456789bcdefghjkmnpqrstuvwxyz";
    /**
     * 解密坐标
     * @param $hash
     * @return array
     */
    public static function decode($hash) {
        $codingMap = [];
        for($_n = 0; $_n < 32; $_n++) {
            $codingMap[substr(self::coding, $_n, 1)] = str_pad(decbin($_n), 5, "0", STR_PAD_LEFT);
        }
        $binary = "";
        $hl = strlen($hash);
        for($i = 0; $i < $hl; $i++) {
            $binary .= $codingMap[substr($hash, $i, 1)];
        }
        $bl = strlen($binary);
        $blat = "";
        $blong = "";
        for ($i = 0; $i < $bl; $i++) {
            if ($i%2) {
                $blat = $blat.substr($binary, $i, 1);
            } else {
                $blong = $blong.substr($binary, $i, 1);
            }
        }
        $lat     = self::binDecode($blat, -90, 90);
        $long    = self::binDecode($blong, -180, 180);
        $latErr  = self::calcError(strlen($blat), -90, 90);
        $longErr = self::calcError(strlen($blong), -180, 180);

        $latPlaces  = max(1, -round(log10($latErr))) - 1;
        $longPlaces = max(1, -round(log10($longErr))) - 1;
        $lat  = round($lat, $latPlaces);
        $long = round($long, $longPlaces);
        return ['lat'=>$lat,'long'=>$long];
    }

    /**
     * 生产 Geohash
     * @param $lat
     * @param $long
     * @return string
     */
    public static function encode($lat,$long) {
        $plat = self::precision($lat);
        $lat_bits = 1;
        $err = 45;
        while($err > $plat) {
            $lat_bits++;
            $err /= 2;
        }
        $plong = self::precision($long);
        $long_bits = 1;
        $err = 90;
        while($err > $plong) {
            $long_bits++;
            $err /= 2;
        }
        $bits = max($lat_bits,$long_bits);
        $long_bits = $bits;
        $lat_bits  = $bits;
        $add_long  = 1;
        while (($long_bits+$lat_bits) % 5 != 0) {
            $long_bits += $add_long;
            $lat_bits += !$add_long;
            $add_long = !$add_long;
        }
        $blat   = self::binEncode($lat, -90, 90, $lat_bits);
        $blong  = self::binEncode($long, -180, 180, $long_bits);
        $binary = "";
        $use_long = 1;
        while (strlen($blat)+strlen($blong)) {
            if ($use_long) {
                $binary = $binary.substr($blong, 0, 1);
                $blong = substr($blong, 1);
            } else {
                $binary = $binary.substr($blat, 0, 1);
                $blat = substr($blat, 1);
            }
            $use_long = !$use_long;
        }
        $hash = "";
        for ($i = 0; $i < strlen($binary); $i += 5) {
            $n = bindec(substr($binary, $i, 5));
            $hash = $hash . self::coding[$n];
        }
        return $hash;
    }

    private static function calcError($bits, $min, $max) {
        $err = ($max - $min) / 2;
        while ($bits--) {
            $err /= 2;
        }
        return $err;
    }

    private static function precision($number) {
        $precision = 0;
        $pt = strpos($number,'.');
        if ($pt !== false) {
            $precision = -(strlen($number) - $pt - 1);
        }
        return pow(10, $precision) / 2;
    }

    private static function binEncode($number, $min, $max, $bitcount) {
        if ($bitcount == 0) {
            return "";
        }
        $mid = ($min + $max) / 2;
        if ($number > $mid) {
            return "1" . self::binEncode($number, $mid, $max, $bitcount - 1);
        }
        return "0" . self::binEncode($number, $min, $mid, $bitcount - 1);
    }

    private static function binDecode($binary, $min, $max) {
        $mid = ($min + $max) / 2;

        if (strlen($binary) == 0) {
            return $mid;
        }
        $bit = substr($binary, 0, 1);
        $binary = substr($binary, 1);

        if ($bit == 1) {
            return self::binDecode($binary, $mid, $max);
        }
        return self::binDecode($binary, $min, $mid);
    }
}
/*
    DEMO
    //求出附近，然后排序
    $geohash = Geohash::encode($n_latitude,$n_longitude);//当前 geohash值
    //附近，参数n代表Geohash，精确的位数，也就是大概距离；n=6时候，大概为附近1千米
    $n = $_GET['n'];
    $like_geohash = substr($n_geohash, 0, $n);
    $sql  = 'select * from shop where geohash like "'.$like_geohash.'%"';
    $data = $mysql->queryAll($sql);
    //算出实际距离
    foreach($data as $key =>$val) {
        $distance = getDistance($n_latitude, $n_longitude, $val['latitude'], $val['longitude']);
        $data[$key]['distance'] = $distance;
        //排序列
        $sortdistance[$key] = $distance;
    }
    //距离排序
    array_multisort($sortdistance,SORT_ASC,$data);
    //结束
    $e_time = microtime(true);
    echo $e_time - $b_time;
    var_dump($data);
*/