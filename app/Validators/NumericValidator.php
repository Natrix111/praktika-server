<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NumericValidator extends AbstractValidator
{
    protected string $message = 'Field :field must be numeric';

    public function rule(): bool
    {
        return is_numeric($this->value);
    }
}