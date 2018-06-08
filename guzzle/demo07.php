<?php
/**
 * Created by PhpStorm.
 * User: zhangzibin
 * Date: 2018/2/22
 * Time: 9:46
 */

abstract class Employee{
    abstract function continueToWork();
}

class Sales extends Employee{
    private function makeSalePlan(){
        echo "make sale plan";
    }

    public function continueToWork()
    {
        $this->makeSalePlan();
    }
}

class Market extends Employee{
    private function makeProductPrice(){
        echo "make product price";
    }

    public function continueToWork()
    {
        // TODO: Implement continueToWork() method.
        $this->makeProductPrice();
    }
}

class Enginner extends Employee{

}
