<?php

namespace DifferDev;

use DifferDev\Exception\FailValidationException;
use DifferDev\Interface\ValidationHandler;

class IsGreaterThan implements ValidationHandler
{
    protected float|string $compared;

    public function __construct(float|string $compared) {
        $this->compared = $compared;
    }

    public function execute(string $value): true
    {
        if (!($value > $this->compared)) {
            throw new FailValidationException('Value is not greater than ' . $this->compared);
        }

        return true;
    }
}