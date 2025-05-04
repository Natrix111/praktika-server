<?php
namespace Controller;

use Model\Building;
use Model\Room;
use Src\View;

class ReportController
{
    public function areasReport(): string
    {
        $buildings = Building::with('rooms')->get();

        $buildings->each(function($building) {
            $building->total_area = $building->rooms->sum('area');
        });

        $grandTotal = $buildings->sum('total_area');

        return new View('site.reports.area', [
            'buildings' => $buildings,
            'grandTotal' => $grandTotal
        ]);
    }

    public function seatsReport(): string
    {
        $buildings = Building::with(['rooms' => function($query) {
            $query->whereNotNull('seats_count');
        }])->get();

        $buildings->each(function($building) {
            $building->total_seats = $building->rooms->sum('seats_count');
        });

        return new View('site.reports.seats', [
            'buildings' => $buildings
        ]);
    }
}