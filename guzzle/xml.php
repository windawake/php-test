<?php
require_once '../vendor/autoload.php';
use GuzzleHttp\Client;

class Helper
{

    public static function array2xml($arr, $root = 'xml')
    {
        $xml = "<$root>";
        foreach ($arr as $key => $val) {
            $xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
        }
        $xml .= "</$root>";

        return $xml;
    }

    public static function xml2array($xml)
    {
        set_error_handler(function ($n, $s, $f, $l) {});
        $data = @simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        restore_error_handler();

        return json_decode(json_encode($data ?: []), true);
    }

    public static function sign($data, $key)
    {
        unset($data['sign']);

        ksort($data);

        $query = urldecode(http_build_query($data));
        $query .= "&key={$key}";

        return strtoupper(md5($query));
    }
}

$client = new Client;

$option = [
    'mch_id'    => '1480444052',
    'nonce_str' => '5K8264ILTKCH16CQ2502SI8ZNMTM67VS',
];

$sign = Helper::sign($option, 'UeCzPmuueUcEBUCgUsXrcus4wg7WfpeQ');

$option['sign'] = $sign;

$response = $client->request('POST', 'https://apitest.mch.weixin.qq.com/sandboxnew/pay/getsignkey', ['body' => Helper::array2xml($option)]);

$text1 = Helper::xml2array(strval($response->getBody()));
echo "<pre>";
var_dump($text1);
