<?php

namespace Core;

class Validator
{
    public static function string($str, $min = 1, $max = 255)
    {
        $parsed = strlen(trim($str));
        return $parsed >= $min and $parsed <= $max;

    }
    public static function number($num)
    {

        if ($num == null || !is_numeric($num)) {
            error_log($num);
            return false;
        } else {
            return true;
        }

    }
}
