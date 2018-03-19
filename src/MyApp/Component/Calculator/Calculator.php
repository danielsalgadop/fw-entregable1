<?php

namespace MyApp\Component\Calculator;
// use MyApp\Component\Calculator\Validator;
class CalculatorOriginal
{

    public function add(int $v1, int $v2): int
    {
        return $v1 + $v2;
    }

}


class Calculator
{
/*    public $p1 = 0;
    public $p2 = 0;
    function __construct($p1,$p2) {
        $this->p1 = $p1;
        $this->p2 = $p2;
    }*/

    var $validator = null;
    function __construct() {
        // $this->validator = new Validator;
    }


    function add(int $v1, int $v2): int {
        return $v1 + $v2;
    }
    function substract(int $v1, int $v2): int {
            return $v1 - $v2;
    }
    function times(int $v1, int $v2): int {
        return $v1 * $v2;
    }
    function divide(int $v1, int $v2): int {
        return $v1 / $v2;
    }
}