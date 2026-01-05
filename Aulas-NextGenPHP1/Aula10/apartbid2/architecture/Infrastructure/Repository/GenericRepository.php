<?php

namespace Architecture\Infrastructure\Repository;

use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;
use ArrayObject;

class GenericRepository implements RepositoryInterface
{
    public function __construct(
        protected RepositoryInterface $repositoryStrategy
    ) {
    }

    public function setCollectionName(string $collectionName, string $mappedClassName): void
    {
        $this->repositoryStrategy->setCollectionName($collectionName, $mappedClassName);
    }

    public function save(object $entity): object
    {
        return $this->repositoryStrategy->save($entity);
    }

    public function getById(int $id): ArrayObject
    {
        return $this->repositoryStrategy->getById($id);
    }
}
