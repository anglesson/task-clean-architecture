<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\CreateTaskRepository;
use App\ToDo\Infrastructure\Protocols\UuidGenerator;

class DoctrineRepository implements CreateTaskRepository
{
    protected UuidGenerator $uuidGenerator;

    public function __construct(UuidGenerator $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function save(Task $task): Task
    {
        $task->setId($this->uuidGenerator->generateId());
        $entityManager = (new EntityManagerCreator())->createEntityManager();
        $entityManager->persist($task);
        $entityManager->flush();
        return $task;
    }
}
