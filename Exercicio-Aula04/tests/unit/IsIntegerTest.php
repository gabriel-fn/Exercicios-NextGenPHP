<?php

use DifferDev\Exception\FailValidationException;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IsInteger::class)]
final class IsIntegerTest extends \PHPUnit\Framework\TestCase
{
    public function testClassIsIntegerShouldReturnTrue() 
    {
        $integerNumber = '1';
        $isInteger = new IsInteger();
        $result = $isInteger->execute($integerNumber);

        $this->assertTrue($result);

        $integerNumber2 = '-2';
        $isInteger2 = new IsInteger();
        $result2 = $isInteger2->execute($integerNumber2);

        $this->assertTrue($result2);
    }

    public function testClassIsIntegerThrowException() 
    {
        $this->expectException(FailValidationException::class);
        
        $notIntegerNumber = '123.22';
        $isInteger = new IsInteger();
        $isInteger->execute($notIntegerNumber);
    }
}