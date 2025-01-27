<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Mapper;

use Architecture\Application\Domain\Mapper\GenericObjectMapperInterface;
use ReflectionClass;

class ObjectMapper implements GenericObjectMapperInterface
{
    public function map(object $source, string $targetClass): object
    {
        $targetReflection = new ReflectionClass($targetClass);
        $targetInstance = $targetReflection->newInstanceWithoutConstructor();
        $targetProps = $targetReflection->getProperties();
    
        foreach ($targetProps as $targetProp) {
            $propName = $targetProp->getName();
            $targetInstance->$propName = $source->$propName ?? null;
        }
    
        return $targetInstance;
    }
}