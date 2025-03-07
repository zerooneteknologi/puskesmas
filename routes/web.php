<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SuportController;
use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::resource('personnel', PersonnelController::class);
Route::resource('emergency', EmergencyController::class);
Route::resource('room', RoomController::class);
Route::resource('laboratory', LaboratoryController::class);
Route::resource('action', ActionController::class);
Route::resource('tool', ToolController::class);
Route::resource('medicine', MedicineController::class);
Route::resource('suport', SuportController::class);
