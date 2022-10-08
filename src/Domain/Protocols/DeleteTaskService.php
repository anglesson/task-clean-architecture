<?php

namespace App\ToDo\Domain\Protocols;

interface DeleteTaskService
{
    public function delete(string $idTask): void;
}
