<?php
namespace Test\Domain\Entity;

use App\ToDo\Domain\Entity\Entity;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Entity\TaskList;
use PHPUnit\Framework\TestCase;

class TaskListTest extends TestCase
{
    public function testShouldExtendsEntityClass()
    {
        $list = new TaskList('Inbox');
        $this->assertInstanceOf(Entity::class, $list);
    }

    public function testShouldInitializeValues()
    {
        $list = new TaskList('Inbox');
        $this->assertEquals('Inbox', $list->getName());
        $this->assertEmpty($list->getTasks());
    }

    public function testShouldAddTaskToAList()
    {
        $task = new Task('New Task');
        $list = new TaskList('Inbox');
        $list->add($task);
        $this->assertEquals($task, $list->getTasks()->first());
    }

    public function testShouldRemoveTaskFromList()
    {
        $task1 = new Task('Task 1');
        $task2 = new Task('Task 2');
        $list = new TaskList('Inbox');
        $list->add($task1);
        $list->add($task2);
        $list->remove($task1);
        $this->assertCount(1, $list->getTasks());
        $this->assertEquals($task2, $list->getTasks()->first());
    }

    public function testShouldRenameList()
    {
        $list = new TaskList('Inbox');
        $list->rename('Next Action');
        $this->assertEquals('Next Action', $list->getName());
    }
}
