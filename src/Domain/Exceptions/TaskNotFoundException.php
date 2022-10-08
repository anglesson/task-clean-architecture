<?php

namespace App\ToDo\Domain\Exceptions;

use Throwable;
use \DomainException;

class TaskNotFoundException extends DomainException
{
    public function __construct($message = "Task not found", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
