<?php

namespace App\ToDo\Domain\Utils\Validators;

use Error;

interface IValidation
{
    public function validate(mixed $input = null): ?Error;
}
