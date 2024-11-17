<?php

namespace tests\unit;

use Logger\Enums\LogLevel;
use Logger\FileLoggerStorageHandler;
use Logger\Interfaces\LoggerStorageHandlerInterface;
use Logger\Logger;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Logger::class)]
class LoggerTest extends TestCase
{
    protected LoggerStorageHandlerInterface $fileLoggerStorageHandlerStub; 

    public function setUp(): void
    {
        $this->fileLoggerStorageHandlerStub = $this->createStub(FileLoggerStorageHandler::class);
    }

    public function testShouldLogInFile()
    {
        $this->fileLoggerStorageHandlerStub->method('handle')
            ->willReturn(true);

        $logger = new Logger($this->fileLoggerStorageHandlerStub);

        $result = $logger->log(LogLevel::DANGER, 'Message 1', ['data1' => 1, 'data2' => 2]);

        $this->assertEquals(true, $result);
    }
}