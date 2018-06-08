<?php
require_once '../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TestHandler;
use Monolog\ErrorHandler;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Handler\FirePHPHandler;


$logger   = new Logger(__METHOD__);
$handler1 = new TestHandler;
$handler2 = new StreamHandler(__DIR__ . '/logs/my_app.log', Logger::DEBUG);

$logger->pushHandler($handler1);
$logger->pushHandler($handler2);
$logger->pushProcessor(function ($record) {
    $record['extra']['win'] = true;

    return $record;
});
$logger->addError('test');
$records = $handler1->getRecords();
var_dump($records);

