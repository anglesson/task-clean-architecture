<?php

namespace Test\Domain\UseCases\CreateTask;

use App\ToDo\Domain\Exceptions\MissingParamsError;
use App\ToDo\Domain\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Infrastructure\Repositories\InMemory\MockRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class CreateTaskServiceTest extends TestCase
{
    private function makeCreateService(): ICreateTaskUseCase
    {
        $mockUuid = new RamseyUuidImpl();
        $mockRepository = new MockRepository();
        return new CreateTaskUseCase($mockRepository, $mockUuid);
    }

    public function testShouldBeCreatedATask()
    {
        $inputCreateTask = InputCreateTask::create(['description' => 'any_description']);
        $outputCreateTask = ($this->makeCreateService())->create($inputCreateTask);
        $this->assertEquals('any_description', $outputCreateTask->description);
    }

    public function testShouldBeThrowsIfMissingParams()
    {
        $inputCreateTask = InputCreateTask::create([]);
        $this->expectException(MissingParamsError::class);
        ($this->makeCreateService())->create($inputCreateTask);
    }
}