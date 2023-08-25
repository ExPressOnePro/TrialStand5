<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CongregationRequestsController;
use App\Http\Controllers\CongregationsController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeetingSchedulesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\SettingsController;
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
Route::get('/login', [LoginController::class, 'view'])->name('login');

Route::get('/registration', [RegisterController::class, 'pageRegistration'])->name('auth.registration');

//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::get('/password/select', [ForgotPasswordController::class, 'showSelectLogin'])->name('password.selectLogin');
Route::post('/password/select', [ForgotPasswordController::class, 'SelectLogin'])->name('password.selectLoginPass');
Route::get('/password/update/{login}', [ForgotPasswordController::class, 'showReset'])->name('password.forgot');
Route::post('/password/update/{login}', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');



//Route::post('/password/reset', [ForgotPasswordController::class, 'showReset'])->name('password.reset');



Route::group(['middleware' => 'auth'], function() {

    Route::get('/guest', [HomeController::class, 'guest'])->name('guest');

    Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
    Route::post('/guest/{id}', [CongregationRequestsController::class, 'joinCongregation'])->name('joinCongregation');
    Route::get('/settings', [SettingsController::class, 'settings'])->name('settings.view');
    Route::get('/meetingSchedules', [MeetingSchedulesController::class, 'overview'])->name('meetingSchedules.overview');

    Route::get('/menu', [HomeController::class, 'menu'])->name('menu.overview');






    Route::group([
        'prefix' => 'home',
    ], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/records-with-stand', [HomeController::class, 'recordsWithStandPage'])->name('home.recordsWithStandPage');
    });


    Route::group([
        'prefix' => 'stand',
    ], function () {
        Route::post('/record2/{id}', [StandController::class, 'UpdateRecordStandSecond'])->name('UpdateRecordStandSecond');
        Route::get('/record/delete/{id}/{stand}', [StandController::class, 'recordRedactionDelete1'])->name('recordRedactionDelete1');
        Route::get('/record/delete2/{id}/{stand}', [StandController::class, 'recordRedactionDelete2'])->name('recordRedactionDelete2');
        Route::post('/record/change1/{id}/{stand}', [StandController::class, 'recordRedactionChange1'])->name('recordRedactionChange1');
        Route::post('/record/change2/{id}/{stand}', [StandController::class, 'recordRedactionChange2'])->name('recordRedactionChange2');
        Route::get('/currentWeek/{id}', [StandController::class, 'currentWeekTable'])->name('currentWeekTable');
        Route::get('/nextWeek/{id}', [StandController::class, 'nextWeekTable'])->name('nextWeekTable');
        Route::post('/report/{id}', [StandController::class, 'standReportSend'])->name('standReportSend');


//        Route::get('/currentWeekFront/{id}', [StandController::class, 'currentWeekTableFront'])->name('currentWeekTableFront');
//        Route::get('/nextWeekFront/{id}', [StandController::class, 'nextWeekTableFront'])->name('nextWeekTableFront');
        Route::get('/test/{id}', [StandController::class, 'test'])->name('test');



        Route::get('/stand/record/{id}', [StandController::class, 'recordRedactionPage'])->name('recordRedactionPage');
        Route::get('/record/{id}/{stand}', [StandController::class, 'recordRedactionDelete2'])->name('recordRedactionDelete2');
//        Route::get('/', [StandController::class, 'allstands'])->name('stand');
        Route::get('/history/{id}', [StandController::class, 'history'])->name('history');
        Route::post('/NewRecordStand1', [StandController::class, 'NewRecordStand1'])->name('NewRecordStand1');
        Route::post('/NewRecordStand2', [StandController::class, 'NewRecordStand2'])->name('NewRecordStand2');

        Route::post('/record1/{id}', [StandController::class, 'AddPublisherToStand1'])->name('AddPublisherToStand1');
        Route::post('/record2/{id}', [StandController::class, 'AddPublisherToStand2'])->name('AddPublisherToStand2');

        Route::get('/settings/{id}', [StandController::class, 'settings'])->name('StandSettings');
        Route::post('/settings/{id}', [StandController::class, 'timeUpdateNext'])->name('StandTimeNext');
        Route::get('/settingsNTC/{id}', [StandController::class, 'StandTimeNextToCurrent'])->name('StandTimeNextToCurrent');
        Route::get('/record/{day}/{time}/{date}/{stand_template_id}', [StandController::class, 'recordRecordPage'])->name('recordRecordPage');
        Route::get('/recordRedaction/{stand_publishers_id}', [StandController::class, 'recordRedactionPageMobile'])->name('recordRedactionPageMobile');

    });

    Route::group([
        'prefix' => 'modules',
    ], function () {
        Route::get('examples/schedules', [CongregationsController::class, 'viewExampleSchedule'])->name('example.schedule');
    });

    Route::group([
        'prefix' => 'profile',
        /*'middleware' => 'role:User',*/
    ], function () {

        Route::get('/overview', [ProfileController::class, 'overview'])->name('profile.overview');
        Route::get('/my',  [ProfileController::class, 'profile'])->name('profile');
        Route::get('/reports',  [ProfileController::class, 'reports'])->name('profile.reports');
        Route::get('/settings',  [ProfileController::class, 'settings'])->name('profile.settings');



        Route::get('/ads', 'App\Http\Controllers\GeneralController@ads')->name('ads');
        Route::get('/user/card/{id}', 'App\Http\Controllers\AccountController@account')->name('account');
        Route::get('/notifications', 'App\Http\Controllers\AccountController@notifications')->name('notifications');

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
        'middleware' => 'can:congregation.open_all_congregations',
        'prefix' => 'congregation',
    ], function () {

        Route::get('/', [CongregationsController::class, 'select'])->name('congregationSelect');
    });

    Route::group([
        'middleware' => 'role:Developer',
        'prefix' => 'Dev',
    ], function () {

        Route::get('/test1', [DeveloperController::class, 'testViewButtons'])->name('testViewButtons');
        Route::get('/test1button', [DeveloperController::class, 'test1button'])->name('test1button');



        Route::get('/', [DeveloperController::class, 'DevTools'])->name('DevTools');
        Route::get('/devRoleUserUpdate', [DeveloperController::class, 'devRoleUserUpdate'])->name('devRoleUserUpdate');
    });



    Route::group([
            'middleware' => 'can:congregation.open_congregation',
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
    Route::post('/card/{id}/changeGroup', [UsersController::class, 'changeGroup'])->name('user.changeGroup');
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




