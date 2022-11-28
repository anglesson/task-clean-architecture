<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\ListAllTasksRepository;
use App\ToDo\Domain\Protocols\UpdateTaskRepository;
use RuntimeException;
use ErrorException;
use InvalidArgumentException;
use Doctrine\ORM\Exception\ORMException;

class DoctrineRepository implements
    CreateTaskRepository,
    FindTaskRepository,
    UpdateTaskRepository,
    ListAllTasksRepository,
    ITaskRepository
{
    public function save(Task $task): Task
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        $entityManager->persist($task);
        $entityManager->flush();
        return $task;
    }

    public function findOne(string $idTask): ?Task
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        return $entityManager->find(Task::class, $idTask);
    }

    public function update(Task $task): Task
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        $taskOld = $entityManager->find(Task::class, $task->getId());
        $taskOld->fill($task->toArray());
        $entityManager->persist($taskOld);
        $entityManager->flush();
        return $task;
    }

    public function delete(string $idTask): void
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        $taskOld = $entityManager->find(Task::class, $idTask);
        $entityManager->remove($taskOld);
        $entityManager->flush();
    }

    /**
     * @return Task []
     * @throws RuntimeException
     * @throws ErrorException
     * @throws InvalidArgumentException
     * @throws ORMException
     */
    public function list()
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        return $entityManager->getRepository(Task::class)->findAll();
    }
}
