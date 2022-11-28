<?php

namespace Test\Domain\UseCases;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Exceptions\TaskNotFoundException;
use App\ToDo\Domain\Protocols\DeleteTaskService;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskServiceImpl;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteTaskServiceTest extends TestCase
{
    private array $sut;

    public function setUp(): void
    {
        $repositoryMock = $this->createMock(ITaskRepository::class);
        $deleteService = new DeleteTaskServiceImpl($repositoryMock);

        $this->sut = [
            $deleteService,
            $repositoryMock
        ];
    }

    public function testShouldBeDeleteATaskById()
    {
        /**
         * @var DeleteTaskService $sut
         * @var MockObject $repository
         */
        [$sut, $repository] = $this->sut;
        $repository
            ->method('findOne')
            ->willReturn((new Task())->setId('any_id'));
        $repository
            ->expects($this->once())
            ->method('delete')
            ->with('any_id');
        $sut->delete('any_id');
    }

    public function testShouldThrowsExceptionIfTaskNotFound()
    {
        /**
         * @var DeleteTaskService $sut
         * @var MockObject $repository
         */
        [$sut, $repository] = $this->sut;
        $repository
            ->method('findOne')
            ->willReturn(null);
        $this->expectException(TaskNotFoundException::class);
        $sut->delete('any_id');
    }
}
