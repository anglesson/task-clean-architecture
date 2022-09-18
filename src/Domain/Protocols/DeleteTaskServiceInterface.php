<?php

namespace Anglesson\Task\Domain\Protocols;

interface DeleteTaskServiceInterface
{
    public function delete(string $idTask): void;
}
