<?php
namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Domain\Entity\TaskList;
use App\ToDo\Domain\Protocols\TaskListRepository;

class CreateListUseCaseImpl implements CreateListUseCase
{
    public function __construct(private TaskListRepository $taskListRepository)
    {
    }

    public function execute(string $name): OutputCreateList
    {
        $taskList = new TaskList($name);
        $createdTaskList = $this->taskListRepository->save($taskList);
        return OutputCreateList::create($createdTaskList);
    }
}
