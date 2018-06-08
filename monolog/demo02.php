<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/1/29
 * Time: 13:55
 */

//demo01
//var_dump(date_default_timezone_get());
//$timezone = new \DateTimeZone(date_default_timezone_get());
//$now = DateTime::createFromFormat('Y', '2018', $timezone);
//var_dump($timezone, $now);

//demo02
//trigger_error("cannot divide by zero", E_USER_ERROR);

//demo03
//error_reporting(E_ALL);
//a(); // 将会抛出一个 PHP Fatal error，在没有throwable 之前，这种错误将无法被捕获

//demo04
//error_reporting(E_ALL);
//set_error_handler(function ($code, $error, $file, $line) {
//    // 当错误被屏蔽时，不再输出 ErrorException
//    if (!(error_reporting() & $code)) {
//        return false;
//    }
//
//    throw new ErrorException($error, $code, 0, $file, $line);
//});
//
//try {
//    a(); // 将会抛出一个 PHP Fatal error
//} catch (Exception $e) {
//    var_dump('Exception: ' . $e->getMessage());
//} catch (Throwable $e) {
//    var_dump('Throwable: ' . $e->getMessage());
//}
