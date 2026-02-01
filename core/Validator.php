<?php
namespace Core;
class Validator
{
    // Checks if a string meets length requirements
    public static function string($value, $min = 1, $max = INF): bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    // Checks valid email format
    public static function email($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}