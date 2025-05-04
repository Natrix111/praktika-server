<?php

namespace Controller;

use Model\User;
use Model\Role;
use Src\Request;
use Src\View;
use Src\Validator\Validator;

class EmployeeController
{
    public function add(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required'],
                'avatar' => ['image']
            ], [
                'required' => 'Поле :field обязательно',
                'unique' => 'Логин уже занят',
                'image' => 'Загрузите изображение (jpg, png, gif)'
            ]);

            if ($validator->fails()) {
                return new View('site.employees.add', [
                    'message' => $validator->errors()
                ]);
            }

            $avatarPath = null;
            if (!empty($request->files()['avatar']['tmp_name'])) {
                $file = $request->files()['avatar'];
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $ext;
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/images/';

                if (move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
                    $avatarPath = '/public/images/' . $filename;
                }
            }

            $userData = [
                'name' => $request->name,
                'login' => $request->login,
                'password' => md5($request->password),
                'role_id' => Role::where('name', 'employee')->first()->id,
                'avatar' => $avatarPath // Может быть null
            ];

            if (User::create($userData)) {
                app()->route->redirect('/');
            }
        }

        return new View('site.employees.add');
    }
}