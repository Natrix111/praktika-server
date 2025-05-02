<?php

use Src\Route;

Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);


Route::add('GET', '/', [Controller\Site::class, 'hello'])
    ->middleware('auth');

Route::add(['GET', 'POST'], '/employees/add', [Controller\EmployeeController::class, 'add'])
    ->middleware('auth', 'admin');

Route::add(['GET', 'POST'], '/buildings/add', [Controller\BuildingController::class, 'add'])
    ->middleware('auth', 'employee');

Route::add(['GET', 'POST'], '/rooms/add', [Controller\RoomController::class, 'add'])
    ->middleware('auth', 'employee');

Route::add('GET', '/rooms/by-building', [Controller\RoomController::class, 'byBuilding'])
    ->middleware('auth', 'employee');

Route::add('GET', '/reports/area', [Controller\ReportController::class, 'areaReport'])
    ->middleware('auth', 'employee');

Route::add('GET', '/reports/seats', [Controller\ReportController::class, 'seatsReport'])
    ->middleware('auth', 'employee');