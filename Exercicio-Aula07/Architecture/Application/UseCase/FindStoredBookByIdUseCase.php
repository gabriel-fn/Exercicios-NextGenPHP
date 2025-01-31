<?php

declare(strict_types=1);

namespace Architecture\Application\UseCase;

use Architecture\Application\Domain\Entity\StoredBookEntity;
use Architecture\Application\Domain\Exception\NotFoundResourceException;
use Architecture\Application\Domain\Repository\StoredBookRepositoryInterface;

class FindStoredBookByIdUseCase
{
    public function __construct(
        private StoredBookRepositoryInterface $storedBookRepository
    )
    { }

    public function execute(int $storedBookId): StoredBookEntity
    {
        $storedBookEntity = $this->storedBookRepository->findById($storedBookId);

        if (null === $storedBookEntity) {
            throw new NotFoundResourceException('Stored Book not found', 404);
        }

        return $storedBookEntity;
    }
}