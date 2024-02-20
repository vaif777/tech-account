<?php

use App\Http\Controllers\Auth\ActivatedController;
use App\Http\Controllers\Auth\RegistrationInvitationController;
use App\Http\Controllers\device_and_material\MaterialController;
use App\Http\Controllers\device_and_material\NetworkEquipmentController;
use App\Http\Controllers\device_and_material\PatchPanelController;
use App\Http\Controllers\facilities\FloorController;
use App\Http\Controllers\facilities\RoomController;
use App\Http\Controllers\facilities\BuildingController;
use App\Http\Controllers\network_infrastructure\DistributionController;
use App\Http\Controllers\reference\MaterialsReferenceController;
use App\Http\Controllers\settings\SettingController;
use App\Http\Controllers\device_and_material\TelecommunicationCabinetController;
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

Route::group(['middleware' => 'registrInvitation'], function(){

    Route::get('/registr-invitation/{id}/{mail}', [RegistrationInvitationController::class, 'formRegistr'])->name('registr_invitation');
    Route::post('/registr-invitation/store', [RegistrationInvitationController::class, 'store'])->name('registr_invitation.store');
});

Route::group(['middleware' => ['auth', 'verified', 'confirmEachNewRegisteredUser', 'visibleSections']], function(){

    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/home', [HomeController::class, 'index'])->name('home'); 

    Route::group(['prefix' => 'device-and-material'], function(){
        
        Route::resource('/material', MaterialController::class);
        Route::resource('/telecom-cabinet', TelecommunicationCabinetController::class);
        Route::resource('/patch-panel', PatchPanelController::class);
        Route::resource('/network-equipment', NetworkEquipmentController::class);
    });
    
    Route::group(['prefix' => 'reference'], function(){
        
        Route::resource('/material-reference', MaterialsReferenceController::class);
    });

    Route::group(['prefix' => 'network-infrastructure'], function(){
        
        Route::resource('/distribution', DistributionController::class);
    });

    Route::group(['prefix' => 'facilities'], function(){
        
        Route::resource('/building', BuildingController::class);
        Route::resource('/floor', FloorController::class, ['except' => ['index']]);
        Route::get('/floor/{building}/index', [FloorController::class, 'index'])->name('floor.index');
        Route::resource('/room', RoomController::class);
    });

    Route::group(['middleware' => 'registrInvitation'], function(){
        
        Route::get('/user/mass-create', [UserController::class, 'massCreate'])->name('user.mass_create');
        Route::post('/user/mass-store', [UserController::class, 'massStore'])->name('user.mass-store'); 
    });
    Route::resource('/user', UserController::class);

    Route::get('/setting', [SettingController::class, 'index'])->name('setting');  
});