<?php

use DifferDev\Exception\FailValidationException;
use DifferDev\IsGreaterThan;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IsGreaterThan::class)]
final class IsGreaterThanTest extends \PHPUnit\Framework\TestCase
{
    public function testClassIsGreaterThanShouldReturnTrue(): void
    {
        $greaterNumber = '302';
        $isGreaterThan = new IsGreaterThan(200);
        $result = $isGreaterThan->execute($greaterNumber);

        $this->assertTrue($result);
    }

    public function testClassIsGreaterThanThrowException(): void
    {
        $this->expectException(FailValidationException::class);
        
        $notGreaterNumber = '302';
        $isGreaterThan = new IsGreaterThan(400);
        $isGreaterThan->execute($notGreaterNumber);
    }
}