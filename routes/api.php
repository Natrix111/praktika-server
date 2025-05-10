<?php

use Src\Route;


Route::add('POST', '/echo', [Controller\Api::class, 'echo']);
Route::add('GET', '/', [Controller\Api::class, 'index']);


Route::add('POST', '/login', [Controller\Api\AuthController::class, 'login'])->middleware('token');
Route::add('POST', '/buildings', [Controller\Api\BuildingController::class, 'add'])->middleware('token');