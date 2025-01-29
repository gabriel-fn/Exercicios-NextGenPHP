<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository;

use App\Models\StoredBook;
use Architecture\Application\Domain\Entity\StoredBookEntity;
use Architecture\Application\Domain\Mapper\GenericObjectMapperInterface;
use Architecture\Application\Domain\Repository\StoredBookRepositoryInterface;

class StoredBookRepository implements StoredBookRepositoryInterface
{
    public function __construct(
        private GenericObjectMapperInterface $objectMapper
    )
    { }

    public function findById(int $storedBookId): ?StoredBookEntity
    {
        $storedBookModel = StoredBook::find($storedBookId);

        if (null === $storedBookModel) {
            return null;
        }

        $storedBookEntity = $this->objectMapper->map($storedBookModel, StoredBookEntity::class);

        return $storedBookEntity;
    }
}