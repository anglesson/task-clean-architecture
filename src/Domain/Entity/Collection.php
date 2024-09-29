<?php

namespace App\ToDo\Domain\Entity;

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
        $iterator = $this->getIterator();
        $lastIndex = $this->count() - 1;
        $iterator->seek($lastIndex);
        return $iterator->current();
    }

    public function toArray(): array
    {
        return $this->getArrayCopy();
    }
}
