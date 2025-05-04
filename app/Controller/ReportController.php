<?php
namespace Controller;

use Model\Building;
use Model\Room;
use Src\View;

class ReportController
{
    public function areasReport(): string
    {
        // Получаем все здания с их помещениями
        $buildings = Building::with('rooms')->get();

        // Добавляем вычисляемое поле с общей площадью
        $buildings->each(function($building) {
            $building->total_area = $building->rooms->sum('area');
        });

        // Общая площадь всех зданий
        $grandTotal = $buildings->sum('total_area');

        return new View('site.reports.area', [
            'buildings' => $buildings,
            'grandTotal' => $grandTotal
        ]);
    }

    public function seatsReport(): string
    {
        // Получаем все здания с помещениями, где указано количество мест
        $buildings = Building::with(['rooms' => function($query) {
            $query->whereNotNull('seats_count');
        }])->get();

        // Добавляем вычисляемое поле с общим количеством мест
        $buildings->each(function($building) {
            $building->total_seats = $building->rooms->sum('seats_count');
        });

        return new View('site.reports.seats', [
            'buildings' => $buildings
        ]);
    }
}