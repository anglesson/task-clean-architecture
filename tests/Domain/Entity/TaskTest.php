<?php

namespace Test\Domain\Entity;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\DescriptionHasMoreThan50Caracters;

class TaskTest extends TestCase
{
    public function testShouldBePopulateEntityTaskOnlyDescription()
    {
        $id = 'any_id';
        $description = 'any_description';

        $task = new Task($id, $description);

        $this->assertFalse(is_null($task->getDescription()));
        $this->assertFalse(is_null($task->getId()));
    }

    public function testShouldThrowsIfLenghtDescriptionMoreThan50Caracters()
    {
        $id = 'any_id';
        $description = 'My Description has more than fifty hundred characters';
        $this->expectException(DescriptionHasMoreThan50Caracters::class);
        new Task($id, $description);
    }

    public function testShouldBeDoneTask()
    {
        $id = 'any_id';
        $description = 'any_description';
        $task = new Task($id, $description);
        $task->done();
        $this->assertTrue($task->getFinished());
    }

    public function testShouldUndoneTask()
    {
        $id = 'any_id';
        $description = 'any_description';
        $task = new Task($id, $description);
        $task->undone();
        $this->assertTrue(!$task->getFinished());
    }

    public function testShouldSetCreatedAtOnCreation()
    {
        $id = 'any_id';
        $format = 'Y-m-d H:i:s';

        $task = new Task($id, 'any_description');
        $currentTime = new DateTime();

        $this->assertEquals($currentTime->format($format), $task->getCreatedAt()->format($format));
    }

    public function testShouldSetUpdatedAtOnUpdate()
    {
        $id = 'any_id';
        $format = 'Y-m-d H:i:s';

        $currentTime = new DateTime();
        $task = new Task($id, 'any_description');
        $task->setDescription('any_description_updated');

        $this->assertEquals($currentTime->format($format), $task->getUpdatedAt()->format($format));
    }
}
