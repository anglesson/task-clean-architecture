<?php
namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Domain\Entity\TaskList;
use App\ToDo\Domain\Protocols\TaskListRepository;
use App\ToDo\Domain\Protocols\UuidGenerator;

class CreateTaskListUseCaseImpl implements CreateTaskListUseCase
{
    public function __construct(
        private TaskListRepository $taskListRepository,
        private UuidGenerator $uuidGenerator,
    ) {
    }

    public function execute(string $name): OutputCreateTaskList
    {
        $taskList = new TaskList($name, $this->uuidGenerator->generateId());
        $createdTaskList = $this->taskListRepository->save($taskList);
        return OutputCreateTaskList::create($createdTaskList);
    }
}
