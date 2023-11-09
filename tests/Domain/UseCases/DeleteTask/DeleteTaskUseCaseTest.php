<?php

namespace Test\Domain\UseCases\DeleteTask;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\TaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskUseCaseImpl;
use PHPUnit\Framework\TestCase;

class DeleteTaskUseCaseTest extends TestCase
{
    private DeleteTaskUseCaseImpl $sut;
    private TaskRepository $taskRepositoryMock;

    public function setUp(): void
    {
        $taskRepositoryMock = $this->createMock(TaskRepository::class);
        $deleteService = new DeleteTaskUseCaseImpl($taskRepositoryMock);

        $this->sut = $deleteService;
        $this->taskRepositoryMock = $taskRepositoryMock;
    }

    public function testShouldBeDeleteATaskById()
    {
        $idTask = 'any_id';
        $taskStub = $this->createStub(Task::class);

        $taskStub->method('getId')
            ->willReturn($idTask);

        $this->taskRepositoryMock
            ->method('findOne')
            ->willReturn($taskStub);

        $this->taskRepositoryMock
            ->expects($this->once())
            ->method('delete')
            ->with($idTask);

        $this->sut->execute($idTask);
    }

    public function testShouldThrowsExceptionIfTaskNotFound()
    {
        $this->taskRepositoryMock
            ->method('findOne')
            ->willReturn(null);
        $this->expectException(TaskNotFoundException::class);
        $this->sut->execute('any_id');
    }
}
