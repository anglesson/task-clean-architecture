<?php
namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Domain\Entity\TaskList;
use App\ToDo\Domain\Protocols\TaskListRepository;

class CreateTaskListUseCaseImpl implements CreateTaskListUseCase
{
    public function __construct(private TaskListRepository $taskListRepository)
    {
    }

    public function execute(string $name): OutputCreateTaskList
    {
        $taskList = new TaskList($name);
        $createdTaskList = $this->taskListRepository->save($taskList);
        return OutputCreateTaskList::create($createdTaskList);
    }
}
