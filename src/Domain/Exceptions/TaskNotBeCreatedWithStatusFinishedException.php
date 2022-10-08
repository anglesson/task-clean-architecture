<?php

namespace App\ToDo\Domain\Exceptions;

use Throwable;
use \DomainException;

class TaskNotBeCreatedWithStatusFinishedException extends DomainException
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
