<?php
declare(strict_types=1);

namespace DifferDev;

use DifferDev\Exception\FailValidationException;
use DifferDev\Interface\ValidationHandler;

class IsEven implements ValidationHandler
{
    public function execute(mixed $value): true
    {
        if ((float)$value % 2) {
            throw new FailValidationException('Value is not even.');
        }
        
        return true;
    }
}