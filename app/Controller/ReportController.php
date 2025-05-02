<?php
namespace Controller;

use Model\Building;
use Model\Room;
use Src\View;

class ReportController
{
    public function areaReport(): string
    {
        $buildings = [
            ['id' => 1, 'name' => 'Здание 1', 'rooms_sum' => 200],
            ['id' => 2, 'name' => 'Здание 2', 'rooms_sum' => 150],
        ];
        $total = 300;

        return new View('site.reports.area', ['buildings' => $buildings, 'total' => $total]);
    }

    public function seatsReport(): string
    {
        $buildings = Building::withSum('rooms', 'seats_count')->get();
        return new View('site.reports.seats', ['buildings' => $buildings]);
    }
}