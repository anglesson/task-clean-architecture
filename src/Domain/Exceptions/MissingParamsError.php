<?php

namespace App\ToDo\Domain\Exceptions;

use Throwable;
use DomainException;
use Error;

class MissingParamsError extends Error
{
    public function __construct($field = "", $code = 422, Throwable $previous = null)
    {
        parent::__construct("Missing '{$field}' param", $code, $previous);
    }
}
