<?php

namespace Test\Domain\Services;

use App\ToDo\Domain\Services\CreateTask\CreateTaskServiceImpl;
use App\ToDo\Domain\Services\CreateTask\InputCreateTask;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Domain\Services\UpdateTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class UpdateTaskServiceTest extends TestCase
{
    public function testShouldBeUpdateATask()
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new MockRepository();
        $createTaskService = new CreateTaskServiceImpl($repository, $ramseyUuid);
        $findTaskService = new FindTaskServiceImpl($repository);
        $updateTaskService = new UpdateTaskServiceImpl($findTaskService, $repository);

        $data = ['description' => 'any_description'];
        $inputCreateTask = new InputCreateTask($data);
        $task = $createTaskService->create($inputCreateTask);

        $taskUpdated = $updateTaskService->update($task->getId(), ['description' => 'any_description_updated']);
        $this->assertEquals($taskUpdated->getDescription(), 'any_description_updated');

        $updateTaskService->update($task->getId(), ['finished' => true]);
        $this->assertEquals($task->getFinished(), true);
    }
}
