<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use App\ToDo\Domain\Protocols\UpdateTaskRepository;
use Doctrine\ORM\Exception\ORMException;

class DoctrineRepository implements
    CreateTaskRepository,
    FindTaskRepository,
    UpdateTaskRepository
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
}
