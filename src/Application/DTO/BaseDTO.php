<?php
declare(strict_types=1);

namespace Anglesson\Task\Application\DTO;

use JsonSerializable;

abstract class BaseDTO implements JsonSerializable
{
    public function values(): array
    {
        return get_object_vars($this);
    }

    public function get(string $property): mixed
    {
        $getter = "get" . ucfirst($property);

        if (method_exists($this, $getter)) {
            return $this->{$getter}();
        }

        if (!property_exists($this, $property)) {
            throw new \InvalidArgumentException(sprintf(
                "The property '%s' doesn't exists in '%s' DTO Class",
                $property,
                get_class()
            ));
        }

        return $this->{$property};
    }

    public function jsonSerialize(): mixed
    {
        return $this->values();
    }

    public function __get(string $name)
    {
        return $this->get($name);
    }

    public function __set(string $name, mixed $value)
    {
        throw new \Exception(
            sprintf("The property '%s' is read-only", $name)
        );
    }

    public function __isset($name): bool
    {
        return property_exists($this, $name);
    }
}
