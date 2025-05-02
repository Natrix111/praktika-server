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
        return new View('site.buildings.add');
    }
}