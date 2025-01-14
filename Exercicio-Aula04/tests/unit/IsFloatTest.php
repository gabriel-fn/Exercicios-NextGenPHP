<?php

use DifferDev\Exception\FailValidationException;
use DifferDev\IsFloat;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IsFloat::class)]
final class IsFloatTest extends \PHPUnit\Framework\TestCase
{
    public function testClassIsFloatShouldReturnTrue(): void
    {
        $floatNumber = '122.44';
        $isFloat = new IsFloat();
        $result = $isFloat->execute($floatNumber);

        $this->assertTrue($result);
    }

    public function testClassIsFloatThrowException(): void
    {
        $this->expectException(FailValidationException::class);
        
        $notFloatNumber = '302';
        $isFloat = new IsFloat();
        $isFloat->execute($notFloatNumber);
    }
}