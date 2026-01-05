<?php

namespace Logger\Interfaces;

interface LoggerStorageHandlerInterface
{
    public function handle(string $message): bool;
}
