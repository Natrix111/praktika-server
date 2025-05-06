<?php

namespace Requests;

use RequestValidator\Requests\AbstractRequest;

class RoomRequest extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'type_id' => ['required', 'numeric'],
            'building_id' => ['required', 'numeric'],
            'area' => ['required', 'numeric', 'positive', "area_available:{$this->data['building_id']}"],
            'seats_count' => ['numeric', 'positive']
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :field обязательно для заполнения',
            'numeric' => 'Поле :field должно быть числом',
            'positive' => 'Поле :field должно быть положительным числом',
            'area_available' => 'В здании недостаточно свободной площади'
        ];
    }
}