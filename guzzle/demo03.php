<?php
require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

$mock = new MockHandler([
    new Response(200, ['X-Foo' => 'Bar']),
    new Response(202, ['Content-Length' => 0]),
    new RequestException('Error Communicating with Server', new Request('GET', 'get1.php')),
]);

$handler = HandlerStack::create($mock);
$client  = new Client(['handler' => $handler]);

echo $client->request('GET', 'get1.php')->getStatusCode();
echo "</br>";
echo $client->request('GET', 'get1.php')->getStatusCode();