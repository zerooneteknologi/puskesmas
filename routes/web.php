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
// This route is for unauthenticated admin only
Route::get('/home', [
    App\Http\Controllers\HomeController::class,
    'index',
])->name('home');

Route::middleware(['admin'])->group(function () {
    Route::resource('user', UserController::class)->except(['show']);
    Route::resource('personnel', PersonnelController::class)->only(['update']);
    Route::resource('emergency', EmergencyController::class)->except([
        'create',
        'show',
    ]);
    Route::resource('room', RoomController::class)->except(['create', 'show']);
    Route::resource('laboratory', LaboratoryController::class)->except([
        'create',
        'show',
    ]);
    Route::resource('action', ActionController::class)->except([
        'create',
        'show',
    ]);
    Route::resource('tool', ToolController::class)->except(['create', 'show']);
    Route::resource('medicine', MedicineController::class)->except([
        'create',
        'show',
    ]);
    Route::resource('suport', SuportController::class)->except([
        'create',
        'show',
    ]);

    Route::resource('report', ReportController::class)->only([
        'index',
        'create',
    ]);
    Route::get('print', [PasienController::class, 'print'])->name(
        'pasien.print'
    );
});
// This route is for authenticated users only
Route::middleware(['auth'])->group(function () {
    Route::resource('bill', BillController::class)->only(['store', 'destroy']);
    Route::get('filter', [PasienController::class, 'filter']);
    Route::resource('pasien', PasienController::class)->except([
        'store',
        'edit',
    ]);
    Route::resource('note', NoteController::class)->only([
        'index',
        'create',
        'store',
    ]);
    Route::get('search', [NoteController::class, 'search'])->name(
        'note.search'
    );
});
