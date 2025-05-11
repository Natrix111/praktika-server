<?php

namespace Controller;

use Model\Building;
use Requests\BuildingRequest;
use RequestValidator\Exceptions\ValidationException;
use Src\Request;
use Src\View;

class BuildingController
{
    public function add(Request $request): string
    {
        if ($request->method === 'POST') {
            try {
                $validatedData = (new BuildingRequest($request->all()))->validate();
                $validatedData['created_by'] = app()->auth->user()->id;

                if (Building::create($validatedData)) {
                    app()->route->redirect('/');
                    return true;
                }
            } catch (ValidationException $e) {
                return new View('site.buildings.add', [
                    'message' => $e->getErrors(),
                ]);
            }
        }

        return new View('site.buildings.add');
    }
}
