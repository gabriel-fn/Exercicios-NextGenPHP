<?php

namespace DifferDev\Adapter;

use DifferDev\QueryBuilder\QueryBuilder;
use DifferDev\QueryBuilder\QueryMongoDbBuilder;

class QueryMongoDbBuilderAdapter extends QueryBuilder
{
    public function __construct(
        protected QueryMongoDbBuilder $queryMongoDbBuilder
    ) {
    }

    public function select(array $tableFields): self
    {
        $this->queryMongoDbBuilder->projection($tableFields);
        return $this;
    }

    public function from(string $tableName): self
    {
        $this->queryMongoDbBuilder->find($tableName);
        return $this;
    }

    public function where(string $field, string $compare, string $value): self
    {
        $this->queryMongoDbBuilder->filter($field, $compare, $value);
        return $this;
    }

    public function getQueryAsArray(): array
    {
        return $this->queryMongoDbBuilder->getQueryAsArray();
    }
}