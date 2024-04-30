<?php

namespace App\ToDo\Core;

use ArrayObject;

class Collection extends ArrayObject
{
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    public function remove(mixed $element): void
    {
        if (!$this->isEmpty()) {
            $index = array_search($element, $this->getArrayCopy());
            $this->offsetUnset($index);
        }
    }

    public function get(int $index): mixed
    {
        return $this->offsetExists($index) ? $this->offsetGet($index) : null;
    }
    public function first(): mixed
    {
        return $this->getIterator()->current();
    }

    public function last(): mixed
    {
        $lastIndex = $this->count() - 1;
        return $this->offsetGet($lastIndex);
    }
}
