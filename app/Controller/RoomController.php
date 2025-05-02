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
        return new View('site.rooms.add');
    }

    public function byBuilding(Request $request): string
    {
        return new View('site.rooms.by_building');
    }
}