<?php

namespace App\ToDo\Domain\Utils\Validators;

use Error;

abstract class AbstractValidator
{
    abstract public function validate(): ?Error;
}
