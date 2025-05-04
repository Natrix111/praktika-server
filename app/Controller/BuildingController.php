<?php

namespace Controller;

use Model\Building;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class BuildingController
{

    public function add(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'address' => ['required'],
                'area' => ['numeric', 'positive']
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'numeric' => 'Поле :field должно быть числом',
                'positive' => 'Поле :field должно быть положительным числом'
            ]);

            if ($validator->fails()) {
                return new View('site.buildings.add', [
                    'message' => $validator->errors()
                ]);
            }

            $data = $request->all();
            $data['created_by'] = app()->auth->user()->id;

            if (Building::create($data)) {
                app()->route->redirect('/');
            }
        }

        return new View('site.buildings.add');
    }
}