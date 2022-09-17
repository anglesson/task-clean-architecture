<?php

namespace Anglesson\Task\tests\Application\Services;

use PHPUnit\Framework\TestCase;
use Anglesson\Task\Domain\Services\UpdateTaskService;
use Anglesson\Task\Domain\Services\FindTaskService;
use Anglesson\Task\Infrastructure\Repositories\MockRepository;
use Anglesson\Task\Infrastructure\Utils\RamseyUuid;
use Anglesson\Task\Domain\Services\CreateTaskService;

class UpdateTaskServiceTest extends TestCase
{
    public function testShouldBeUpdateATask()
    {
        $ramseyUuid = new RamseyUuid();
        $repository = new MockRepository($ramseyUuid);
        $createTaskService = new CreateTaskService($repository);
        $findTaskService = new FindTaskService($repository);
        $updateTaskService = new UpdateTaskService($findTaskService, $repository);

        $task = $createTaskService->create(['description' => 'any_description']);
        $taskUpdated = $updateTaskService->update($task->id, ['description' => 'any_description_updated']);

        $this->assertEquals($taskUpdated->description, 'any_description_updated');
    }
}
