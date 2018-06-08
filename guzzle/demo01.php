<?php
require_once '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;

/**
 * 将 request 请求轮换为 curl 命令
 * @param  \Psr\Http\Message\RequestInterface $request
 * @return string
 */
function request_as_curl($request)
{
    try {
        $headers = $request->getHeaders();
        unset($headers['Content-Length'], $headers['User-Agent'], $headers['Host']);
        foreach ($headers as $key => $value) {
            $headers[$key] = sprintf("-H '%s'", $key . ":" . $request->getHeaderLine($key));
        }

        $headersLine = implode(' ', $headers);

        $str = sprintf("curl -X %s '%s' %s ", $request->getMethod(), $request->getUri(), $headersLine);

        if ($request->getMethod() == 'POST') {
            $content = strval($request->getBody());

            // 尝试使用 json_encode 来探测数据是否有效字符
            json_encode($content);
            if ($content && json_last_error() === JSON_ERROR_NONE) {
                return sprintf("%s -d '%s'", $str, str_replace("'", "\'", $content));
            }
        }

        return $str;
    } catch (\Exception $e) {
        var_dump($e);
    }

}

//$url = 't0110.eformax.com:8061/v1/messages?dest=3549295';
//
//$json = '{
//"TTL":36000,
//"MsgSrc":"SYSTEM",
//"MsgType":1,
//"AppName":"ShengHuo",
//"AppVer":0,
//"AppMarket":0,
//"DeviceKey":"",
//"OS":"",
//"OsVer":0,
//"BodyList":[
//  {
//    "Language":"zh",
//    "Title":"app消息推送",
//    "Brief":"副标题",
//    "Image":"https://static.jrq.com/uploads/image/oa/2017/12/15/5a338abab6981phpHf5OCQ.png",
//    "Content":"push api 推送脚本————测试内容2222222",
//    "ExtraData":"{\"scheme\":\"https:\/\/m.baidu.com\"}"
//  }
//]
//}';
//$arr = $json;

//$options['headers'] = ['access' => 'ok'];
//$response           = $client->request('HEAD', 'http://php.win/head.php', $options);

$stack       = \GuzzleHttp\HandlerStack::create();
$curlHandler = new \GuzzleHttp\Handler\CurlHandler();
$stack->setHandler($curlHandler);
$mapRequest = \GuzzleHttp\Middleware::mapRequest(function (GuzzleHttp\Psr7\Request $request) {
    //比较完美的写法
    //echo(request_as_curl($request));
    $logger = new \Monolog\Logger('request');
    $logger->pushHandler(new \Monolog\Handler\StreamHandler('logs/request.log'));
    $logger->info(request_as_curl($request));
    return $request;
});

$stack->push($mapRequest);
$mapResponse = \GuzzleHttp\Middleware::mapResponse(function (GuzzleHttp\Psr7\Response $response) {
    // $response->getReasonPhrase()
    //var_dump($response);
    //exit;
    $logger = new \Monolog\Logger('response');
    $logger->pushHandler(new \Monolog\Handler\StreamHandler('logs/response.log'));
    $logger->info(strval($response->getBody()));
    return $response;
});

$stack->push($mapResponse);

function onStats()
{
    return (function (\GuzzleHttp\TransferStats $stats) {
        $errNo = $stats->getHandlerErrorData();
        if ($errNo) {
            $arrErr = [
                'curl'          => request_as_curl($stats->getRequest()),
                'transfer_time' => $stats->getTransferTime(),
                'error'         => curl_strerror($errNo),
            ];
            $logger = new \Monolog\Logger('http_error');
            $logger->pushHandler(new \Monolog\Handler\StreamHandler('logs/http_error.log'));
            $logger->info('错误：', $arrErr);
            exit;
        }
    });
}

$handler = $stack;
$client  = new Client([
    'handler'  => $handler,
    'on_stats' => onStats(),
]);

$options = [
    'query'                 => ['desc' => 'shopping'],
    RequestOptions::TIMEOUT => 2,

];

// $response = $client->request('GET', 'http://php.app/guzzle/get1.php', $options);

// $text1 = strval($response->getBody());

// var_dump($text1);
// exit;

//$response = $client->get('http://php.app/get.php', ['query' => ['desc' => 'shopping']]);

// $response = $client->request('POST', 'http://php.app/get.php', ['form_params' => ['desc' => 'subway']]);

//$response = $client->request('POST', 'http://php.app/get.php', ['json' => ['lesson' => 'phper']]);

//$response = $client->request('POST', 'http://php.app/post.php', [
//    'body'    => '{"lesson":"chinese"}',
//    'headers' => ['Content-Type' => 'application/json', 'App-Version' => '2.0.1'],
//]);

