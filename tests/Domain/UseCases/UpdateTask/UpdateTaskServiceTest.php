<?php

namespace Test\Domain\UseCases\UpdateTask;

use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Application\UseCases\FindTask\IFindTaskUseCaseImpl;
use App\ToDo\Application\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Application\UseCases\UpdateTask\UpdateTaskServiceImpl;
use App\ToDo\Domain\Utils\ValidationComposite;
use App\ToDo\Infrastructure\Repositories\InMemory\InMemoryRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class UpdateTaskServiceTest extends TestCase
{
    public function testShouldBeUpdateATask()
    {
        $ramseyUuid = new RamseyUuidImpl();
        $repository = new InMemoryRepository();
        $validation = new ValidationComposite([]);
        $createTaskService = new CreateTaskUseCase($repository, $ramseyUuid, $validation);
        $findTaskService = new IFindTaskUseCaseImpl($repository);
        $updateTaskService = new UpdateTaskServiceImpl($findTaskService, $repository);

        $data = ['description' => 'any_description'];
        $inputCreateTask = InputCreateTask::create($data);
        $outputCreateTask = $createTaskService->execute($inputCreateTask);

        $inputUpdateTask = InputUpdateTask::create([
            'id'=> $outputCreateTask->id,
            'description' => 'any_description_updated',
            'finished' => true
        ]);
        $outputUpdateTask = $updateTaskService->execute($inputUpdateTask);
        $this->assertEquals($outputUpdateTask->description, 'any_description_updated');
        $this->assertTrue($outputUpdateTask->finished);
    }
}
