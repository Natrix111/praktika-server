<?php
namespace Controller;

use Model\Room;
use Model\Building;
use Model\RoomType;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class RoomController
{
    public function add(Request $request): string
    {
        $buildings = Building::all();
        $types = RoomType::all();

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'type_id' => ['required', 'numeric'],
                'building_id' => ['required', 'numeric'],
                'area' => [
                    'required',
                    'numeric',
                    'positive',
                    "area_available:{$request->building_id}"
                ],
                'seats_count' => ['numeric', 'positive']
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'numeric' => 'Поле :field должно быть числом',
                'positive' => 'Поле :field должно быть положительным числом',
                'area_available' => 'В здании недостаточно свободной площади'
            ]);

            if ($validator->fails()) {
                return new View('site.rooms.add', [
                    'buildings' => $buildings,
                    'types' => $types,
                    'message' => $validator->errors()
                ]);
            }

            if (Room::create($request->all())) {
                app()->route->redirect('/');
            }
        }

        return new View('site.rooms.add', [
            'buildings' => $buildings,
            'types' => $types
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