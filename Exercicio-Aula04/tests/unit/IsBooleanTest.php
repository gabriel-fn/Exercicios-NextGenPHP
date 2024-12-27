<?php

use DifferDev\Exception\FailValidationException;
use DifferDev\IsBoolean;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IsBoolean::class)]
final class IsBooleanTest extends \PHPUnit\Framework\TestCase
{
    public function testClassIsBooleanShouldReturnTrue(): void
    {
        $booleanValue = 'true';
        $isBoolean = new IsBoolean();
        $result = $isBoolean->execute($booleanValue);

        $this->assertTrue($result);
    }

    public function testClassIsBooleanThrowException(): void
    {
        $this->expectException(FailValidationException::class);
        
        $notBooleanValue = '302';
        $isBoolean = new IsBoolean();
        $isBoolean->execute($notBooleanValue);
    }
}