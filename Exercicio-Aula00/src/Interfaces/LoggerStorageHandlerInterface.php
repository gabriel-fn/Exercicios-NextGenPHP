<?php

namespace Logger\Interfaces;

use DateTimeInterface;

interface LoggerStorageHandlerInterface 
{
    public function handle(DateTimeInterface $dateTime, string $logLevel, string $message, array|object $data): bool;
}