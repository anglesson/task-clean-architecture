<?php

namespace App\ToDo\Infrastructure\Repositories\Doctrine;

use App\ToDo\Domain\Entity\TaskList;
use App\ToDo\Domain\Protocols\TaskListRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskListDoctrineRepository implements TaskListRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    public function save(TaskList $task): TaskList
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
        return $task;
    }
}
