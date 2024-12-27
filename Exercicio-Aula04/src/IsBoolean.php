<?php
declare(strict_types=1);

namespace DifferDev;

use DifferDev\Exception\FailValidationException;
use DifferDev\Interface\ValidationHandler;

class IsBoolean implements ValidationHandler
{
    public function execute(string $value): true
    {
        if (0 == preg_match('/^(true|false|1|0)$/i', $value)) {
            throw new FailValidationException('Value is not boolean.');
        }
        
        return true;
    }
}