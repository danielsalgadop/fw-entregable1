<?php

namespace MyApp\Component\Calculator;


class Calculator
{

    var $validator = null;

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