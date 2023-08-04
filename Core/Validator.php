<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
    public static function fecha($value, $format = 'Y-m-d')
    {
        $date = date_parse_from_format($format, $value);
        return $date['error_count'] === 0 && checkdate($date['month'], $date['day'], $date['year']);
    }
}