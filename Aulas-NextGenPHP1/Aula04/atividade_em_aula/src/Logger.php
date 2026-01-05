<?php

namespace Logger;

use Logger\Enums\LogLevel;
use Logger\Interfaces\LoggerStorageHandlerInterface;
use Psr\Clock\ClockInterface;

final class Logger
{
    protected string $dateTime;

    public function __construct(
        protected LoggerStorageHandlerInterface $loggerHandler,
        protected ClockInterface $clock
    ) {
    }

    public function log(LogLevel $logLevel, string $message, array|object $dataJson): bool
    {
        $dataJsonString = json_encode($dataJson);

        $formattedDate = $this->clock->now()->format('Y-m-d H:i:s');

        $formattedMessage = "{$formattedDate} {$logLevel->name} [{$message}] [{$dataJsonString}]";

        return $this->loggerHandler->handle($formattedMessage);
    }
}
