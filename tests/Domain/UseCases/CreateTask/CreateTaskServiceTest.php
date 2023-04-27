<?php

namespace Test\Domain\UseCases\CreateTask;

use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCase;
use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\Validators\IValidation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateTaskServiceTest extends TestCase
{
    public array $sut;

    protected function setUp(): void
    {
        $mockUuid = $this->createMock(UuidGenerator::class);
        $mockRepository = $this->createMock(ITaskRepository::class);
        $mockValidation = $this->createMock(IValidation::class);
        $sut = new CreateTaskUseCase($mockRepository, $mockUuid, $mockValidation);
        $this->sut = [$sut, $mockRepository, $mockUuid, $mockValidation];
    }

    public function testShouldBeCreatedATask()
    {
        /** @var CreateTaskUseCase $sut */
        [$sut, $repository] = $this->sut;
        $inputCreateTask = InputCreateTask::create(['description' => 'any_description']);
        $repository->method('save')->willReturn((new Task())->fill($inputCreateTask->toArray()));
        $outputCreateTask = $sut->execute($inputCreateTask);
        $this->assertEquals('any_description', $outputCreateTask->description);
    }

    public function testSholdCallValidate()
    {
        /**
         * @var CreateTaskUseCase $sut
         * @var MockObject $validation
         */
        [$sut,,, $validation] = $this->sut;
        $inputCreateTask = InputCreateTask::create(['description' => 'any_description']);
        $validation->expects($this->once())->method('validate');
        $sut->execute($inputCreateTask);
    }
}
