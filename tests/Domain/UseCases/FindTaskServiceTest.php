<?php

namespace Test\Domain\UseCases;

use App\ToDo\Application\UseCases\CreateTask\OutputCreateTask;
use App\ToDo\Application\UseCases\FindTask\FindTaskUseCaseImpl;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\FindTask\IFindTaskUseCase;
use App\ToDo\Domain\Utils\Validators\IValidation;
use App\ToDo\Infrastructure\Repositories\InMemory\InMemoryRepository;
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
        $output = $this->sut->execute('any_id');

        // assert
        $this->assertInstanceOf(OutputCreateTask::class, $output);
    }

    public function testShouldBeReturnExceptionIfTaskNotFounded()
    {
        $this->expectException(TaskNotFoundException::class);
        $repository = new InMemoryRepository();
        $findTaskService = new FindTaskUseCaseImpl($repository);

        $findTaskService->execute('any_id');
    }
}
