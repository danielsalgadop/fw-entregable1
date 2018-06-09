<?php

namespace MyApp\Component\Calculator;

class Calculator
{
    public $validator = null;

    public function add(int $v1, int $v2): int
    {
        return $v1 + $v2;
    }
    public function substract(int $v1, int $v2): int
    {
        return $v1 - $v2;
    }
    public function times(int $v1, int $v2): int
    {
        return $v1 * $v2;
    }
    public function divide(int $v1, int $v2): int
    {
        return $v1 / $v2;
    }
}
