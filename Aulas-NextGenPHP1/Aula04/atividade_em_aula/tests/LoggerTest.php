<?php

namespace atividade_aula\tests;

use Logger\Enums\LogLevel;
use Logger\Interfaces\LoggerStorageHandlerInterface;
use Logger\Logger;
use PHPUnit;
use PHPUnit\Framework\Attributes\CoversClass;
use Psr\Clock\ClockInterface;

// teste unitário
#[CoversClass(Logger::class)]
class LoggerTest extends PHPUnit\Framework\TestCase
{
    protected ClockInterface $clockStub;

    protected LoggerStorageHandlerInterface $fileStorageHandlerMock;

    public function setUp(): void
    {
        $this->clockStub = $this->createStub(ClockInterface::class);
        $this->fileStorageHandlerMock = $this->createMock(LoggerStorageHandlerInterface::class);
    }

    public function tearDown(): void
    {
        // roda depois de todo teste
    }

    public function testLoggerShouldLogInFileOne()
    {
        $this->clockStub->method('now')
            ->willReturn(new DateTimeImmutable('2020-02-12 12:33:22'));

        $this->fileStorageHandlerMock
            ->method('handle')
            ->with($this->equalTo('2020-02-12 12:33:22 error [Um texto] [[1,2,3]]'))
            ->willReturn(true);

        $logger = new Logger($this->fileStorageHandlerMock, $this->clockStub);

        $result = $logger->log(LogLevel::error, 'Um texto', [1, 2, 3]);

        $this->assertEquals(true, $result);
    }

    public function testLoggerShouldLogInFileTwo()
    {
        $this->clockStub->method('now')
            ->willReturn(new DateTimeImmutable('2020-02-12 12:33:22'));

        $this->fileStorageHandlerMock
            ->method('handle')
            ->with($this->equalTo('2020-02-12 12:33:22 error [Um texto] [[1,2,3]]'))
            ->willReturn(true);

        $logger = new Logger($this->fileStorageHandlerMock, $this->clockStub);

        $result = $logger->log(LogLevel::error, 'Um texto', [1, 2, 3]);

        $this->assertEquals(true, $result);
    }
}
