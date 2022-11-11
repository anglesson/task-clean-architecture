<?php

namespace App\ToDo\Domain\Protocols;

use Error;

interface Validator
{
    public function validate(): ?Error;
}
