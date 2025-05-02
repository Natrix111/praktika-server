<?php

namespace Middlewares;

use Src\Auth\Auth;

class AdminMiddleware
{
    public function handle()
    {
        if (Auth::user()->role->name !== 'admin') {
            app()->route->redirect('/');
        }
    }
}