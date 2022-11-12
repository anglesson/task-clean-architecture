<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;
use App\ToDo\Domain\UseCases\CreateTask\InputCreateTask;

interface CreateTaskService
{
    public function create(InputCreateTask $inputCreateTask): Task;
}
