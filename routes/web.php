<?php

use App\Http\Controllers\CongregationRequestsController;
use App\Http\Controllers\CongregationsController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\UsersController;
use App\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Auth::routes();

Route::get('/', function() {
    return view('auth.login');
});

Route::get('/registration', function () {

    return view('auth.register');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/guest', [HomeController::class, 'guest'])->name('guest');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/guest/{id}', [CongregationRequestsController::class, 'joinCongregation'])->name('joinCongregation');
});

Route::group([
    'middleware' => 'role:User',
    'prefix' => 'stand',
], function () {
    Route::get('/record1/{id}', [StandController::class, 'PageUpdateRecordStandFirst'])->name('PageUpdateRecordStandFirst');
    Route::post('/record1/{id}', [StandController::class, 'UpdateRecordStandFirst'])->name('UpdateRecordStandFirst');
    Route::get('/record2/{id}', [StandController::class, 'PageUpdateRecordStandSecond'])->name('PageUpdateRecordStandSecond');
    Route::post('/record2/{id}', [StandController::class, 'UpdateRecordStandSecond'])->name('UpdateRecordStandSecond');
    Route::get('/redaction/{id}', [StandController::class, 'recordRedactionPage'])->name('recordRedactionPage');
    Route::get('/redaction/delete1/{id}/{stand}', [StandController::class, 'recordRedactionDelete1'])->name('recordRedactionDelete1');
    Route::get('/redaction/delete2/{id}/{stand}', [StandController::class, 'recordRedactionDelete2'])->name('recordRedactionDelete2');
    Route::post('/redaction/change1/{id}/{stand}', [StandController::class, 'recordRedactionChange1'])->name('recordRedactionChange1');
    Route::post('/redaction/change2/{id}/{stand}', [StandController::class, 'recordRedactionChange2'])->name('recordRedactionChange2');
    Route::get('/table/{id}', [StandController::class, 'tables'])->name('StandTable');
    Route::get('/currentWeek/{id}', [StandController::class, 'currentWeekTable'])->name('currentWeekTable');
    Route::get('/nextWeek/{id}', [StandController::class, 'nextWeekTable'])->name('nextWeekTable');
    Route::get('/report/{id}', [StandController::class, 'standReportPage'])->name('standReportPage');
    Route::post('/report/{id}', [StandController::class, 'standReportSend'])->name('standReportSend');
});

Route::group([
    'middleware' => 'role:User',
], function () {
    Route::get('/ads', 'App\Http\Controllers\GeneralController@ads')->name('ads');
    Route::get('/stand', 'App\Http\Controllers\StandController@allstands')->name('stand');
    Route::get('/user/card/{id}', 'App\Http\Controllers\AccountController@account')->name('account');
    Route::get('/notifications', 'App\Http\Controllers\AccountController@notifications')->name('notifications');
    Route::get('/profile/my', 'App\Http\Controllers\GeneralController@profile')->name('profile');
    Route::post('/personalReport', [GeneralController::class, 'personalReport'])->name('personalReport');
});

Route::group([
    'middleware' => 'role:Manager',
    'prefix' => 'congregation',
], function () {
    Route::get('/', [CongregationsController::class, 'select'])->name('congregationSelect');
    Route::get('//{id}', [CongregationsController::class, 'view'])->name('congregationView');
    Route::get('//{id}/{user_id}', [CongregationsController::class, 'allow'])->name('congregationAllow');
    Route::get('//{id}/{conReq}', [CongregationsController::class, 'reject'])->name('congregationReject');
});


Route::group([
    'middleware' => 'role:Developer',
    'prefix' => 'RolesPermissions',
], function () {
    Route::get('/createRole', [DeveloperController::class, 'createNewRolePage'])->name('createNewRolePage');
    Route::post('/createRole', [DeveloperController::class, 'createNewRole'])->name('createNewRole');
    Route::get('/createPermission', [DeveloperController::class, 'createNewPermissionPage'])->name('createNewPermissionPage');
    Route::post('/createPermission', [DeveloperController::class, 'createNewPermission'])->name('createNewPermission');
    Route::get('/', [DeveloperController::class, 'rolesPermissionsPage'])->name('rolesPermissionsPage');
    Route::get('/{id}', [DeveloperController::class, 'rolesPermissionsChoiceRole'])->name('rolesPermissionsChoiceRole');
    Route::post('/{id}', [DeveloperController::class, 'rolePermissionAllow'])->name('rolePermissionAllow');
    Route::post('/{id}/delete', [DeveloperController::class, 'rolePermissionDelete'])->name('rolePermissionDelete');
    Route::get('/migration', [DeveloperController::class, 'migrations'])->name('migrations');
});

Route::group([
    'middleware' => 'role:Developer',
    'prefix' => 'users',
], function () {
    Route::get('/', [UsersController::class, 'allUsersPage'])->name('users');
    Route::get('/card/{id}', [UsersController::class, 'userCard'])->name('userCard');
    Route::post('/card/{id}', [UsersController::class, 'roleAllow'])->name('roleAllow');
    Route::post('/card/{id}/delete', [UsersController::class, 'roleDelete'])->name('roleDelete');
});

Route::group([
    'middleware' => 'role:Manager',
    'prefix' => 'stand',
], function () {
    Route::get('/create', [StandController::class, 'createNewStandPage'])->name('createNewStandPage');
    Route::post('/create', [StandController::class, 'createNewStand'])->name('createNewStand');
    Route::get('/settings/{id}', [StandController::class, 'settings'])->name('StandSettings');
    Route::post('/settings/{id}', [StandController::class, 'timeUpdateNext'])->name('StandTimeNext');
    Route::get('/settingsNTC/{id}', [StandController::class, 'timeUpdateNextToCurrent'])->name('StandTimeNextToCurrent');
    Route::get('/test', [StandController::class, 'test'])->name('test');
    Route::get('/ExampleNext', [StandController::class, 'ExampleTestVersionOfAddingToPublishersNextWeek'])->name('ExampleNext');
    Route::get('/ExampleCurrent', [StandController::class, 'ExampleTestVersionOfAddingToPublishersCurrentWeek'])->name('ExampleCurrent');
    Route::get('/ExampleCurNext/{id}', [StandController::class, 'ExampleTestVersionOfUpdatingPublishersCurrentWeek'])->name('ExampleUpdateCurrentNext');

});


/*Route::get('/UserControl', 'App\Http\Controllers\UserControlController@pageUserControl')->name('pageUserControl');
Route::get('/UserControl/role/{id}', 'App\Http\Controllers\UserControlController@pageRole')->name('UCRole');
Route::get('/UserControl/user/{id}', 'App\Http\Controllers\UserControlController@pageUser')->name('UCRUser');
Route::post('/UserControl/user/{id}', 'App\Http\Controllers\DeveloperController@rolesPermissionsChange')->name('rolesPermissionsChange');
Route::post('/UserControl/user/{id}/delete', 'App\Http\Controllers\DeveloperController@rolesPermissionsDelete')->name('rolesPermissionsDelete');*/




