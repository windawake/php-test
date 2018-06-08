<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/1/16
 * Time: 9:53
 */
require_once 'vendor/autoload.php';

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\UriTemplate;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\Client;

//$request = new Request('GET', '/get.php');
//$content = "phper bug";

//$response = new Response(404);
//$exception = new RequestException($content, $request, $response);

//$response  = new Response(500, [], $content);
//$exception = RequestException::create($request, $response);

//$response  = new Response(500, ['Content-Type' => 'image/gif'], $content = base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7') // 1x1 gif
//);
//$exception = RequestException::create($request, $response);
//var_dump($exception->getMessage());


//测试cookie
//$jar = CookieJar::fromArray([
//    'foo' => 'bar',
//    'baz' => 'bam',
//], 'example.com');
//$response = new Response(200, [
//    'Set-Cookie' => "fpc=1234; expires=Fri, 02-Mar-2019 02:17:40 GMT;",
//]);
//$request  = new Request('GET', 'http://php.win');
//$jar      = new CookieJar();
//$jar->extractCookies($request, $response);
//var_dump($jar);
//exit;

$client = new Client();
//$jar1   = CookieJar::fromArray([
//    'userId' => '2234',
//    'token'  => '22340',
//], 'php.win');

$jar2      = new CookieJar();
$setCookie = new SetCookie([
    'Name'    => 'userId',
    'Value'   => '2234',
    'Domain'  => 'php.win',
    'Expires' => time() - 10,
]);

$jar2->setCookie($setCookie);

//var_dump($jar2->getCookieByName('userId'));
//exit;

$response = $client->request('GET', 'http://php.win/get2.php', [
    //'body'    => '{"lesson":"chinese"}',
    //'headers' => ['Content-Type' => 'application/json'],
    'cookies' => $jar2,
]);


$easy          = new \GuzzleHttp\Handler\EasyHandle();
$easy->request = new Request('GET', 'http://php.app/get.php');

var_dump(get_class_methods($easy));
exit;

var_dump($response->getBody()->getContents());
