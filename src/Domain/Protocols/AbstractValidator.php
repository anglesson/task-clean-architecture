<?php

namespace App\ToDo\Domain\Protocols;

use Error;

abstract class AbstractValidator
{
    abstract public function validate(): ?Error;
}
