<?php

namespace App\ToDo\Domain\UseCases\DeleteTask;

interface DeleteTaskUseCase
{
    public function execute(string $idTask): void;
}
