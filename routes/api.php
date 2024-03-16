<?php

use App\Http\Controllers\filter\FilterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['auth', 'verified']], function(){

//     Route::get('/filter-building', [FilterController::class, 'building'])->name('filter.building');
// });

Route::get('/filter-building', [FilterController::class, 'building'])->name('filter.building');
Route::get('/filter-floor', [FilterController::class, 'floor'])->name('filter.floor');
Route::get('/filter-room', [FilterController::class, 'room'])->name('filter.room');
Route::get('/filter-telecom-cabinets', [FilterController::class, 'telecomCabinet'])->name('filter.telecom.cabinet');
Route::get('/filter-patch-panel', [FilterController::class, 'patchPanel'])->name('filter.patch.panel');
Route::get('/filter-location', [FilterController::class, 'location'])->name('filter.location');
Route::get('/filter-connection', [FilterController::class, 'connection'])->name('filter.connection');