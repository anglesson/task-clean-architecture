<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use RuntimeException;

class TaskDoctrineRepository implements TaskRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    public function save(Task $task): Task
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
        return $task;
    }

    public function findOne(string $idTask): ?Task
    {
        return $this->entityManager->find(Task::class, $idTask);
    }

    public function update(Task $task): Task
    {
        $taskOld = $this->entityManager->find(Task::class, $task->getId());
        $taskOld->fill($task->toArray());
        $this->entityManager->persist($taskOld);
        $this->entityManager->flush();
        return $task;
    }

    public function delete(string $idTask): void
    {
        $taskOld = $this->entityManager->find(Task::class, $idTask);
        $this->entityManager->remove($taskOld);
        $this->entityManager->flush();
    }

    /**
     * @return Task []
     * @throws RuntimeException
     * @throws InvalidArgumentException
     */
    public function list(): array
    {
        return $this->entityManager->getRepository(Task::class)->findAll();
    }
}
