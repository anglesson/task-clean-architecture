<?php

namespace Anglesson\Task\Infrastructure\Factories;

use Anglesson\Task\Application\Api\TaskCreateController;
use Anglesson\Task\Infrastructure\Utils\RamseyUuid;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Domain\Services\CreateTaskService;
use Anglesson\Task\Application\Protocols\Http\Controller;

final class CreateTaskControllerFactory
{
    public static function create(): Controller
    {
        $ramseyUuid = new RamseyUuid();
        $repository = new MockRepository($ramseyUuid);
        $createTaskService = new CreateTaskService($repository);
        return new TaskCreateController($createTaskService);
    }
}
