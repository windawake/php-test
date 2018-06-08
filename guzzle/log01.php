<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/1/16
 * Time: 11:47
 */

require_once "vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('storage/logs/my.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');
