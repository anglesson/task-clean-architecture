<?php

namespace Test\Domain\Entity;

use PHPUnit\Framework\TestCase;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\DescriptionHasMoreThan50Caracters;

class TaskTest extends TestCase
{
    public function testShouldBePopulateEntityTaskOnlyDescription()
    {
        $description = 'any_description';

        $task = new Task($description);

        $this->assertFalse(is_null($task->getDescription()));
        $this->assertTrue(is_null($task->getId()));
    }

    public function testShouldThrowsIfLenghtDescriptionMoreThan50Caracters()
    {
        $description = 'My Description has more than fifty hundred characters';
        $this->expectException(DescriptionHasMoreThan50Caracters::class);
        $task = new Task($description);
    }

    public function testShouldBeDoneTask()
    {
        $description = 'any_description';
        $task = new Task($description);
        $task->done();
        $this->assertTrue($task->getFinished());
    }

    public function testShouldUndoneTask()
    {
        $description = 'any_description';
        $task = new Task($description);
        $task->undone();
        $this->assertTrue(!$task->getFinished());
    }
}
