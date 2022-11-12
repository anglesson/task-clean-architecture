<?php

namespace Test\Domain\Services;

use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Services\CreateTask\CreateTaskServiceImpl;
use App\ToDo\Domain\Services\CreateTask\InputCreateTask;
use App\ToDo\Domain\Services\FindTaskServiceImpl;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class FindTaskServiceTest extends TestCase
{
    public function testShouldBeFindedATaskById()
    {
        $repository = new MockRepository();
        $createTaskService = new CreateTaskServiceImpl($repository, new RamseyUuidImpl());
        $findTaskService = new FindTaskServiceImpl($repository);

        $data = ['description' => 'any_description'];
        $inputCreateTask = new InputCreateTask($data);

        $taskCreated = $createTaskService->create($inputCreateTask);
        $taskFinded = $findTaskService->find($taskCreated->getId());

        $this->assertEquals($taskFinded, $taskCreated);
    }

    public function testShouldBeReturnExceptionIfTaskNotFounded()
    {
        $this->expectException(TaskNotFoundException::class);
        $repository = new MockRepository();
        $findTaskService = new FindTaskServiceImpl($repository);

        $findTaskService->find('any_id');
    }
}
