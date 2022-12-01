<?php

namespace App\ToDo\Domain\UseCases\CreateTask\Validators;

use App\ToDo\Domain\Utils\RequiredFieldValidation;
use App\ToDo\Domain\Utils\ValidationComposite;

class CreateTaskValidationFactory
{
    private static array $validations = [];

    public static function makeValidations(): IValidation
    {
        self::$validations[] = new RequiredFieldValidation('description');
        return new ValidationComposite(self::$validations);
    }
}
