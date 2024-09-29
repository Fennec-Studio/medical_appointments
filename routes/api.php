<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('doctors', DoctorController::class);
//TODO: Create controller functions for specialities.
// Route::resource('specialities', SpecialityController::class);
