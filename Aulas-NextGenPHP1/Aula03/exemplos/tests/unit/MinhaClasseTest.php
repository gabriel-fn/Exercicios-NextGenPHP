<?php

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass('Test')]
class MinhaClasseTest extends TestCase
{
    public function testNossoPrimeiroTesteUnitario()
    {
        $valor = 1;
        $resultado = 100 + 1;
        $this->assertEquals(101, $resultado);
    }

    public function testNossoSegundoTesteUnitario()
    {
        $valor = 1;
        $resultado = 55 + 1;
        $this->assertEquals(56, $resultado);
    }
}
