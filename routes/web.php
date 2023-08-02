<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CongregationRequestsController;
use App\Http\Controllers\CongregationsController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\UsersController;
use App\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Auth::routes();

Route::get('/', [LoginController::class, 'view'])->name('auth.login');

Route::get('/registration', function () {
    return view('auth.register');
});

Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/guest', [HomeController::class, 'guest'])->name('guest');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
    Route::post('/guest/{id}', [CongregationRequestsController::class, 'joinCongregation'])->name('joinCongregation');


    Route::group([
        'prefix' => 'stand',
    ], function () {
        Route::post('/record2/{id}', [StandController::class, 'UpdateRecordStandSecond'])->name('UpdateRecordStandSecond');
        Route::get('/redaction/delete1/{id}/{stand}', [StandController::class, 'recordRedactionDelete1'])->name('recordRedactionDelete1');
        Route::get('/redaction/delete2/{id}/{stand}', [StandController::class, 'recordRedactionDelete2'])->name('recordRedactionDelete2');
        Route::post('/redaction/change1/{id}/{stand}', [StandController::class, 'recordRedactionChange1'])->name('recordRedactionChange1');
        Route::post('/redaction/change2/{id}/{stand}', [StandController::class, 'recordRedactionChange2'])->name('recordRedactionChange2');
        Route::get('/currentWeek/{id}', [StandController::class, 'currentWeekTable'])->name('currentWeekTable');
        Route::get('/nextWeek/{id}', [StandController::class, 'nextWeekTable'])->name('nextWeekTable');
        Route::post('/report/{id}', [StandController::class, 'standReportSend'])->name('standReportSend');

        Route::get('/test/{id}', [StandController::class, 'test'])->name('test');

        Route::get('/stand/redaction/{id}', 'App\Http\Controllers\StandController@recordRedactionPage')->name('recordRedactionPage');

        Route::get('/redaction/{id}/{stand}', [StandController::class, 'recordRedactionDelete2'])->name('recordRedactionDelete2');
        Route::get('/', [StandController::class, 'allstands'])->name('stand');
        Route::get('/history/{id}', [StandController::class, 'history'])->name('history');
        Route::post('/NewRecordStand1', [StandController::class, 'NewRecordStand1'])->name('NewRecordStand1');
        Route::post('/NewRecordStand2', [StandController::class, 'NewRecordStand2'])->name('NewRecordStand2');
        Route::post('/record1', [StandController::class, 'AddPublisherToStand1'])->name('AddPublisherToStand1');
        Route::post('/record2', [StandController::class, 'AddPublisherToStand2'])->name('AddPublisherToStand2');
        Route::get('/settings/{id}', [StandController::class, 'settings'])->name('StandSettings');
        Route::post('/settings/{id}', [StandController::class, 'timeUpdateNext'])->name('StandTimeNext');
        Route::get('/settingsNTC/{id}', [StandController::class, 'StandTimeNextToCurrent'])->name('StandTimeNextToCurrent');
    });


    Route::group([
        /*'middleware' => 'role:User',*/
    ], function () {
        Route::get('/ads', 'App\Http\Controllers\GeneralController@ads')->name('ads');
        Route::get('/user/card/{id}', 'App\Http\Controllers\AccountController@account')->name('account');
        Route::get('/notifications', 'App\Http\Controllers\AccountController@notifications')->name('notifications');
        Route::get('/profile/my', 'App\Http\Controllers\GeneralController@profile')->name('profile');
        Route::get('/profile/edit{id}', [GeneralController::class, 'profileEdit'])->name('profileEdit');
        Route::post('/profile/edit{id}', [GeneralController::class, 'profileEditSave'])->name('profileEditSave');
        Route::get('/profile/security{id}', [GeneralController::class, 'profileSecurity'])->name('profileSecurity');
        Route::post('/profile/security{id}', [GeneralController::class, 'profileSecuritySave'])->name('profileSecuritySave');
        Route::post('/profile/brief{id}', [GeneralController::class, 'profileBriefSave'])->name('profileBriefSave');
        Route::get('/profile/contacts{id}', [GeneralController::class, 'profileContacts'])->name('profileContacts');
        Route::post('/profile/contacts{id}', [GeneralController::class, 'profileContactsSave'])->name('profileContactsSave');
        Route::post('/personalReport', [GeneralController::class, 'personalReport'])->name('personalReport');
    });


    Route::group([
        'middleware' => 'can:Congregations-Open all congregations',
        'prefix' => 'congregation',
    ], function () {
        Route::get('/', [CongregationsController::class, 'select'])->name('congregationSelect');
    });

    Route::group([
        'middleware' => 'role:Developer',
        'prefix' => 'DevTools',
    ], function () {
        Route::get('/', [DeveloperController::class, 'DevTools'])->name('DevTools');
        Route::get('/devRoleUserUpdate', [DeveloperController::class, 'devRoleUserUpdate'])->name('devRoleUserUpdate');
    });



    Route::group([
            'middleware' => 'can:Congregations-Open congregation',
            'prefix' => 'congregation',
        ], function () {
        Route::get('/{id}', [CongregationsController::class, 'view'])->name('congregationView');
        Route::get('/congregation{id}/User{user_id}', [CongregationsController::class, 'allow'])->name('congregationAllow');
        Route::get('/congregation{id}/congregationRequest{conReq}', [CongregationsController::class, 'reject'])->name('congregationReject');
        Route::get('/{congregation_id}/group{group_id}', [CongregationsController::class, 'groupView'])->name('groupView');
    });


    Route::group([
        'prefix' => 'RolesPermissions',
    ], function () {
        Route::get('/', [RolesAndPermissionsController::class, 'rolesPermissionsPage'])->name('rolesPermissionsPage');
        Route::post('/delete', [RolesAndPermissionsController::class, 'rolePermissionDelete'])->name('rolePermissionDelete');


        Route::get('/createRole', [DeveloperController::class, 'createNewRolePage'])->name('createNewRolePage');
        Route::post('/createRole', [DeveloperController::class, 'createNewRole'])->name('createNewRole');
        Route::get('/createPermission', [DeveloperController::class, 'createNewPermissionPage'])->name('createNewPermissionPage');
        Route::post('/createPermission', [DeveloperController::class, 'createNewPermission'])->name('createNewPermission');
        Route::get('/{id}', [DeveloperController::class, 'rolesPermissionsChoiceRole'])->name('rolesPermissionsChoiceRole');
        Route::post('/{id}', [DeveloperController::class, 'rolePermissionAllow'])->name('rolePermissionAllow');
        Route::post('/{id}/delete', [RolesAndPermissionsController::class, 'rolePermissionDelete'])->name('rolePermissionDelete');

        Route::get('/sort-table', [RolesAndPermissionsController::class, 'sortTable'])->name('sort.table');
    });
});

