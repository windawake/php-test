<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;

$client = new Client();
//改进项目
$option   = ['base_uri' => 'http://php.app'];
$client   = new Client($option);
$response = $client->request('get', 'get1.php');
var_dump(strval($response->getBody()));exit;

//$request  = new Request('POST', 'http://php.win/post.php', [], $body);
//$response = $client->send($request);
//var_dump($response->getBody()->getContents());

//日志测试
//class Logger implements LoggerInterface
//{
//    use \Psr\Log\LoggerTrait;
//    public $output;
//
//    public function log($level, $message, array $context = [])
//    {
//        $this->output .= "[{$level}] {$message} " . json_encode($context, JSON_UNESCAPED_UNICODE) . "\n";
//    }
//}
//
//$logger = new Logger();
//$logger->info('记录请求', ['lesson' => '英语', 'family' => ['张三', '李四']]);
//var_dump($logger->output);
//exit;

//格式化信息
//$request   = new Request('post', 'http://php.win/post.php');
//$response  = $client->send($request, ['timeout' => 3, 'form_params' => ['lesson' => 'phper']]);
//$formatter = new MessageFormatter();
//$result    = $formatter->format($request, $response);
//var_dump($result);
//exit;

//$log       = Middleware::log($logger, $formatter, 'debug');
//var_dump($log);
//exit;

//异步请求 确实请求速度快了很多
$arrRequest = [];
for ($i = 0; $i < 4; $i++) {
    $arrRequest[] = new Request('GET', 'http://php.win/get1.php');
}

//$startTime = microtime(true);
//foreach ($arrRequest as $request) {
//    $response = $client->send($request);
//}

$results = Pool::batch($client, $arrRequest);
var_dump($results);
exit;

//var_dump($results[0]->getBody()->getContents());

//$endTime = microtime(true);
//var_dump($endTime - $startTime);
//exit;
