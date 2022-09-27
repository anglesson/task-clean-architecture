<?php

namespace Anglesson\Task\Domain\Protocols;

interface DeleteTaskService
{
    public function delete(string $idTask): void;
}
