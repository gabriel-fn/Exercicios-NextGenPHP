<?php
// Código de exemplo de fixtures
use PHPUnit\Framework\TestCase;

final class MyTestCase extends TestCase
{

    public static function setUpBeforeClass(): void { }

    protected function setUp(): void { }
    public function testSeuTesteAqui() { }
    protected function tearDown(): void { }

    public static function tearDownAfterClass(): void { }

}
