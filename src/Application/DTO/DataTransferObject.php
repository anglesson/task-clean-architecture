<?php

namespace App\ToDo\Application\DTO;

use App\ToDo\Domain\Entity\Collection;
use ReflectionClass;
use ReflectionProperty;

abstract class DataTransferObject
{
    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();

            if (isset($parameters[$property])) {
                if ($parameters[$property] instanceof Collection) {
                    $this->{$property} = $parameters[$property]->toArray();
                } else {
                    $this->{$property} = $parameters[$property];
                }
            }
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function toJson(): string
    {
        return json_encode(get_object_vars($this));
    }
}
