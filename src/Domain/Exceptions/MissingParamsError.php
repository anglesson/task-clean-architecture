<?php

namespace App\ToDo\Domain\Exceptions;

use Throwable;
use DomainException;

class MissingParamsError extends DomainException
{
    public function __construct($field = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct("Missing '{$field}' param", $code, $previous);
    }
}
