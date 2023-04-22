<?php

namespace App\ToDo\Main;

use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Infrastructure\Repositories\Doctrine\EntityManagerCreator;
use App\ToDo\Infrastructure\Repositories\Doctrine\TaskDoctrineRepository;
use Doctrine\ORM\EntityManagerInterface;

class CompositionRoot
{
    public static function createDatabase(): EntityManagerInterface
    {
        return EntityManagerCreator::createEntityManager();
    }

    public static function createTaskRepository(): ITaskRepository
    {
        $database = self::createDatabase();
        return new TaskDoctrineRepository($database);
    }
}
