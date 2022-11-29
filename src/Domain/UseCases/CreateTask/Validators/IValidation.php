<?php

namespace App\ToDo\Domain\UseCases\CreateTask\Validators;

use Error;

interface IValidation
{
    public function validate(mixed $input = null): ?Error;
}
