<?php

namespace App\Domain\ValueObject;

use Stringable;

readonly final class Document implements Stringable
{
    public function __toString(): string
    {
        return 'Document';
    }
}
