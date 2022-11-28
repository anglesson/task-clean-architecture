<?php

namespace Test\Domain\UseCases;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Protocols\DeleteTaskService;
use App\ToDo\Domain\Protocols\ITaskRepository;
use App\ToDo\Domain\UseCases\DeleteTask\DeleteTaskServiceImpl;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\Type\VoidType;
use stdClass;

class DeleteTaskServiceTest extends TestCase
{
    private $repository;

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
}
