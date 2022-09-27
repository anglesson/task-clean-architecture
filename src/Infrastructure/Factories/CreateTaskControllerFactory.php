<?php

namespace Anglesson\Task\Infrastructure\Factories;

use Anglesson\Task\Application\Api\TaskCreateController;
use Anglesson\Task\Infrastructure\Utils\RamseyUuidImpl;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Domain\Services\CreateTaskServiceImpl;
use Anglesson\Task\Application\Protocols\Http\Controller;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new MockRepository($ramseyUuid);
        $createTaskService = new CreateTaskServiceImpl($repository);
        return new TaskCreateController($createTaskService);
    }
}
