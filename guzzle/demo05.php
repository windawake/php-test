<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/1/18
 * Time: 18:44
 */
require_once 'vendor/autoload.php';

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\RejectedPromise;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Pool;

$promise = new Promise();
$client  = new Client();

//demo01
//$promise->then(function ($value) {
//    echo 'The promise was fulfilled.';
//}, function ($reason) {
//    echo 'The promise was rejected.';
//});

//demo02
//$promise->then(function ($value) {
//    // Return a value and don't break the chain
//    return "Hello, " . $value;
//})// This then is executed after the first then and receives the value
//// returned from the first then.
//->then(function ($value) {
//    return $value . " continue";
//})->then(function ($value) {
//    echo $value;
//});
// Resolving the promise triggers the $onFulfilled callbacks and outputs
// "Hello, reader".
//$promise->resolve('reader.');

//demo03
//$nextPromise = new Promise();
//
//$promise->then(function ($value) use ($nextPromise) {
//    echo $value;
//    return $nextPromise;
//})->then(function ($value) {
//    echo $value;
//});
//
//// Triggers the first callback and outputs "A"
//$promise->resolve('A');
//// Triggers the second callback and outputs "B"
//$nextPromise->resolve('B');

//demo04
//$promise = new Promise();
//$promise->then(null, function ($reason) {
//    echo $reason;
//});
//$promise->reject('Error!');

//demo05
//$promise = new Promise();
//$promise->then(null, function ($reason) {
//    return new RejectedPromise($reason);
//})->then(null, function ($reason) {
//    echo $reason;
//});
//
//$promise->reject('Error!');

//demo06
//$promise = new Promise(function () {
//    echo "computer";
//});
//$promise->wait();

//demo07
//$promise->resolve('foo');
//echo $promise->wait(); // outputs "foo"

//demo08
//$queue = \GuzzleHttp\Promise\queue();
//$queue->run();

//demo09
//$arrQueue = [
//    function () use ($client) {
//        $response = $client->send(new Request('GET', 'http://php.win/get1.php'));
//        return $response->getBody()->getContents();
//    },
//    function () use ($client) {
//        $response = $client->send(new Request('GET', 'http://php.win/get1.php'));
//        return $response->getBody()->getContents();
//    },
//    function () use ($client) {
//        $response = $client->send(new Request('GET', 'http://php.win/get1.php'));
//        return $response->getBody()->getContents();
//    },
//];
//
//function getQueue($items)
//{
//    foreach ($items as $fuc) {
//        yield $fuc();
//    }
//}
//
//$arrQueue = getQueue($arrQueue);
//var_dump($arrQueue);
//exit;
//
//$startTime = microtime(true);
////foreach ($arrQueue as $queue) {
////    var_dump($queue);
////}
//$endTime = microtime(true);
//var_dump($endTime - $startTime);


//$queue   = \GuzzleHttp\Promise\queue();
//$promise = new Promise([$queue, 'run']);
//
//$arrQueue = [
//    function () use ($promise) {
//        //sleep(3);
//        $promise->resolve('A');
//    },
//    function () use ($promise) {
//        //sleep(3);
//        $promise->resolve('B');
//    },
//    function () use ($promise) {
//        //sleep(3);
//        $promise->resolve('C');
//    },
//];
//
//$startTime = microtime(true);
//foreach ($arrQueue as $queueFuc) {
//    $queue->add($queueFuc);
//}
//echo $promise->wait();
//$endTime = microtime(true);
//var_dump($endTime - $startTime);

$startTime = microtime(true);
//测试
//$queue = \GuzzleHttp\Promise\queue();
//for ($i = 0; $i < 10; $i++) {
//    $queue->add(static function () use ($client) {
//        $client->send(new Request('GET', 'http://php.win/get1.php'));
//    });
//}
//$queue->run();


//异步请求 确实请求速度快了很多
$arrRequest = [];
for ($i = 0; $i < 10; $i++) {
    $arrRequest[] = new Request('GET', 'http://php.win/get1.php');
}
$results = Pool::batch($client, $arrRequest);

$endTime = microtime(true);
var_dump($endTime - $startTime);

//$array = [
//    'lesson' => 'english',
//    'word'   => 'success',
//];

//var_dump(json_encode($array, JSON_PRETTY_PRINT));
//
//function createPromise($value)
//{
//    return new Promise\FulfilledPromise($value);
//}
//
//$promise = Promise\coroutine(function () {
//    $value = (yield createPromise('a'));
//    try {
//        $value = (yield createPromise($value . 'b'));
//    } catch (\Exception $e) {
//        // The promise was rejected.
//    }
//    yield $value . 'c';
//});
//
//// Outputs "abc"
//$promise->then(function ($v) {
//    echo $v;
//});