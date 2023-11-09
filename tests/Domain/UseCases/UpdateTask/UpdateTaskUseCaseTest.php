<?php

namespace Test\Domain\UseCases\UpdateTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Domain\UseCases\UpdateTask\OutputUpdateTask;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCase;
use App\ToDo\Domain\UseCases\UpdateTask\UpdateTaskUseCaseImpl;
use App\ToDo\Domain\Utils\Validators\IValidation;
use PHPUnit\Framework\TestCase;

class UpdateTaskUseCaseTest extends TestCase
{
    public UpdateTaskUseCase $sut;
    public UuidGenerator $mockUuid;
    public TaskRepository $mockRepository;
    public IValidation $mockValidation;

    protected function setUp(): void
    {
        $this->mockUuid = $this->createMock(UuidGenerator::class);
        $this->mockRepository = $this->createMock(TaskRepository::class);
        $this->mockValidation = $this->createMock(IValidation::class);
        $this->sut = new UpdateTaskUseCaseImpl($this->mockRepository);
    }

    public function testShouldBeUpdateATask()
    {
        $this->mockRepository
            ->method('findOne')
            ->willReturn(new Task('any_id', 'any_description'));
        $data = ['description' => 'any_description', 'id' => 'any_id'];
        $inputUpdateTask = InputUpdateTask::create($data);
        $outputUpdateTask = $this->sut->execute($inputUpdateTask);

        $this->assertInstanceOf(OutputUpdateTask::class, $outputUpdateTask);
    }
}
