<?php

namespace Architecture\Infrastructure\Repository\Interface;

interface RepositoryInterface
{
    public function save(object $entity): object;
}
