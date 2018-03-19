<?php
namespace MyApp\Component\Validator;

class Validator
{

    /**
     * Everything receibed are integer numbers
     *
     * @param      array    of values
     *
     * @return     boolean
     */
    public function areNumbers(array $arr_param){
        foreach ($arr_param as $value) {
            if($value == 0) {
                continue;
            }
            if (! filter_var($value, FILTER_VALIDATE_INT)) {
                return false;
            }
        }
        return true;
    }
}