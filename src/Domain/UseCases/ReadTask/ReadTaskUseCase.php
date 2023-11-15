<?php

namespace App\ToDo\Domain\UseCases\ReadTask;

interface ReadTaskUseCase
{
    public function execute($idTask): OutputReadTask;
}
