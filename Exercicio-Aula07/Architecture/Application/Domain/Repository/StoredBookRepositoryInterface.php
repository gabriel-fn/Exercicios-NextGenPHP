<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Repository;

use Architecture\Application\Domain\Entity\StoredBookEntity;

Interface StoredBookRepositoryInterface
{
    public function findById(int $storedBookId): ?StoredBookEntity;
}