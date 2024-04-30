<?php

namespace App\ToDo\Domain\UseCases\CreateList;

use App\ToDo\Domain\UseCases\CreateList\OutputCreateList;

interface CreateListUseCase
{
    public function execute(string $name): OutputCreateList;
}
