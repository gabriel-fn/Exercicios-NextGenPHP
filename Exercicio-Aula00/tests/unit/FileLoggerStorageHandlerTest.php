<?php

namespace tests\unit;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class FileLoggerStorageHandlerTest extends TestCase
{
    public function testShouldLogInFile()
    {
        $fileLogger = new FileLoggerStorageHandler('logs/log.txt');

        $result = $fileLogger->handle(new DateTimeImmutable('2024-11-16 21:23:30'), 'DANGER', 'Message 1', ["data1" => 1, "data2" => 2]);

        $fileContent = file_get_contents(__DIR__.'/storage/logs/log.txt');

        $this->assertEquals(true, $result);

        $this->assertEquals('2024-11-16 21:23:30 [DANGER] : Message 1 {"data1":1,"data2":2}', $fileContent);
    }
}