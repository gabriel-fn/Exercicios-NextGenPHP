<?php
declare(strict_types=1);

namespace DifferDev;

class Validator
{
    public static function validateFloat(string $floatValue): bool
    {
        // Regex que valida se é string com número quebrado '3.4'
        return (bool)preg_match('/^\d+\.\d+([eE][+-]?\d+)?$/', $floatValue);
    }

    public static function validateInteger(string $intValue): bool
    {
        return false === self::validateFloat($intValue);
    }

    /**
     * Accepts true, false, TRUE, FALSE, 1 and 0 as string too.
     * @param string $booleanValue
     * @return bool
     */
    public static function validateBoolean(string $booleanValue): bool
    {
        return 1 >= preg_match('/^(true|false|1|0)$/i', $booleanValue);
    }

    public static function validateGreaterThan(float|string $number, float|string $compared): bool
    {
        return $number > $compared;
    }

    public static function validateEven(string $value): bool
    {
        return !((float)$value % 2);
    }
}
