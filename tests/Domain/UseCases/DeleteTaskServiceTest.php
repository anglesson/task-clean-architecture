<?php

namespace Test\Domain\UseCases;

use App\ToDo\Application\UseCases\DeleteTask\IDeleteTaskUseCaseImpl;
use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\IDeleteTaskUseCase;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteTaskServiceTest extends TestCase
{
    private IDeleteTaskUseCaseImpl $sut;
    private ITaskRepository $taskRepositoryMock;

    public function setUp(): void
    {
        $taskRepositoryMock = $this->createMock(ITaskRepository::class);
        $deleteService = new IDeleteTaskUseCaseImpl($taskRepositoryMock);

        $this->sut = $deleteService;
        $this->taskRepositoryMock = $taskRepositoryMock;
    }

    public function testShouldBeDeleteATaskById()
    {
        $idTask = 'any_id';

        $this->taskRepositoryMock
            ->method('findOne')
            ->willReturn(new Task( 'any_description', $idTask));

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
