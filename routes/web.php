<?php

use App\Http\Controllers\FloorController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\TelecommunicationCabinetController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/floor/{building}/index', [FloorController::class, 'index'])->name('floor.index'); 

    Route::resource('/telecom-cabinet', TelecommunicationCabinetController::class);
    Route::resource('/building', BuildingController::class);
    Route::resource('/floor', FloorController::class, ['except' => ['index']]);
    Route::resource('/room', RoomController::class);
    Route::resource('/user', UserController::class);
    
});
