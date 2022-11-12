<?php

namespace App\ToDo\Application\DTO;

use ReflectionClass;
use ReflectionProperty;

abstract class DataTransferObject
{
    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();
            $this->{$property} = $parameters[$property] ?? null;
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
