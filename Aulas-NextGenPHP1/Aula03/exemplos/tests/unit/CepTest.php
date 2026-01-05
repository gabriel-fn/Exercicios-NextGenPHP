<?php

use Application\ValueObject\Cep;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

use PHPUnit\Framework\TestCase;

#[CoversClass(Cep::class)]
class CepTest extends TestCase
{
    public static function cepPositiveDataProvider(): array
    {
        return [
            ['02344-222', '02344-222'],
            ['02243-019', '02243-019'],
            ['12345-222', '12345-222']
        ];
    }

    public static function cepNegativeDataProvider(): array
    {
        return [
            ['02344-22', '02344-22'],
            ['0224-019', '0224-019'],
            ['123422', '123422'],
            ['123E4522', '123E4522'],
            ['1234567A', '1234567A']
        ];
    }

    #[DataProvider('cepPositiveDataProvider')]
    public function testClassCepShouldAcceptAValidCep(string $cep, string $expected)
    {
        // 1. criação | setup
        $cep = new Cep($cep);

        $this->assertEquals($expected, $cep->getValue());
    }

    #[DataProvider('cepNegativeDataProvider')]
    public function testClassCepShouldThrowValueException(string $cep, string $expected)
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Cep inválido!");

        $cep = new Cep($cep);
    }
}
