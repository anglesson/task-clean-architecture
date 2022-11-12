<?php

namespace Test\Domain\UseCases;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Domain\UseCases\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class FindTaskServiceTest extends TestCase
{
    public function testShouldBeFindedATaskById()
    {
        $repository = new MockRepository();
        $createTaskService = new CreateTaskUseCase($repository, new RamseyUuidImpl());
        $findTaskService = new FindTaskServiceImpl($repository);

        $data = ['description' => 'any_description'];
        $inputCreateTask = new InputCreateTask($data);

        $outputCreateTask = $createTaskService->create($inputCreateTask);
        $taskFinded = $findTaskService->find($outputCreateTask->id);

        $this->assertEquals($taskFinded->getId(), $outputCreateTask->id);
    }

    public function testShouldBeReturnExceptionIfTaskNotFounded()
    {
        $this->expectException(TaskNotFoundException::class);
        $repository = new MockRepository();
        $findTaskService = new FindTaskServiceImpl($repository);

        $findTaskService->find('any_id');
    }
}
