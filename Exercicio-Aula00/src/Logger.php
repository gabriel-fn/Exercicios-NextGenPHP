<?php

namespace Logger;

use DateTime;
use Logger\Enums\LogLevel;
use Logger\Interfaces\LoggerInterface;
use Logger\Interfaces\LoggerStorageHandlerInterface;

class Logger implements LoggerInterface
{
    protected LoggerStorageHandlerInterface $loggerStorageHandler;

    public function __construct(LoggerStorageHandlerInterface $loggerStorageHandler)
    {
        $this->loggerStorageHandler = $loggerStorageHandler;
    }

    public function log(LogLevel $logLevel, string $message, array|object $data): bool
    {
        return $this->loggerStorageHandler->handle(new DateTime(), $logLevel->name, $message, $data);
    }
}