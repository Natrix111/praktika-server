<?php
namespace Controller;

use Model\User;
use Model\Role;
use Src\Request;
use Src\View;

class EmployeeController
{
    public function add(Request $request): string
    {
        if ($request->method === 'POST' && User::create([
                ...$request->all(),
                'role_id' => Role::where('name', 'employee')->first()->id
            ])) {
            app()->route->redirect('/');
        }
        return new View('site.employees.add');
    }
}