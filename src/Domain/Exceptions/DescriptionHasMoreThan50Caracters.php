<?php

namespace Anglesson\Task\Domain\Exceptions;

use Throwable;
use \DomainException;

class DescriptionHasMoreThan50Caracters extends DomainException
{
    public function __construct($message = "It is not possible save task with a description more than 50 caracters", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
