<?php

namespace Test\Domain\UseCases\UpdateTask;

use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCaseImpl;
use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Application\UseCases\FindTask\FindTaskUseCaseImpl;
use App\ToDo\Application\UseCases\UpdateTask\InputUpdateTask;
use App\ToDo\Application\UseCases\UpdateTask\OutputUpdateTask;
use App\ToDo\Application\UseCases\UpdateTask\UpdateTaskServiceImpl;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\Validators\IValidation;
use App\ToDo\Domain\UseCases\UpdateTask\IUpdateTaskUseCase;
use App\ToDo\Domain\Utils\ValidationComposite;
use App\ToDo\Infrastructure\Repositories\InMemory\InMemoryRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class UpdateTaskServiceTest extends TestCase
{
    public IUpdateTaskUseCase $sut;
    public UuidGenerator $mockUuid;
    public ITaskRepository $mockRepository;
    public IValidation $mockValidation;

    protected function setUp(): void
    {
        $this->mockUuid = $this->createMock(UuidGenerator::class);
        $this->mockRepository = $this->createMock(ITaskRepository::class);
        $this->mockValidation = $this->createMock(IValidation::class);
        $this->sut = new UpdateTaskServiceImpl($this->mockRepository);
    }

    public function testShouldBeUpdateATask()
    {
        $this->mockRepository
            ->method('findOne')
            ->willReturn(new Task('any_description'));
        $data = ['description' => 'any_description', 'id' => 'any_id'];
        $inputUpdateTask = InputUpdateTask::create($data);
        $outputUpdateTask = $this->sut->execute($inputUpdateTask);

        $this->assertInstanceOf(OutputUpdateTask::class, $outputUpdateTask);
    }
}
