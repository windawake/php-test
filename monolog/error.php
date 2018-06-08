<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/1/31
 * Time: 19:14
 */

ini_set('display_errors', 'on');
error_reporting(-1);


//ini_set('display_errors', 'on');
//demo01
function my_error_handler($errno, $errstr, $errfile, $errline)
{
    //如果不是管理员就过滤实际路径
    //if (!false) {
    //    $errfile = str_replace(getcwd(), "", $errfile);
    //    $errstr  = str_replace(getcwd(), "", $errstr);
    //}

    if (!error_reporting()) {
        return false;
    }

    switch ($errno) {
        case E_ERROR:
            echo "ERROR: [ID $errno] $errstr (Line: $errline of $errfile)";
            echo "程序已经停止运行，请联系管理员。";
            //遇到Error级错误时退出脚本
            exit;
            break;
        case E_WARNING:
            echo "WARNING: [ID $errno] $errstr (Line: $errline of $errfile)";
            break;
        default:
            var_dump(['错误代码' => $errno, '错误内容' => $errstr, '错误文件' => $errfile, '错误行数' => $errline]);
            //不显示Notice级的错误
            break;
    }
}

set_error_handler("my_error_handler");


//try {
//    $file
//} catch (\Exception $e) {
//    trigger_error($e->getMessage());
//}
$arrError = [
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


var_dump($arrError, E_ALL & ~E_DEPRECATED & ~E_STRICT);
exit;

//$a['123'];

//demo02
//class App
//{
//    function customError($errno, $errstr, $errfile, $errline)
//    {
//        var_dump(['错误代码' => $errno, '错误内容' => $errstr, '错误文件' => $errfile, '错误行数' => $errline]);
//        exit;
//    }
//}
//
//set_error_handler(["App", "customError"]);
//
//trigger_error("自定义错误");
