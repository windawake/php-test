<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/1/29
 * Time: 10:52
 */

require_once '../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\TestHandler;
use Monolog\ErrorHandler;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\IntrospectionProcessor;

//demo01
//$log = new Logger('name');
//$log->pushHandler(new StreamHandler('logs/my.log'), Logger::WARNING);
//
//$log->warning('english', ['one' => 'sunny', 'two' => 'cloudy']);

//demo02
//$handler = new TestHandler();
//$logger  = new Logger('test', [$handler]);
//$errHandler = new ErrorHandler($logger);
//$errHandler->registerErrorHandler([E_USER_NOTICE => Logger::EMERGENCY], false);
//trigger_error('Foo', E_USER_ERROR);
//$records = $handler->getRecords();
//var_dump($records);

//demo03
//$logger  = new Logger('foo');
//$handler = new TestHandler();
//$logger->pushHandler($handler);
//$logger->info('test one');
//$logger->info('test two');
//$records = $handler->getRecords();
//var_dump($records);

//demo04
//$server = [
//    'REQUEST_URI'    => 'A',
//    'REMOTE_ADDR'    => 'B',
//    'REQUEST_METHOD' => 'C',
//    'SERVER_NAME'    => 'F',
//];
//
//$processor = new WebProcessor($server, ['url', 'http_method']);
//var_dump($processor);
//exit;

//demo05
$processor = new IntrospectionProcessor();
$handler   = new TestHandler();
$handler->pushProcessor($processor);
$records = $handler->getRecords();
var_dump($records);

