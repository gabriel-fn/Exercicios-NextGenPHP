<?php
declare(strict_types=1);

namespace PHPNextGen;

use Override;

final class CustomerPJ extends BaseCustomer
{
    public string $name;

    protected string $document;

    #[Override]
    public function setDocument(string $document): void
    {
        // validação de CNPJ - Respect
        if (false === preg_match('#[0-9]{2}[0-9]{3}[0-9]{3}\/0001\-[0-9]{2}#', $document)) {
            throw new \Exception('Invalid document');
        }
        parent::setDocument($document);
    }

    public function getDocument(): string
    {
        return $this->document;
    }
}