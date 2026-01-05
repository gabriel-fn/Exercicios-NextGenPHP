<?php

namespace Architecture\Infrastructure\Repository\Interface;

use ArrayObject;

interface RepositoryInterface
{
    /**
     * @param string $collectionName
     * @param string $mappedClassName
     * @return void
     */
    public function setCollectionName(string $collectionName, string $mappedClassName): void;

    /**
     * @param object $entity
     * @return object
     */
    public function save(object $entity): object;

    /**
     * @param int $id
     * @return ArrayObject<int, object>
     */
    public function getById(int $id): ArrayObject;
}
