<?php

namespace App\ToDo\Domain\Exceptions;

use DomainException;
use Throwable;

class InvalidParamError extends DomainException
{
    public function __construct($fieldName, $code = 400, Throwable $previous = null)
    {
        parent::__construct("Missing '{$fieldName}' param", $code, $previous);
    }
}
