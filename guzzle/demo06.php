<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/2/11
 * Time: 12:42
 */

//$sum = 0;
//for ($i = 1; $i <= 100; $i++) {
//    $sum += 0.1;
//}
//
//var_dump($sum);

echo $_SERVER['HTTP_HOST'];
//echo $_SERVER['REQUEST_URI'];
$getIp = $_SERVER["REMOTE_ADDR"];
$getIp = '202.36.20.30';
echo 'IP:', $getIp;
echo '<br/>';
$content = file_get_contents("http://api.map.baidu.com/location/ip?ak=YWNt8VcHK7Goj1yljLlMVHnWl6ZWS26t&ip={$getIp}&coor=bd09ll");
$json    = json_decode($content);
var_dump($json);
exit;

echo 'log:', $json->{'content'}->{'point'}->{'x'};//按层级关系提取经度数据
echo '<br/>';
echo 'lat:', $json->{'content'}->{'point'}->{'y'};//按层级关系提取纬度数据
echo '<br/>';
print $json->{'content'}->{'address'};//按层级关系提取address数
echo $json->{'content'}->{'address_detail'}->{'city_code'};
print_r($json);