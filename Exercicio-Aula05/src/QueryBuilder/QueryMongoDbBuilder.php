<?php

namespace DifferDev\QueryBuilder;

class QueryMongoDbBuilder
{
    /**
     * @var array<int, string>
     */
    protected array $queryPieces = [];

    /**
     * @var array<string>
     */
    protected array $operatorMap = [
        '=' => '$eq',
        '!=' => '$ne',
        '>' => '$gt',
        '>=' => '$gte',
        '<' => '$lt',
        '<=' => '$lte'
    ];

    public function find(string $collectionName): self
    {
        $this->queryPieces['collectionName'] = $collectionName;
        return $this;
    }

    public function getQueryAsArray(): array
    {
        return $this->queryPieces;
    }

    public function projection(array $projections): self
    {
        $this->queryPieces['options']['projection'] = array_fill_keys($projections, 1);
        return $this;
    }

    public function filter(string $field, string $operator, string $value): self
    {
        $this->queryPieces['filter'][$field][$this->operatorMap[$operator]] = $value;
        return $this;
    }

}
