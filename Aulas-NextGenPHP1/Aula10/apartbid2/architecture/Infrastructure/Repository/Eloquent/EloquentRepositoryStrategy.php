<?php

namespace Architecture\Infrastructure\Repository\Eloquent;

use App\Models\Apartment;
use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;
use ArrayObject;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\CollectionStrategy;
use ReflectionClass;

class EloquentRepositoryStrategy implements RepositoryInterface
{
    protected Model $model;

    protected string $mappedClassName;

    public function __construct(
        protected HydratorInterface $hydrator,
    ) {
    }

    /**
     * @param string $collectionName
     * @param string $mappedClassName
     * @return void
     * @throws Exception
     */
    public function setCollectionName(string $collectionName, string $mappedClassName): void
    {
        /** @var class-string<Model> $modelStringName */
        $modelStringName = 'App\\Models\\' . Str::singular(Str::studly($collectionName));

        if (false === class_exists($modelStringName)) {
            throw new Exception("Class {$modelStringName} doesn't exists");
        }

        if (false === class_exists($mappedClassName)) {
            throw new Exception("Class {$mappedClassName} doesn't exists to mapper");
        }

        $this->model = new $modelStringName();

        $this->mappedClassName = $mappedClassName;
    }

    public function save(object $entity): object
    {
        $extractedEntity = $this->hydrator->extract($entity);

        $this->model->fill($extractedEntity);
        $this->model->save();

        return $this->hydrator->hydrate($this->model->toArray(), new $this->mappedClassName());
    }

    public function getById(int $id): ArrayObject
    {
        $model = $this->model->find($id);
        if (null === $model) {
            return new ArrayObject([]);
        }

        $hydratedEntity = $this->hydrator->hydrate($model->toArray(), new $this->mappedClassName());

        return new ArrayObject([$hydratedEntity]);
    }

    /**
     * @return ArrayObject<int, object>
     */
    public function getAll(): ArrayObject
    {
        $models = $this->model->all();

        $collection = new CollectionStrategy(
            $this->hydrator,
            $this->mappedClassName
        );
        $hydratedEntities = $collection->hydrate($models->toArray());

        return new ArrayObject($hydratedEntities);
    }
}
