<?php

namespace Test\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Protocols\ListAllTasksRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use PHPUnit\Framework\TestCase;

class ListAllTasksRepositoryTest extends TestCase
{
    public function testShouldImplementsAListAllTasksRepository()
    {
        $repository = new TaskDoctrineRepository();
        $this->assertInstanceOf(ListAllTasksRepository::class, $repository);
    }

    public function testShouldReturnAnArrayIfExistsTasks()
    {
        $repository = new TaskDoctrineRepository();
        $tasks = $repository->list();
        $this->assertIsArray($tasks);
    }
}
