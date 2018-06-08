<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/2/1
 * Time: 18:34
 */

ini_set('display_errors', 'on');
error_reporting(-1);

function my_error_handler($level, $message, $file = '', $line = 0)
{
    //var_dump(error_reporting(), $level, error_reporting() & $level);
    //if (error_reporting() & $level) {
    //    throw new ErrorException($message, 0, $file, $line);
    //}

    $arrError    = [
        'E_ERROR'             => E_ERROR,
        'E_WARNING'           => E_WARNING,
        'E_PARSE'             => E_PARSE,
        'E_NOTICE'            => E_NOTICE,
        'E_CORE_ERROR'        => E_CORE_ERROR,
        'E_CORE_WARNING'      => E_CORE_WARNING,
        'E_COMPILE_ERROR'     => E_COMPILE_ERROR,
        'E_COMPILE_WARNING'   => E_COMPILE_WARNING,
        'E_USER_ERROR'        => E_USER_ERROR,
        'E_USER_WARNING'      => E_USER_WARNING,
        'E_USER_NOTICE'       => E_USER_NOTICE,
        'E_STRICT'            => E_STRICT,
        'E_RECOVERABLE_ERROR' => E_RECOVERABLE_ERROR,
        'E_DEPRECATED'        => E_DEPRECATED,
        'E_USER_DEPRECATED'   => E_USER_DEPRECATED,
        'E_ALL'               => E_ALL,

    ];
    $arrErrorKey = array_flip($arrError);

    var_dump([
        '错误等级' => $arrErrorKey[$level],
        '错误代码' => $level,
        '错误内容' => $message,
        '错误文件' => $file,
        '错误行数' => $line,
    ]);
}

//set_error_handler("my_error_handler");
//set_error_handler(function ($code, $error, $file, $line) {
//    throw new ErrorException($error, $code, 0, $file, $line);
//
//    return true;
//});

try {
    $a['ss'];
} catch (Exception $e) {
    var_dump($e);
    exit;
}
//demo01
trigger_error("error msg", E_USER_NOTICE);
$a['ss'];

//try {
//    //demo02
//    //a(); // 将会抛出一个 PHP Fatal error
//
//
//} catch (Exception $e) {
//    trigger_error($e->getTraceAsString() . ' ' . $e->getTrace() . ' ' . $e->getMessage(), E_USER_NOTICE);
//} catch (Throwable $e) {
//    trigger_error($e->getTraceAsString() . ' ' . $e->getTrace() . ' ' . $e->getMessage(), E_USER_ERROR);
//}