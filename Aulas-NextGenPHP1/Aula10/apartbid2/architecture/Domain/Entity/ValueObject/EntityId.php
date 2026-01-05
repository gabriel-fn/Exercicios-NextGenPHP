<?php

namespace Architecture\Domain\Entity\ValueObject;

use InvalidArgumentException;
use Stringable;

readonly class EntityId implements Stringable
{
    public function __construct(
        protected string $value
    ) {
        if ($value <= 0) {
            throw new InvalidArgumentException('Value must be greater than 0');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
