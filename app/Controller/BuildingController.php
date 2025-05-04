<?php

namespace Controller;

use Model\Building;
use Src\Auth\Auth;
use Src\Request;
use Src\View;

class BuildingController
{
    public function add(Request $request): string
    {
        if ($request->method === 'POST' && Building::create([
                ...$request->all(),
                'created_by' => Auth::user()->id
            ])) {
            app()->route->redirect('/');
        }
        return new View('site.buildings.add');
    }
}