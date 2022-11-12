<?php

declare(strict_types=1);

namespace App\ToDo\Domain\Utils;

use App\ToDo\Domain\Protocols\AbstractValidator;
use Error;

class ValidationComposite extends AbstractValidator
{
    /** @var AbstractValidator[] $validations */
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
