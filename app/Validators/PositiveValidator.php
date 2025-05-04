<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PositiveValidator extends AbstractValidator
{
    protected string $message = 'Field :field must be positive';

    public function rule(): bool
    {
        return $this->value > 0;
    }
}