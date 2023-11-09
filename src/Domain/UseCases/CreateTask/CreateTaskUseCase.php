<?php

namespace App\ToDo\Domain\UseCases\CreateTask;

interface CreateTaskUseCase
{
    public function execute(InputCreateTask $inputCreateTask): OutputCreateTask;
}
