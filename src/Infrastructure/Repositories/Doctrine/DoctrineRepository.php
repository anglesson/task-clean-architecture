<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;

class DoctrineRepository implements CreateTaskRepository
{
    public function save(Task $task): Task
    {
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        $entityManager->persist($task);
        $entityManager->flush();
        return $task;
    }
}
