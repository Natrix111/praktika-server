<?php
namespace Controller;

use Model\Room;
use Model\Building;
use Model\RoomType;
use Src\Request;
use Src\View;

class RoomController
{
    public function add(Request $request): string
    {
        if ($request->method === 'POST' && Room::create($request->all())) {
            app()->route->redirect('/');
        }
        return new View('site.rooms.add', [
            'buildings' => Building::all(),
            'types' => RoomType::all()
        ]);
    }

    public function byBuilding(Request $request): string
    {
        return new View('site.rooms.by_building');
    }
}