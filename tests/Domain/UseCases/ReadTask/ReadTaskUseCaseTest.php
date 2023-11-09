<?php

namespace Test\Domain\UseCases\ReadTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateTask\OutputCreateTask;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCase;
use App\ToDo\Domain\UseCases\ReadTask\ReadTaskUseCaseImpl;
use App\ToDo\Domain\Utils\Validators\IValidation;
use App\ToDo\Infrastructure\Repositories\InMemory\InMemoryRepository;
use PHPUnit\Framework\TestCase;

class ReadTaskUseCaseTest extends TestCase
{
    public ReadTaskUseCase $sut;
    public UuidGenerator $mockUuid;
    public TaskRepository $mockRepository;
    public IValidation $mockValidation;

    protected function setUp(): void
    {
        $this->mockRepository = $this->createMock(TaskRepository::class);
        $this->sut = new ReadTaskUseCaseImpl($this->mockRepository);
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
        $findTaskService = new ReadTaskUseCaseImpl($repository);

        $findTaskService->execute('any_id');
    }
}
