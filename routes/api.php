<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('doctors', DoctorController::class);
Route::resource('users', UserController::class);
Route::post('users/login', [UserController::class, 'login']);


Route::get('dashboard', [Dashboard::class, 'index']);

//TODO: Create controller functions for specialities.
// Route::resource('specialities', SpecialityController::class);
