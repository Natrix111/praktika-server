<?php

namespace Controller;

use Model\User;
use Model\Role;
use Requests\EmployeeRequest;
use RequestValidator\Exceptions\ValidationException;
use Services\ImageService;
use Src\Request;
use Src\View;

class EmployeeController
{
    public function add(Request $request): string
    {
        if ($request->method === 'POST') {
            try {
                $validatedData = (new EmployeeRequest($request->all()))->validate();

                $avatarPath = ImageService::upload($request->files()['avatar'] ?? []);

                $userData = [
                    'name' => $validatedData['name'],
                    'login' => $validatedData['login'],
                    'password' => md5($validatedData['password']),
                    'role_id' => Role::where('name', 'employee')->first()->id,
                    'avatar' => $avatarPath
                ];

                if (User::create($userData)) {
                    app()->route->redirect('/');
                }
            } catch (ValidationException $e) {
                return new View('site.employees.add', [
                    'message' => $e->getErrors(),
                ]);
            }
        }

        return new View('site.employees.add');
    }
}