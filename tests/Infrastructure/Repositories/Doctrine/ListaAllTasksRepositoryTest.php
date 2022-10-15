<?php

namespace Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Protocols\ListAllTasksRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\DoctrineRepository;
use PHPUnit\Framework\TestCase;

class ListaAllTasksRepositoryTest extends TestCase
{
    public function testShouldImplementsAListAllTasksRepository()
    {
        $repository = new DoctrineRepository();
        $this->assertInstanceOf(ListAllTasksRepository::class, $repository);
    }

    public function testShouldReturnAnArrayIfExistsTasks()
    {
        $repository = new DoctrineRepository();
        $tasks = $repository->list();
        $this->assertIsArray($tasks);
    }
}
