<?php
namespace Middlewares;

use Src\Auth\Auth;

class EmployeeMiddleware
{
    public function handle()
    {
        if (Auth::user()->role->name !== 'employee') {
            app()->route->redirect('/');
        }
    }
}