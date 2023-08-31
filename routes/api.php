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


Route::middleware(['web', 'auth'])->group(function () {

    Route::group([
        'middleware' => 'can:module.stand',
        'prefix' => 'menu/stand',
    ], function () {
        // Stand Controller
        Route::get('/', [StandController::class, 'hub'])->name('stand.hub');
        Route::get('/currentWeekFront/{id}', [StandController::class, 'currentWeekTableFront'])->name('currentWeekTableFront');
        Route::get('/nextWeekFront/{id}', [StandController::class, 'nextWeekTableFront'])->name('nextWeekTableFront');
        Route::get('/settings/{id}', [StandController::class, 'settings'])->name('stand.settings');
        Route::get('/history/{id}', [StandController::class, 'history'])->name('stand.history');

        Route::post('/publishersAtStand/{id}', [StandTemplateController::class, 'publishersAtStand'])->name('stand.publishersAtStand.update');
        Route::post('/settings/{id}', [StandTemplateController::class, 'timeUpdateNext'])->name('StandTimeNext');
        Route::get('/settingsNTC/{id}', [StandTemplateController::class, 'StandTimeNextToCurrent'])->name('StandTimeNextToCurrent');
        Route::post('/timeActivation/{id}', [StandController::class, 'timeActivation'])->name('timeActivation');

        Route::post('/NewRecordStand1', [StandPublishersController::class, 'NewRecordStand1'])->name('NewRecordStand1');

        Route::post('/record1/{id}', [StandPublishersController::class, 'AddPublisherToStand1'])->name('AddPublisherToStand1');
        Route::post('/record2/{id}', [StandPublishersController::class, 'AddPublisherToStand2'])->name('AddPublisherToStand2');
        Route::post('/record3/{id}', [StandPublishersController::class, 'AddPublisherToStand3'])->name('AddPublisherToStand3');
        Route::post('/record4/{id}', [StandPublishersController::class, 'AddPublisherToStand4'])->name('AddPublisherToStand4');

        Route::post('/record/change1/{id}/{stand}', [StandPublishersController::class, 'recordRedactionChange1'])->name('recordRedactionChange1');
        Route::post('/record/change2/{id}/{stand}', [StandPublishersController::class, 'recordRedactionChange2'])->name('recordRedactionChange2');
        Route::post('/record/change3/{id}/{stand}', [StandPublishersController::class, 'recordRedactionChange3'])->name('recordRedactionChange3');
        Route::post('/record/change4/{id}/{stand}', [StandPublishersController::class, 'recordRedactionChange4'])->name('recordRedactionChange4');

        Route::get('/record/delete/{id}/{stand}', [StandPublishersController::class, 'recordRedactionDelete1'])->name('recordRedactionDelete1');
        Route::get('/record/delete2/{id}/{stand}', [StandPublishersController::class, 'recordRedactionDelete2'])->name('recordRedactionDelete2');
        Route::get('/record/delete3/{id}/{stand}', [StandPublishersController::class, 'recordRedactionDelete3'])->name('recordRedactionDelete3');
        Route::get('/record/delete4/{id}/{stand}', [StandPublishersController::class, 'recordRedactionDelete4'])->name('recordRedactionDelete4');

        Route::get('/record/{day}/{time}/{date}/{stand_template_id}', [StandController::class, 'recordRecordPage'])->name('recordRecordPage');
        Route::get('/recordRedaction/{stand_publishers_id}', [StandController::class, 'recordRedactionPageMobile'])->name('recordRedactionPageMobile');
        Route::get('/report/{stand_publishers_id}', [StandController::class, 'reportPage'])->name('stand.reportPage');

    });

    Route::group([
//        'middleware' => 'can:module.add',
        'prefix' => 'module',
    ], function () {
        // Stand Controller
        Route::post('/connect/{congregation}/{permission}', [CongregationsController::class, 'connectModuleToCongregation'])->name('module.connect');
        Route::post('/delete/{congregation}/{permission}', [CongregationsController::class, 'disconnectModuleToCongregation'])->name('module.disconnect');
    });

    Route::group([
        'middleware' => 'can:congregation.open_congregation',
        'prefix' => 'congregation',
    ], function () {
        // Stand Controller
        Route::get('/overview/{id}', [CongregationsController::class, 'view'])->name('congregationView');
        Route::get('/modules/{congregation_id}/', [CongregationsController::class, 'displayModules'])->name('congregation.modules');
        Route::get('/requests/{congregation_id}/', [CongregationsController::class, 'displayRequests'])->name('congregation.requests');
        Route::get('/publishers/{congregation_id}/', [CongregationsController::class, 'displayPublishers'])->name('congregation.publishers');
        Route::get('/settings/{congregation_id}/', [CongregationsController::class, 'displaySettings'])->name('congregation.settings');
        Route::get('/stands/{congregation_id}/', [CongregationsController::class, 'displayStands'])->name('congregation.stands');
    });



    Route::get('/contacts/{congregation_id}/', [ContactsController::class, 'index'])->name('contacts.hub');

    Route::post('/profile/basicInfo', [ProfileController::class, 'basicInfoSave'])->name('profile.basicInfoSave');
    Route::post('/profile/contactInfo', [ProfileController::class, 'contactsInfoSave'])->name('profile.contactsInfoSave');
//    Route::post('/DataHack', [StandController::class, 'ExampleTestVersionOfUpdatingPublishersCurrentWeek'])->name('DataHack');

    Route::group([
        'prefix' => 'profile',
        /*'middleware' => 'role:User',*/
    ], function () {

        Route::get('/overview', [ProfileController::class, 'overview'])->name('profile.overview');
        Route::get('/my',  [ProfileController::class, 'profile'])->name('profile');
        Route::get('/reports',  [ProfileController::class, 'reports'])->name('profile.reports');
        Route::get('/settings',  [ProfileController::class, 'settings'])->name('profile.settings');
        Route::post('/changePassword',  [ProfileController::class, 'changePassword'])->name('profile.settings.changePassword');

    });

});
Route::get('/getMonths', [ProfileController::class, 'getMonths'])->name('getMonths');

