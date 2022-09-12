<?php

namespace Anglesson\Exemplo\Domain\Errors;

use \DomainException;
use Throwable;

class TaskNotBeCreatedWithStatusFinishedException extends DomainException
{
  public function __construct($message = "", $code = 400, Throwable $previous = null)
  {
      parent::__construct($message, $code, $previous);
  }
}