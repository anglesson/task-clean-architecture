<?php

namespace App\ToDo\Domain\Utils;

use ReflectionMethod;

trait Fillable
{
    public function fill(array $data): void
    {
        if (property_exists($this, 'fillable')) {
            foreach ($this->fillable as $field) {
                $method = 'set'.ucfirst(trim($field));
                if (isset($data[$field]) && method_exists($this, $method)) {
                    $this->$method($data[$field]);
                }
            }
        }
    }

    public function jsonSerialize(): string
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        $array = [];
        $fields = get_object_vars($this);
        foreach ($fields as $key => $field) {
            if ($key !== 'fillable') {
                $method = 'get'.ucfirst(trim($key));
                if (method_exists($this, $method)) {
                    $array[$key] = $this->$method();
                }
            }
        }
        return $array;
    }
}
