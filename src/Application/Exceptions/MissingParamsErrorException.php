<?php

namespace Anglesson\Task\Application\Exceptions;

use Throwable;
use Symfony\Component\Console\Exception\MissingInputException;

class MissingParamsErrorException extends MissingInputException
{
    public function __construct($message = "Missing field params", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
