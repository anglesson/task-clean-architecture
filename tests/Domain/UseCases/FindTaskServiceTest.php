<?php

namespace Test\Domain\UseCases;

use App\ToDo\Application\UseCases\CreateTask\CreateTaskUseCaseImpl;
use App\ToDo\Application\UseCases\CreateTask\InputCreateTask;
use App\ToDo\Application\UseCases\FindTask\FindTaskUseCaseImpl;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\ICreateTaskUseCase;
use App\ToDo\Domain\UseCases\CreateTask\Validators\IValidation;
use App\ToDo\Domain\UseCases\FindTask\IFindTaskUseCase;
use App\ToDo\Domain\Utils\ValidationComposite;
use App\ToDo\Infrastructure\Repositories\InMemory\InMemoryRepository;
use App\ToDo\Infrastructure\Utils\RamseyUuidImpl;
use PHPUnit\Framework\TestCase;

class FindTaskServiceTest extends TestCase
{
    public IFindTaskUseCase $sut;
    public UuidGenerator $mockUuid;
    public ITaskRepository $mockRepository;
    public IValidation $mockValidation;

    protected function setUp(): void
    {
        $this->mockRepository = $this->createMock(ITaskRepository::class);
        $this->sut = new FindTaskUseCaseImpl($this->mockRepository);
    }

    public function testShouldBeFindedATaskById()
    {
        // arrange
        $mockTask = new Task('any_id', 'any_description');

        $this->mockRepository
            ->method('findOne')
            ->willReturn($mockTask);
        // act
        $task = $this->sut->execute('any_id');

        // assert
        $this->assertInstanceOf(Task::class, $task);
    }

    public function testShouldBeReturnExceptionIfTaskNotFounded()
    {
        $this->expectException(TaskNotFoundException::class);
        $repository = new InMemoryRepository();
        $findTaskService = new FindTaskUseCaseImpl($repository);

        $findTaskService->execute('any_id');
    }
}
