<?php

namespace Logger;

use DateTimeInterface;
use Logger\Interfaces\LoggerStorageHandlerInterface;

class FileLoggerStorageHandler implements LoggerStorageHandlerInterface
{
    protected string $filePath;
    protected string $basePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        
        $this->basePath = dirname(__DIR__, 1)."/storage/";
    }

    public function handle(DateTimeInterface $dateTime, string $logLevel, string $message, array|object $data): bool
    {
        $dataJson = json_encode($data);

        $dateTimeFormatted = $dateTime->format('Y-m-d H:i:s');

        $messageFormatted = "\n{$dateTimeFormatted} [{$logLevel}] : {$message} {$dataJson}"; 

        $result = file_put_contents($this->basePath.$this->filePath, $messageFormatted, FILE_APPEND);

        if (false === $result) {
            return false;
        }

        return true;
    }
}