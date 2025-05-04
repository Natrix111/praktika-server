<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class ImageValidator extends AbstractValidator
{
    protected string $message = 'Файл должен быть изображением (jpg, png, gif)';

    public function rule(): bool
    {
        if (empty($this->value['tmp_name'])) {
            return true; // Файл не обязателен
        }

        $allowed = ['image/jpeg', 'image/png', 'image/gif'];
        $type = mime_content_type($this->value['tmp_name']);

        return in_array($type, $allowed);
    }
}