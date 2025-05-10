<?php

namespace Controller\Api;

use Model\Building;
use Requests\BuildingRequest;
use RequestValidator\Exceptions\ValidationException;
use Src\Auth\Auth;
use Src\Request;
use Src\View;

class BuildingController
{
    public function add(Request $request): void
    {
        try {
            $validatedData = (new BuildingRequest($request->all()))->validate();

            $validatedData['created_by'] = Auth::user()->id;

            $building = Building::create($validatedData);

            (new View())->toJSON([
                'message' => 'Здание успешно создано!',
                'data' => $building,
            ], 201);

        } catch (ValidationException $e) {
            (new View())->toJSON([
                'message' => 'Ошибка валидации',
                'errors' => $e->getErrors(),
            ], 422);
        }
    }
}