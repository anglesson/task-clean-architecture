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

    public function testShouldThrowsIfLengthDescriptionMoreThan50Characters()
    {
        $description = 'My Description has more than fifty hundred characters';
        $this->expectException(DescriptionHasMoreThan50Characters::class);
        new Task($description);
    }

    public function testShouldBeDoneTask()
    {
        $description = 'any_description';
        $task = new Task($description);
        $task->setFinished(true);
        $this->assertTrue($task->isFinished());

        $task->setFinished(false);
        $this->assertFalse($task->isFinished());
    }

    public function testShouldSetCreatedAtOnCreation()
    {
        $format = 'Y-m-d H:i:s';

        $task = new Task('any_description');
        $currentTime = new DateTime();

        $this->assertEquals($currentTime->format($format), $task->getCreatedAt()->format($format));
    }
}
