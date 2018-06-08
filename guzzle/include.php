<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/2/9
 * Time: 10:23
 */

//debug_print_backtrace();

function a_test($str)
{
    $debug = $str;
    var_dump(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT));
}

a_test('friend');