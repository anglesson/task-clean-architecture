<?php

namespace App\ToDo\Domain\Protocols;

use App\ToDo\Domain\Entity\Task;

interface FindTaskService
{
    public function find($idTask): Task;
}
