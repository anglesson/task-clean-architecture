<?php

declare(strict_types=1);

namespace App\ToDo\Domain\Utils;

use App\ToDo\Domain\Protocols\Validator;
use Error;

class ValidationComposite implements Validator
{
    /** @var Validator[] $validations */
    public function __construct(private readonly array $validations)
    {
    }

    public function validate(): ?Error
    {
        foreach ($this->validations as $validation) {
            $error = $validation->validate();
            if ($error) {
                return $error;
            }
        }
        return null;
    }
}
