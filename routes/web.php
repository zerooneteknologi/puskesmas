<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SuportController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::middleware(['admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('personnel', PersonnelController::class);
    Route::resource('emergency', EmergencyController::class);
    Route::resource('room', RoomController::class);
    Route::resource('laboratory', LaboratoryController::class);
    Route::resource('action', ActionController::class);
    Route::resource('tool', ToolController::class);
    Route::resource('medicine', MedicineController::class);
    Route::resource('suport', SuportController::class);
    Route::resource('bill', BillController::class);
    Route::resource('pasien', PasienController::class);
    Route::get('filter', [PasienController::class, 'filter']);
    Route::resource('report', ReportController::class);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('note', NoteController::class);
    Route::get('search', [NoteController::class, 'search'])->name(
        'note.search'
    );
});
