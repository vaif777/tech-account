<?php

use App\Http\Controllers\ActivatedController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TelecommunicationCabinetController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::get('/activated', [ActivatedController::class, 'index'])->name('activated');
    
});

Route::group(['middleware' => ['auth', 'verified', 'confirmEachNewRegisteredUser']], function(){

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/floor/{building}/index', [FloorController::class, 'index'])->name('floor.index'); 
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    Route::resource('/telecom-cabinet', TelecommunicationCabinetController::class);
    Route::resource('/building', BuildingController::class);
    Route::resource('/floor', FloorController::class, ['except' => ['index']]);
    Route::resource('/room', RoomController::class);
    Route::resource('/user', UserController::class);
    
});