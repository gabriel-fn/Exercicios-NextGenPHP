<?php

namespace Logger\Interfaces;

use Logger\Enums\LogLevel;

interface LoggerInterface
{
    public function log(LogLevel $logLevel, string $message, array|object $data): bool;
}