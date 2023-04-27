<?php

namespace App\ToDo\Domain\UseCases\DeleteTask;

interface IDeleteTaskUseCase
{
    public function execute(string $idTask): void;
}
