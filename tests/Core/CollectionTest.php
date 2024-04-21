<?php
namespace Test\Core;

use App\ToDo\Core\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function test_it_can_be_instantiated()
    {
        $collection = new Collection();
        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function test_it_can_be_instantiated_with_array()
    {
        $array = ['apple', 'banana', 'melon'];
        $collection = new Collection($array);
        $this->assertFalse($collection->isEmpty());
    }

    public function testShouldRemoveItemFromCollection()
    {
        $items = ['apple', 'banana', 'melon'];
        $collection = new Collection($items);
        $collection->remove('apple');
        $this->assertCount(2, $collection);
        $this->assertEquals('banana', $collection->get(0));
        $this->assertEquals('melon', $collection->get(1));
    }

    public function testShouldReturnFirstAndLastItemFromCollection()
    {
        $items = ['apple', 'banana', 'melon', 'grape'];
        $collection = new Collection($items);
        $this->assertEquals('apple', $collection->first());
        $this->assertEquals('grape', $collection->last());
        $collection->remove('apple');
        $collection->remove('grape');
        $this->assertEquals('banana', $collection->first());
        $this->assertEquals('melon', $collection->last());
    }
}
