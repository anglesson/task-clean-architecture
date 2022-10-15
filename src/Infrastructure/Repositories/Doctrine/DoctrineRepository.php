<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\DeleteTaskRepository;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Protocols\ListAllTasksRepository;
use App\ToDo\Domain\Protocols\UpdateTaskRepository;

class DoctrineRepository implements
    CreateTaskRepository,
    FindTaskRepository,
    UpdateTaskRepository,
    DeleteTaskRepository,
    ListAllTasksRepository
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

    public function delete(Task $task): void
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        $taskOld = $entityManager->find(Task::class, $task->getId());
        $entityManager->remove($taskOld);
        $entityManager->flush();
    }

    public function list(): array
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        return $entityManager->getRepository(Task::class)->findAll();
    }
}
