<?php

namespace App\ToDo\Domain\UseCases\UpdateTask;

interface UpdateTaskUseCase
{
    public function execute(InputUpdateTask $input): OutputUpdateTask;
}
