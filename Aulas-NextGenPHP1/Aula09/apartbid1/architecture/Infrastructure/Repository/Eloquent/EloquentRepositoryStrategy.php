<?php

namespace Architecture\Infrastructure\Repository\Eloquent;

use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;
use ArrayObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\CollectionStrategy;
use stdClass;

class EloquentRepositoryStrategy implements RepositoryInterface
{
    protected Model $model;

    protected string $targetMappedClassName;

    public function __construct(
        protected HydratorInterface $hydrator,
    ) {
    }

    public function setCollectionName(string $collectionName, string $targetMappedClassName): void
    {
        $modelStringName = 'App\\Models\\' . Str::singular(Str::studly($collectionName));

        if (false === class_exists($modelStringName)) {
            throw new \Exception("Class {$modelStringName} doesn't exists");
        }

        if (false === class_exists($targetMappedClassName)) {
            throw new \Exception("Class {$targetMappedClassName} doesn't exists to mapper");
        }

        $this->model = new $modelStringName();
        $this->targetMappedClassName = $targetMappedClassName;
    }

    public function save(object $entity): object
    {
        $extractedEntity = $this->hydrator->extract($entity);

        $this->model->fill($extractedEntity);
        $this->model->save();

        return $this->hydrator->hydrate($this->model->toArray(), new $this->targetMappedClassName);
    }

    public function getById(int $id): ArrayObject
    {
        $model = $this->model->find($id);
        if (null === $model) {
            return new ArrayObject([]);
        }
        return new ArrayObject($this->hydrator->extract($model));
    }

    public function getAll(): ArrayObject
    {
        // implementar
    }
}
