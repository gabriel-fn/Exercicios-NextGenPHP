<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Mapper;

interface GenericObjectMapperInterface
{
    public function map(object $source, string $targetClass): object;
}