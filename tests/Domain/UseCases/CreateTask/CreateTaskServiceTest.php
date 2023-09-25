<?php

namespace Test\Domain\UseCases\CreateTask;

use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\Validators\IValidation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateTaskServiceTest extends TestCase
{
    public ICreateTaskUseCase $sut;
    public UuidGenerator $mockUuid;
    public ITaskRepository $mockRepository;
    public IValidation $mockValidation;

    protected function setUp(): void
    {
        $this->mockUuid = $this->createMock(UuidGenerator::class);
        $this->mockRepository = $this->createMock(ITaskRepository::class);
        $this->mockValidation = $this->createMock(IValidation::class);
        $this->sut = new CreateTaskUseCase($this->mockRepository, $this->mockUuid, $this->mockValidation);
    }

    public function testShouldBeCreatedATask()
    {
        // arrange
        $expected = OutputCreateTask::class;
        $inputCreateTask = InputCreateTask::create(['description' => 'any_description']);
        $this->mockRepository->method('save')
            ->willReturn(new Task($inputCreateTask->description));
        // act
        $outputCreateTask = $this->sut->execute($inputCreateTask);
        // assert
        $this->assertInstanceOf($expected, $outputCreateTask);
    }

    public function testShouldCallValidate()
    {
        $inputCreateTask = InputCreateTask::create(['description' => 'any_description']);
        $this->mockValidation->expects($this->once())->method('validate');
        $this->sut->execute($inputCreateTask);
    }
}
