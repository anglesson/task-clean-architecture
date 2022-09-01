<?php

namespace Anglesson\Exemplo\Domain;

interface CreateTaskServiceInterface
{
    public function create(Task $task): Task;
}