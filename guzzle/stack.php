<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/2/9
 * Time: 9:58
 */

//function demo
//function fab($n)
//{
//    echo "--n=$n--------" . PHP_EOL;
//    debug_print_backtrace();
//    if ($n == 1 || $n == 0) {
//        return $n;
//    }
//
//    return fab($n - 1) + fab($n - 2);
//}
//
//echo fab(4);

//object demo
//class donkey
//{
//    public function __construct()
//    {
//        debug_print_backtrace();
//    }
//}
//
//$donkey = new donkey();

//require_once 'include.php';


//function generateCallTrace()
//{
//    $e     = new Exception();
//    $trace = explode("\n", $e->getTraceAsString());
//    var_dump($trace);
//    exit;
//
//    // reverse array to make steps line up chronologically
//    $trace = array_reverse($trace);
//    array_shift($trace); // remove {main}
//    array_pop($trace); // remove call to this method
//    $length = count($trace);
//    $result = [];
//
//    for ($i = 0; $i < $length; $i++) {
//        $result[] = ($i + 1) . ')' . substr($trace[$i], strpos($trace[$i], ' ')); // replace '#someNum' with '$i)', set the right ordering
//    }
//
//    return "\t" . implode("\n\t", $result);
//}
//
//function a_test($str)
//{
//    $debug = $str;
//    var_dump(generateCallTrace());
//}
//
//a_test('friend');

function get_caller_info()
{
    $c     = '';
    $file  = '';
    $func  = '';
    $class = '';
    $trace = debug_backtrace();

    if (isset($trace[2])) {
        $file = $trace[1]['file'];
        $func = $trace[2]['function'];
        if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
            $func = '';
        }
    } elseif (isset($trace[1])) {
        $file = $trace[1]['file'];
        $func = '';
    }
    if (isset($trace[3]['class'])) {
        $class = $trace[3]['class'];
        $func  = $trace[3]['function'];
        $file  = $trace[2]['file'];
    } elseif (isset($trace[2]['class'])) {
        $class = $trace[2]['class'];
        $func  = $trace[2]['function'];
        $file  = $trace[1]['file'];
    }
    if ($file != '')
        $file = basename($file);
    $c = $file . ": ";
    $c .= ($class != '') ? ":" . $class . "->" : "";
    $c .= ($func != '') ? $func . "(): " : "";
    return ($c);
}


class single
{
    public function shout()
    {
        var_dump(get_caller_info());
    }
}

class object extends single
{
    public function shout()
    {
        parent::shout();
    }
}

class animal extends object
{
    public function shout()
    {
        parent::shout();
    }
}

class donkey extends animal
{
    public function __construct()
    {

    }

    public function shout()
    {
        parent::shout();

    }
}

$donkey = new donkey();
$donkey->shout();