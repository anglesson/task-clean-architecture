<?php

namespace Test\Domain\UseCases\ListTasks;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCase;
use App\ToDo\Domain\UseCases\ListTasks\ListTasksUseCaseImpl;
use App\ToDo\Domain\Utils\Validators\IValidation;
use PHPUnit\Framework\TestCase;

class ListTasksUseCaseTest extends TestCase
{
    public TaskRepository $mockRepository;
    public IValidation $mockValidation;
    private ListTasksUseCase $sut;

    protected function setUp(): void
    {
        $this->mockRepository = $this->createMock(TaskRepository::class);
        $this->sut = new ListTasksUseCaseImpl($this->mockRepository);
    }

    public function testShouldListAllTasks()
    {
        $repository = $this->createStub(TaskRepository::class);

        $this->mockRepository
            ->method('list')
            ->willReturn([
                $this->createMock(Task::class),
                $this->createMock(Task::class),
                $this->createMock(Task::class),
            ]);

        $tasks = $this->sut->execute();
        $this->assertIsArray($tasks);
        $this->assertCount(3, $tasks);
    }
}
