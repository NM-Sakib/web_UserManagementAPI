<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('/users', UserController::class);
});

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('/roles', RoleController::class);
});

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('/permissions', PermissionController::class);
});