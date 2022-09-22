<?php

namespace Test\Domain\Entity;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Entity\Task;
use Anglesson\Task\Domain\Exceptions\DescriptionHasMoreThan50Caracters;

class TaskTest extends TestCase
{
    public function testShouldBePopulateEntityTaskOnlyDescription()
    {
        $task = new Task();
        $task->fill([
            'id' => 12,
            'description'=> 'My Description'
        ]);
        $this->assertEquals(is_null($task->getDescription()), false);
        $this->assertEquals(is_null($task->getId()), true);
    }

    public function testShouldThrowsIfLenghtDescriptionMoreThan50Caracters()
    {
        $this->expectException(DescriptionHasMoreThan50Caracters::class);
        $task = new Task();
        $task->fill([
            'description'=> 'My Description has more than fift hundred caracters'
        ]);
    }
}
