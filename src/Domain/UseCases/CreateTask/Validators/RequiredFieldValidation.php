<?php

namespace App\ToDo\Domain\UseCases\CreateTask\Validators;

use App\ToDo\Domain\Exceptions\MissingParamsError;
use Error;

class RequiredFieldValidation implements IValidation
{
    private readonly string $fieldName;

    public function __construct(string $fieldName)
    {
        $this->fieldName = $fieldName;
    }

    public function validate(mixed $input = null): ?Error
    {
        if (!$input[$this->fieldName]) {
            return new MissingParamsError($this->fieldName);
        }
        return null;
    }
}
