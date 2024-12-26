<?php

use DifferDev\Exception\FailValidationException;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IsFloat::class)]
final class IsFloatTest extends \PHPUnit\Framework\TestCase
{
    public function testClassIsFloatShouldReturnTrue() 
    {
        $floatNumber = '122.44';
        $isFloat = new IsFloat();
        $result = $isFloat->execute($floatNumber);

        $this->assertTrue($result);
    }

    public function testClassIsFloatThrowException() 
    {
        $this->expectException(FailValidationException::class);
        
        $notFloatNumber = '302';
        $isFloat = new IsFloat();
        $isFloat->execute($notFloatNumber);
    }
}