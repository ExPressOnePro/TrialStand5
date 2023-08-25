<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\UsersController;
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


Route::get('/generate-token/{id}', [UsersController::class, 'generateToken'])->name('generateToken');


Route::get('/infof', [ProfileController::class, 'info'])->name('info');

Route::middleware(['web', 'auth'])->group(function () {

    Route::group([
        'middleware' => 'can:module.stand',
        'prefix' => 'stand',
    ], function () {
        Route::get('/', [StandController::class, 'allstands'])->name('stand.hub');
        Route::get('/currentWeekFront/{id}', [StandController::class, 'currentWeekTableFront'])->name('currentWeekTableFront');
        Route::get('/nextWeekFront/{id}', [StandController::class, 'nextWeekTableFront'])->name('nextWeekTableFront');
    });
});
Route::get('/getMonths', [ProfileController::class, 'getMonths'])->name('getMonths');

