<?php

namespace Test\Domain\UseCases\UpdateTask;

use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Domain\UseCases\FindTask\FindTaskServiceImpl;
use App\ToDo\Domain\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskServiceImpl;
use App\ToDo\Domain\Utils\ValidationComposite;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class UpdateTaskServiceTest extends TestCase
{
    public function testShouldBeUpdateATask()
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new MockRepository();
        $validation = new ValidationComposite([]);
        $createTaskService = new CreateTaskUseCase($repository, $ramseyUuid, $validation);
        $findTaskService = new FindTaskServiceImpl($repository);
        $updateTaskService = new UpdateTaskServiceImpl($findTaskService, $repository);

        $data = ['description' => 'any_description'];
        $inputCreateTask = InputCreateTask::create($data);
        $outputCreateTask = $createTaskService->create($inputCreateTask);

        $inputUpdateTask = InputUpdateTask::create([
            'id'=> $outputCreateTask->id,
            'description' => 'any_description_updated',
            'finished' => true
        ]);
        $outputUpdateTask = $updateTaskService->update($inputUpdateTask);
        $this->assertEquals($outputUpdateTask->description, 'any_description_updated');
        $this->assertTrue($outputUpdateTask->finished);
    }
}
