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
        $buildings = Building::all();
        $currentBuilding = null;
        $rooms = [];
        $searchQuery = '';

        $buildingId = isset($_GET['building_id']) ? $_GET['building_id'] : null;
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

        if ($buildingId) {
            $currentBuilding = Building::find($buildingId);

            if ($currentBuilding) {
                $query = $currentBuilding->rooms();

                if ($searchQuery) {
                    $query->where('name', 'like', "%{$searchQuery}%");
                }

                $rooms = $query->get(['name']);
            }
        }

        return new View('site.rooms.by_building', [
            'buildings' => $buildings,
            'currentBuilding' => $currentBuilding,
            'rooms' => $rooms,
            'searchQuery' => $searchQuery
        ]);
    }
}