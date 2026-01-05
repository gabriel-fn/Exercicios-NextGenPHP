<?php
declare(strict_types=1);

namespace PHPNextGen;

abstract class BaseCustomer
{
    public string $name;

    protected string $document;

    public function setDocument(string $document): void
    {
        $this->document = str_replace(['.', '-', ',', '/'], '', $document);
    }

    // public abstract function getDocument(): string;
}