<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MinValidator extends AbstractValidator
{
    protected string $message = 'Field :field must be at least :min characters';

    public function rule(): bool
    {
        return strlen($this->value) >= $this->args[0];
    }
}