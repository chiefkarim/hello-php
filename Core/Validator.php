<?php

namespace Core;

class Validator
{
    public static function string($str, $min = 1, $max = INF)
    {
        $parsed = strlen(trim($str));
        return $parsed >= $min and $parsed <= $max;

    }
}
