<?php

namespace App\ToDo\Domain\Utils;

use Error;

abstract class AbstractValidator
{
    abstract public function validate(): ?Error;
}
