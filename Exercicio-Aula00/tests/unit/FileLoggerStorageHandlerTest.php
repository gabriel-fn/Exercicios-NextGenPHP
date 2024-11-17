<?php

namespace tests\unit;

use DateTimeImmutable;
use Logger\FileLoggerStorageHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FileLoggerStorageHandler::class)]
class FileLoggerStorageHandlerTest extends TestCase
{
    public function testShouldLogInFile()
    {
        $fileLogger = new FileLoggerStorageHandler('logs/log.txt');

        $result = $fileLogger->handle(new DateTimeImmutable('2024-11-16 21:23:30'), 'DANGER', 'Message 1', ["data1" => 1, "data2" => 2]);

        $fileContent = file_get_contents(dirname(__DIR__, 2).'/storage/logs/log.txt');

        $lastLineContent = end(explode("\n", $fileContent));

        $this->assertEquals(true, $result);

        $this->assertEquals('2024-11-16 21:23:30 [DANGER] : Message 1 {"data1":1,"data2":2}', $lastLineContent);
    }
}