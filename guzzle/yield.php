<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/2/5
 * Time: 18:10
 */

require_once '../vendor/autoload.php';

//demo01
//function xrange($start, $end, $step = 1)
//{
//    for ($i = $start; $i <= $end; $i += $step) {
//        yield $i;
//    }
//}
//
//$m1     = memory_get_usage();
//$t1     = microtime(true);
//$arrOne = xrange(1, 1000);
//foreach ($arrOne as $item) {
//
//}
//
//$m2     = memory_get_usage();
//$t2     = microtime(true);
//$arrTwo = range(1, 1000);
//foreach ($arrTwo as $item) {
//
//}
//
//$m3 = memory_get_usage();
//$t3 = microtime(true);
//
//var_dump($m1, $m2, $m3);
//var_dump($t2 - $t1, $t3 - $t2);


//demo02
//function logger($fileName)
//{
//    $fileHandle = fopen($fileName, 'a');
//    while (true) {
//        fwrite($fileHandle, yield . PHP_EOL);
//    }
//}
//
//$logger = logger(__DIR__ . '/yield.log');
//$logger->send('donkey');
//$logger->send('dog');


//demo03
class Task
{
    protected $taskId;
    protected $coroutine;
    protected $sendValue        = null;
    protected $beforeFirstYield = true;

    public function __construct($taskId, Generator $coroutine)
    {
        $this->taskId    = $taskId;
        $this->coroutine = $coroutine;
    }

    public function getTaskId()
    {
        return $this->taskId;
    }

    public function setSendValue($sendValue)
    {
        $this->sendValue = $sendValue;
    }

    public function run()
    {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        } else {
            $retval          = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;
            return $retval;
        }
    }

    public function isFinished()
    {
        return !$this->coroutine->valid();
    }
}
