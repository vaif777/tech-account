<?php

use App\Http\Controllers\ActivatedController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\RegistrationInvitationController;
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

Route::get('/activated', [ActivatedController::class, 'index'])->name('activated')->middleware(['auth', 'verified']);

Route::get('/registr-invitation/{id}/{mail}', [RegistrationInvitationController::class, 'formRegistr'])->name('registr_invitation');
Route::post('/registr-invitation/store', [RegistrationInvitationController::class, 'store'])->name('registr_invitation.store');

Route::group(['middleware' => ['auth', 'verified', 'confirmEachNewRegisteredUser', 'visibleSections']], function(){

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home'); 

    Route::group(['prefix' => 'SCS'], function(){
        Route::resource('/telecom-cabinet', TelecommunicationCabinetController::class);
    });

    Route::group(['prefix' => 'common-elements'], function(){
        Route::resource('/building', BuildingController::class);
        Route::resource('/floor', FloorController::class, ['except' => ['index']]);
        Route::get('/floor/{building}/index', [FloorController::class, 'index'])->name('floor.index');
        Route::resource('/room', RoomController::class);
    });

    Route::get('/user/mass-create', [UserController::class, 'massCreate'])->name('user.mass_create');
    Route::post('/user/mass-store', [UserController::class, 'massStore'])->name('user.mass-store');
    Route::resource('/user', UserController::class);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    
});