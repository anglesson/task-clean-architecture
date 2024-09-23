<?php

namespace Test\Domain\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\DescriptionHasMoreThan50Characters;

class TaskTest extends TestCase
{
    public function testShouldBePopulateEntityTaskOnlyDescription()
    {
        $description = 'any_description';

        $task = new Task($description);

        $this->assertFalse(is_null($task->getDescription()));
        $this->assertTrue(is_null($task->getId()));
    }

    public function testShouldBeDoneAndUndoTask()
    {
        $description = 'any_description';
        $task = new Task($description);
        $task->done();
        $this->assertTrue($task->isFinished());

        $task->undo();
        $this->assertFalse($task->isFinished());
    }

    public function testShouldSetCreatedAtOnCreation()
    {
        $format = 'Y-m-d H:i:s';

        $task = new Task('any_description');
        $currentTime = new DateTime();

        $this->assertEquals($currentTime->format($format), $task->getCreatedAt()->format($format));
    }

    public function testShouldSetUpdateAtAfterUpdateATask()
    {
        $task = new Task('any_description');

        $task->done();

        $task->updateDescription('new description');
        $task->lastUpdate();

        $this->assertNotNull($task->lastUpdate());
    }
}
