<?php

namespace Test\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\ListAllTasks\ListAllTasksRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\EntityManagerCreator;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use PHPUnit\Framework\TestCase;

class ListAllTasksRepositoryTest extends TestCase
{
    private EntityManager $entityManager;

    /**
     * @throws ORMException
     */
    protected function setUp(): void
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    public function testShouldImplementsAListAllTasksRepository()
    {
        $repository = new TaskDoctrineRepository($this->entityManager);
        $this->assertInstanceOf(ITaskRepository::class, $repository);
    }

    public function testShouldReturnAnArrayIfExistsTasks()
    {
        $repository = new TaskDoctrineRepository($this->entityManager);
        $tasks = $repository->list();
        $this->assertIsArray($tasks);
    }
}
