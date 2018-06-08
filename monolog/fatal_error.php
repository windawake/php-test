<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/2/2
 * Time: 17:56
 */
ini_set('display_errors', 'on');
error_reporting(-1);

//demo01
//ini_set('max_execution_time', 1);
//
//function shutdown()
//{
//    $a = error_get_last();
//    if ($a == null)
//        echo "No errors"; else
//        print_r($a);
//
//}
//
//register_shutdown_function('shutdown');
//
//var_dump(ini_get('max_execution_time'));
//exit;
//
//sleep(3);

function exception_handler(\Exception $exception)
{
    echo '<div class="alert alert-danger">';
    echo '<b>Fatal error</b>:  Uncaught exception \'' . get_class($exception) . '\' with message ';
    echo $exception->getMessage() . '<br>';
    echo 'Stack trace:<pre>' . $exception->getTraceAsString() . '</pre>';
    echo 'thrown in <b>' . $exception->getFile() . '</b> on line <b>' . $exception->getLine() . '</b><br>';
    echo '</div>';
}

set_exception_handler('exception_handler');

throw new Exception('Uncaught Exception');
//echo "Not Executed\n";

