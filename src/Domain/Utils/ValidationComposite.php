<?php

declare(strict_types=1);

namespace App\ToDo\Domain\Utils;

use App\ToDo\Domain\UseCases\CreateTask\Validators\IValidation;
use Error;

class ValidationComposite implements IValidation
{
    /** @var IValidation[] $validations */
    private readonly array $validations;

    /**
     * @param IValidation[] $validations
    */
    public function __construct(array $validations)
    {
        $this->validations = $validations;
    }

    public function validate(mixed $input = null): ?Error
    {
        foreach ($this->validations as $validation) {
            $error = $validation->validate($input);
            if ($error) {
                return $error;
            }
        }
        return null;
    }
}