Route::get('/ref', [DeveloperController::class, 'ref'])->name('ref');
Route::group([
    'middleware' => 'role:Developer',
    'prefix' => 'users',
], function () {
    Route::get('/', [UsersController::class, 'allUsersPage'])->name('users');
    Route::get('/card/{id}', [UsersController::class, 'userCard'])->name('userCard');
    Route::post('/card/{id}', [UsersController::class, 'roleAllow'])->name('roleAllow');
    Route::post('/card/{id}/roledelete', [UsersController::class, 'roleDelete'])->name('roleDelete');
    Route::post('/card/{id}/permissionAllow', [UsersController::class, 'permissionAllow'])->name('permissionAllow');
    Route::post('/card/{id}/permissionDelete', [UsersController::class, 'permissionDelete'])->name('permissionDelete');
});

Route::group([
    'middleware' => 'can:Stand-Create new stand',
    'prefix' => 'stand',
], function () {
    Route::post('/timeActivation/{id}', [StandController::class, 'timeActivation'])->name('timeActivation');
    Route::get('/create', [StandController::class, 'createNewStandPage'])->name('createNewStandPage');
    Route::post('/create', [StandController::class, 'createNewStand'])->name('createNewStand');


    Route::get('/ExampleNext/{stand_id}/{congregation_id}', [StandController::class, 'ExampleTestVersionOfAddingToPublishersNextWeek'])->name('ExampleNext');
    Route::get('/ExampleCurrent/{stand_id}/{congregation_id}', [StandController::class, 'ExampleTestVersionOfAddingToPublishersCurrentWeek'])->name('ExampleCurrent');
    Route::get('/ExampleCurNext/{id}', [StandController::class, 'ExampleTestVersionOfUpdatingPublishersCurrentWeek'])->name('ExampleUpdateCurrentNext');

});


/*Route::get('/UserControl', 'App\Http\Controllers\UserControlController@pageUserControl')->name('pageUserControl');
Route::get('/UserControl/role/{id}', 'App\Http\Controllers\UserControlController@pageRole')->name('UCRole');
Route::get('/UserControl/user/{id}', 'App\Http\Controllers\UserControlController@pageUser')->name('UCRUser');
Route::post('/UserControl/user/{id}', 'App\Http\Controllers\DeveloperController@rolesPermissionsChange')->name('rolesPermissionsChange');
Route::post('/UserControl/user/{id}/delete', 'App\Http\Controllers\DeveloperController@rolesPermissionsDelete')->name('rolesPermissionsDelete');*/




