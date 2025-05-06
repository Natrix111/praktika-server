<?php

namespace Requests;

use RequestValidator\Requests\AbstractRequest;

class EmployeeRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'login' => ['required', 'unique:users,login'],
            'password' => ['required'],
            'avatar' => ['image']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :field обязательно',
            'unique' => 'Логин уже занят',
            'image' => 'Загрузите изображение (jpg, png, gif)'
        ];
    }
}