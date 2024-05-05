<?php
namespace Test\Domain\UseCases\CreateList;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\Entity\TaskList;
use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCase;
use App\ToDo\Domain\UseCases\CreateList\CreateTaskListUseCaseImpl;
use App\ToDo\Domain\UseCases\CreateList\OutputCreateTaskList;
use PHPUnit\Framework\TestCase;

class CreateListTest extends TestCase
{
    private CreateTaskListUseCaseImpl $sut;
    private TaskListRepository $mockRepository;
    public UuidGenerator $mockUuid;
    protected function setUp(): void
    {
        $this->mockUuid = $this->createMock(UuidGenerator::class);
        $this->mockRepository = $this->createMock(TaskListRepository::class);
        $this->sut = new CreateTaskListUseCaseImpl($this->mockRepository, $this->mockUuid);
    }
    public function testShouldCreateANewInstanceOfTaskList()
    {
        $createList = new CreateTaskListUseCaseImpl($this->mockRepository);
        $this->assertInstanceOf(CreateTaskListUseCase::class, $createList);
    }

    public function testShouldBeCallRepositoryFunctionWithCorrectValues()
    {
        // arrange
        $expected = new TaskList('any_list_name');

        // assert
        $this->mockRepository
            ->expects($this->once())
            ->method("save")
            ->with($expected);

        // act
        $this->sut->execute('any_list_name');
    }

    public function testShouldBeReturnAOutputCreateTask()
    {
        // arrange
        $taskList = new TaskList('any_list_name');
        $taskList->add(new Task('Teste'));
        $expected = OutputCreateTaskList::create($taskList);

        $this->mockRepository
            ->method("save")
            ->willReturn($taskList);

        // act
        $output = $this->sut->execute('any_list_name');

        // assert
        $this->assertEquals($expected, $output);
    }
}
