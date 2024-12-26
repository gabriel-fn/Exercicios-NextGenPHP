<?php

use DifferDev\Exception\FailValidationException;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IsBoolean::class)]
final class IsBooleanTest extends \PHPUnit\Framework\TestCase
{
    public function testClassIsBooleanShouldReturnTrue() 
    {
        $booleanValue = 'true';
        $isBoolean = new IsBoolean();
        $result = $isBoolean->execute($booleanValue);

        $this->assertTrue($result);
    }

    public function testClassIsBooleanThrowException() 
    {
        $this->expectException(FailValidationException::class);
        
        $notBooleanValue = '302';
        $isBoolean = new IsBoolean();
        $isBoolean->execute($notBooleanValue);
    }
}