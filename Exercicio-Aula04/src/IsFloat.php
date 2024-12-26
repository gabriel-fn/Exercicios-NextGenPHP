<?php
declare(strict_types=1);

namespace DifferDev;

use DifferDev\Exception\FailValidationException;
use DifferDev\Interface\ValidationHandler;

class IsFloat implements ValidationHandler
{
    public function execute(string $value): true
    {
        if (false === (bool)preg_match('/^\d+\.\d+([eE][+-]?\d+)?$/', $value)) {
            throw new FailValidationException('Value is not float.');
        }
        
        return true;
    }
}