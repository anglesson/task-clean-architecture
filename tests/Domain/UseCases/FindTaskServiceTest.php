<?php

namespace Test\Domain\UseCases;

use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Application\UseCases\FindTask\IFindTaskUseCaseImpl;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Utils\ValidationComposite;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class FindTaskServiceTest extends TestCase
{
    public function testShouldBeFindedATaskById()
    {
        $repository = new MockRepository();
        $validation = new ValidationComposite([]);
        $createTaskService = new CreateTaskUseCase($repository, new RamseyUuidImpl(), $validation);
        $findTaskService = new IFindTaskUseCaseImpl($repository);

        $data = ['description' => 'any_description'];
        $inputCreateTask = InputCreateTask::create($data);

        $outputCreateTask = $createTaskService->execute($inputCreateTask);
        $taskFinded = $findTaskService->execute($outputCreateTask->id);

        $this->assertEquals($taskFinded->getId(), $outputCreateTask->id);
    }

    public function testShouldBeReturnExceptionIfTaskNotFounded()
    {
        $this->expectException(TaskNotFoundException::class);
        $repository = new MockRepository();
        $findTaskService = new IFindTaskUseCaseImpl($repository);

        $findTaskService->execute('any_id');
    }
}
