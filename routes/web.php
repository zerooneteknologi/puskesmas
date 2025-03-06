<?php

use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\PersonnelController;
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
