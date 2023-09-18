<?php

use App\Http\Controllers\Congregation\CongregationsController;
use App\Http\Controllers\Contacts\ContactsController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Stand\StandController;
use App\Http\Controllers\Stand\StandPublishersController;
use App\Http\Controllers\Stand\StandTemplateController;
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

//
//Route::middleware(['web', 'auth'])->group(function () {
//
//
//
//    Route::group([
////        'middleware' => 'can:module.add',
//        'prefix' => 'module',
//    ], function () {
//        // Stand Controller
//        Route::post('/connect/{congregation}/{permission}', [CongregationsController::class, 'connectModuleToCongregation'])->name('module.connect');
//        Route::post('/delete/{congregation}/{permission}', [CongregationsController::class, 'disconnectModuleToCongregation'])->name('module.disconnect');
//    });
//
//    Route::group([
//        'middleware' => 'can:congregation.open_congregation',
//        'prefix' => 'congregation',
//    ], function () {
//        // Stand Controller
//        Route::get('/overview/{id}', [CongregationsController::class, 'view'])->name('congregationView');
//        Route::get('/modules/{congregation_id}/', [CongregationsController::class, 'displayModules'])->name('congregation.modules');
//        Route::get('/requests/{congregation_id}/', [CongregationsController::class, 'displayRequests'])->name('congregation.requests');
//        Route::get('/publishers/{congregation_id}/', [CongregationsController::class, 'displayPublishers'])->name('congregation.publishers');
//        Route::get('/settings/{congregation_id}/', [CongregationsController::class, 'displaySettings'])->name('congregation.settings');
//        Route::get('/stands/{congregation_id}/', [CongregationsController::class, 'displayStands'])->name('congregation.stands');
//    });
//
//
//
//    Route::get('/contacts/{congregation_id}/', [ContactsController::class, 'index'])->name('contacts.hub');
//
//    Route::post('/profile/basicInfo', [ProfileController::class, 'basicInfoSave'])->name('profile.basicInfoSave');
//    Route::post('/profile/contactInfo', [ProfileController::class, 'contactsInfoSave'])->name('profile.contactsInfoSave');
////    Route::post('/DataHack', [StandController::class, 'ExampleTestVersionOfUpdatingPublishersCurrentWeek'])->name('DataHack');
//
//    Route::group([
//        'prefix' => 'profile',
//        /*'middleware' => 'role:User',*/
//    ], function () {
//
//        Route::get('/overview', [ProfileController::class, 'overview'])->name('profile.overview');
//        Route::get('/my',  [ProfileController::class, 'profile'])->name('profile');
//        Route::get('/reports',  [ProfileController::class, 'reports'])->name('profile.reports');
//        Route::get('/settings',  [ProfileController::class, 'settings'])->name('profile.settings');
//        Route::post('/changePassword',  [ProfileController::class, 'changePassword'])->name('profile.settings.changePassword');
//
//    });
//
//});
//Route::get('/getMonths', [ProfileController::class, 'getMonths'])->name('getMonths');

