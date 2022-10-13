<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\FindTaskRepository;
use Doctrine\ORM\Exception\ORMException;

class DoctrineRepository implements
    CreateTaskRepository,
    FindTaskRepository
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
}
