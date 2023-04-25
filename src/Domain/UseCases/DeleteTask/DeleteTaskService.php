<?php

namespace App\ToDo\Domain\UseCases\DeleteTask;

interface DeleteTaskService
{
    public function delete(string $idTask): void;
}
