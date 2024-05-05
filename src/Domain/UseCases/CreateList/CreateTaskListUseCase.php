<?php

namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Domain\UseCases\CreateList\OutputCreateList;

interface CreateTaskListUseCase
{
    public function execute(string $name): OutputCreateList;
}
