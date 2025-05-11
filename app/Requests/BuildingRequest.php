<?php

namespace Requests;

use RequestValidator\Requests\AbstractRequest;
use RequestValidator\Validator\Validator;

class BuildingRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:buildings,name'],
            'address' => ['required'],
            'area' => ['numeric', 'positive']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :field обязательно',
            'unique' => 'Поле :field должно быть уникально',
            'numeric' => 'Поле :field должно быть числом',
            'positive' => 'Поле :field должно быть положительным числом'
        ];
    }

    public function validate(): array
    {
        $validator = new Validator($this->data, $this->rules(), $this->messages());
        $validator->validateOrFail();

        return $this->validated();
    }
}