<?php

use DifferDev\Exception\FailValidationException;
use DifferDev\IsEven;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(IsEven::class)]
final class IsEvenTest extends \PHPUnit\Framework\TestCase
{
    public function testClassIsEvenShouldReturnTrue(): void
    {
        $evenNumber = '300';
        $isEven = new IsEven();
        $result = $isEven->execute($evenNumber);

        $this->assertTrue($result);
    }

    public function testClassIsEvenThrowException(): void
    {
        $this->expectException(FailValidationException::class);
        
        $notEvenNumber = '301';
        $isEven = new IsEven();
        $isEven->execute($notEvenNumber);
    }
}