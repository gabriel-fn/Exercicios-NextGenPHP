<?php

namespace Application\ValueObject;

use Exception;

class Cep
{
    /**
     * @param string $cep
     * @throws Exception
     */
    public function __construct(
        protected string $cep
    ) {
        if (0 === preg_match('/^\d{5}-?\d{3}$/', $cep)) {
            throw new Exception('Cep inválido!');
        }
    }

    public function getValue(): string
    {
        return $this->cep;
    }
}
