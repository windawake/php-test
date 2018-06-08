<?php
require_once '../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TestHandler;
use Monolog\ErrorHandler;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Handler\FirePHPHandler;

$logger     = new Logger('test', [$handler = new TestHandler]);
$errHandler = new ErrorHandler($logger);

$errHandler->registerErrorHandler([E_USER_NOTICE => Logger::EMERGENCY], false);
trigger_error('Foo', E_USER_ERROR);