//application/x-www-form-urlencoded提交方式
//$response = $client->request('POST', 'http://php.app/post.php', [
//    'body'    => 'foo=bar+bam&baz%5Bboo%5D=qux',
//    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded', 'App-Version' => '2.0.1'],
//]);

//multipart / form - data提交方式
// $response = $client->request('POST', 'http://php.app/post.php', [
//     'multipart' => [
//         [
//             'name'     => 'chapter',
//             'contents' => 'one',
//         ],
//         [
//             'name'     => 'desc',
//             'contents' => 'stable',
//         ],
//     ],
// ]);

//multipart/form-data提交方式
//$response = $client->request('POST', 'http://php.app/get.php', [
//    'multipart' => [
//        [
//            'name'     => 'file',
//            'contents' => fopen('03.jpg', 'r'),
//            'filename' => 'feng.jpg',
//        ],
//    ],
//]);
// var_dump($response->getBody()->getContents());

$response = $client->request('POST', 'http://php.win/post.php', [
   'form_params' => ['lesson' => 'phper'],
   'json' => ['lesson' => 'phper'],
]);


//body如何使用
//$response = $client->request('POST', 'http://php.win/post.php', [
//    'body'    => '{"lesson":"chinese"}',
//    'headers' => ['Content-Type' => 'application/json'],
//]);

//$response = $client->request('POST', 'http://php.win/post.php', [
//    'body'    => 'foo=bar+bam&baz%5Bboo%5D=qux',
//    //'body'    => 'foo=bar bam&baz[boo]=qux',
//    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
//]);

//var_dump($response->getBody()->getContents());
//
//var_dump(request_as_curl($request));

// Create a PSR-7 request object to send
// $headers = ['X-Foo' => 'Bar'];
// $body    = 'Hello!';
// $request = new Request('HEAD', 'http://php.win/head.php', $headers, $body);
// $response = $client->send($request);

//$request = new Request('GET', 'http://10.1.17.45:8090/mer/mMerInfoCC/listApp?currentPage=1&pageSize=10&email=zhouyonglong%40jrq.com');
//$response = $client->send($request, ['timeout' => 3, 'form_params' => ['lesson' => 'phper']]);

//var_dump($response);

//异常不要中止
//$response = $client->request('GET', 'http://php.win/get2.php', ['exceptions' => false]);

//$response = $client->request('GET', 'http://php.win/get2.php');
//var_dump($response->getStatusCode());

//POST另一种写法
//$body     = "lesson=english";
//$request  = new Request('POST', 'http://php.win/post.php', [], $body);
//$response = $client->send($request);

//promise 测试
//$promise = $client->requestAsync('get', 'http://php.win/get3.php', ['exceptions' => false]);
//$promise->cancel();
//var_dump($promise->getState());
//$response = $promise->wait();
//var_dump($promise->getState());
//var_dump($response->getStatusCode());

//$promises = [
//    'bus'  => $client->getAsync('http://php.win/get1.php'),
//    'taxi' => $client->getAsync('http://php.win/get2.php'),
//];
//
//$results = Promise\unwrap($promises);
//var_dump($results['bus']->getBody()->getContents());
//exit;

//$results = Promise\settle($promises)->wait();
//var_dump($results['bus']['value']->getBody()->getContent());

//$result = Promise\promise_for(new Response('200'));

//$fp          = fopen("http://php.win/get1.php", "r");
//$stream_meta = stream_get_meta_data($fp);
//var_dump($stream_meta);

//关联数组生成器
//function gen_one_to_three()
//{
//    for ($i = 1; $i <= 3; $i++) {
//        yield 'field_' . $i => $i * $i;
//    }
//}
//
//$generator = gen_one_to_three();
//foreach ($generator as $key => $value) {
//    echo $key . $value;
//}

//上传图片
//$response = $client->request('POST', 'http://php.win/post.php', [
//    'multipart' => [
//        [
//            'name'     => 'file',
//            'contents' => fopen('03.jpg', 'r'),
//            'filename' => 'feng.jpg',
//        ],
//    ],
//]);
//
//var_dump($response->getBody()->getContents());

//$mock   = new MockHandler([new Response()]);
//$client = new Client(['handler' => $mock]);
//
//$response = $client->request('post', 'http://php.win/post.php', [
//    'form_params' => [
//        'foo' => 'bar bam',
//        'baz' => ['boo' => 'qux'],
//    ],
//]);
//
//$last = $mock->getLastRequest();
//
//var_dump($response->getBody()->getContents());
