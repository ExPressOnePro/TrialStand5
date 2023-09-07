<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Congregation\CongregationRequestsController;
use App\Http\Controllers\Congregation\CongregationsController;
use App\Http\Controllers\Contacts\ContactsController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeetingSchedulesController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\Stand\StandController;
use App\Http\Controllers\Stand\StandPublishersController;
use App\Http\Controllers\Stand\StandTemplateController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Auth::routes();


// CRON
Route::get('/run-cron-task/{token}', [CronController::class, 'publishersUpdateThisWeekFromNextWeekVersion1']);
// CRON

Route::get('/', [LoginController::class, 'view'])->name('auth.login');
Route::get('/login', [LoginController::class, 'view'])->name('login');

Route::get('/registration', [RegisterController::class, 'pageRegistration'])->name('auth.registration');
Route::get('/registrationCongregation', [RegisterController::class, 'pageRegistrationCongregation'])->name('auth.registrationCongregation');
Route::post('/registrationCongregation', [RegisterController::class, 'registerCongregation'])->name('registerCongregation');

//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::get('/password/select', [ForgotPasswordController::class, 'showSelectLogin'])->name('password.selectLogin');
Route::post('/password/select', [ForgotPasswordController::class, 'SelectLogin'])->name('password.selectLoginPass');
Route::get('/password/update/{login}', [ForgotPasswordController::class, 'showReset'])->name('password.forgot');
Route::post('/password/update/{login}', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');
Route::get('/password/reset/{login}/{token}', [ForgotPasswordController::class, 'showReset'])->name('password.reset');



Route::group(['middleware' => 'auth'], function() {

    Route::get('/guest', [HomeController::class, 'guest'])->name('guest');
    Route::get('/changeLog', [HomeController::class, 'changeLog'])->name('changeLog');


    Route::get('/welcome', [HomeController::class, 'welcome'])->name('welcome');
    Route::post('/guest/{id}', [CongregationRequestsController::class, 'joinCongregation'])->name('joinCongregation');
    Route::get('/meetingSchedules', [MeetingSchedulesController::class, 'overview'])->name('meetingSchedules.overview');

    Route::get('/menu', [HomeController::class, 'menu'])->name('menu.overview');



    Route::group([
        'middleware' => 'can:module.stand',
        'prefix' => 'menu/stand',
    ], function () {
        // Stand Controller
        Route::get('/', [StandController::class, 'hub'])->name('stand.hub');
        Route::get('/currentWeekFront/{id}', [StandController::class, 'currentWeekTableFront'])->name('currentWeekTableFront');
        Route::get('/nextWeekFront/{id}', [StandController::class, 'nextWeekTableFront'])->name('nextWeekTableFront');

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


        //создать новый стенд (для управляющего)
        Route::group([
            'middleware' => 'can:stand.create',
        ], function () {
            Route::get('/create', [StandController::class, 'createNewStandPage'])->name('createNewStandPage');
            Route::post('/create', [StandController::class, 'createNewStand'])->name('createNewStand');
        });


        //настройки стенда (для управляющего)
        Route::group([
            'middleware' => 'can:stand.settings',
            'prefix' => '/settings',
        ], function () {
            Route::get('/{id}', [StandController::class, 'settings'])->name('stand.settings');

            Route::post('/timeUpdateNext/{id}', [StandTemplateController::class, 'timeUpdateNext'])->name('StandTimeNext');
            Route::post('/{id}', [StandTemplateController::class, 'timeUpdateNext'])->name('StandTimeNext');
            Route::post('/publishersAtStand/{id}', [StandTemplateController::class, 'publishersAtStand'])->name('stand.publishersAtStand.update');
            Route::post('/timeActivation/{id}', [StandController::class, 'timeActivation'])->name('timeActivation');



            //добавить изменеия прав для пользователей стенда
            //'stand.make_entry',
            //'stand.delete_entry',
            //'stand.change_entry',

            Route::get('/NTC/{id}', [StandTemplateController::class, 'StandTimeNextToCurrent'])->name('StandTimeNextToCurrent');
        });

        //история стенда (для управляющего)
        Route::group([
            'middleware' => 'can:stand.history',
            'prefix' => '/history',
        ], function () {
            Route::get('/{id}', [StandController::class, 'history'])->name('stand.history');
        });

        // создавать запись в стенде (для пользователя)
        Route::group([
            'middleware' => 'can:stand.make_entry',
        ], function () {
            Route::post('/NewRecordStand1', [StandPublishersController::class, 'NewRecordStand1'])->name('NewRecordStand1');
        });

    });

    Route::get('/permUser323', [StandController::class, 'permUserStand'])->name('permUserStand');
    Route::post('/updatePerm', [StandController::class, 'updatePerm'])->name('updatePerm');

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
        Route::get('/appointed/{congregation_id}/', [CongregationsController::class, 'displayAppointed'])->name('congregation.appointed');
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




        Route::get('/currentWeek/{id}', [StandController::class, 'currentWeekTable'])->name('currentWeekTable');
        Route::get('/nextWeek/{id}', [StandController::class, 'nextWeekTable'])->name('nextWeekTable');
        Route::post('/report/{id}', [StandController::class, 'standReportSend'])->name('standReportSend');


//        Route::get('/currentWeekFront/{id}', [StandController::class, 'currentWeekTableFront'])->name('currentWeekTableFront');
//        Route::get('/nextWeekFront/{id}', [StandController::class, 'nextWeekTableFront'])->name('nextWeekTableFront');
        Route::get('/test/{id}', [StandController::class, 'test'])->name('test');



        Route::get('/stand/record/{id}', [StandController::class, 'recordRedactionPage'])->name('recordRedactionPage');




    });

    Route::group([
        'prefix' => 'modules',
    ], function () {
        Route::get('examples/schedules', [CongregationsController::class, 'viewExampleSchedule'])->name('example.schedule');
    });



    Route::group([
        'middleware' => 'can:congregation.open_all_congregations',
        'prefix' => 'congregation',
    ], function () {

        Route::get('/', [CongregationsController::class, 'hub'])->name('congregation.hub');
    });

    Route::group([
        'middleware' => 'role:Developer',
        'prefix' => 'dev',
    ], function () {
        Route::get('/hub', [DeveloperController::class, 'hub'])->name('developer.hub');
        Route::get('/roles', [DeveloperController::class, 'roles'])->name('developer.roles');
        Route::post('/role/{roleId}', [DeveloperController::class, 'updatePermissionsForRole'])->name('developer.updatePermissionsForRole');

        Route::get('/test1', [DeveloperController::class, 'testViewButtons'])->name('testViewButtons');
        Route::get('/test1button', [DeveloperController::class, 'test1button'])->name('test1button');




        Route::get('/', [DeveloperController::class, 'DevTools'])->name('DevTools');
        Route::get('/devRoleUserUpdate', [DeveloperController::class, 'devRoleUserUpdate'])->name('devRoleUserUpdate');
    });



    Route::group([
            'middleware' => 'can:congregation.open_congregation',
            'prefix' => 'congregation',
        ], function () {

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
    'middleware' => 'can:Users-Open congregation users',
    'prefix' => 'users',
], function () {
    Route::get('/', [UsersController::class, 'allUsersPage'])->name('users');
    Route::get('/card/{id}', [UsersController::class, 'userCard'])->name('userCard');
    Route::post('/card/{id}', [UsersController::class, 'roleAllow'])->name('roleAllow');
    Route::post('/card/{id}/roledelete', [UsersController::class, 'roleDelete'])->name('roleDelete');
    Route::post('/card/{id}/permissionAllow', [UsersController::class, 'permissionAllow'])->name('permissionAllow');
    Route::post('/card/{id}/permissionDelete', [UsersController::class, 'permissionDelete'])->name('permissionDelete');
    Route::post('/card/{id}/changeGroup', [UsersController::class, 'changeGroup'])->name('user.changeGroup');

    Route::get('/responsible/', [UsersController::class, 'displayResponsible'])->name('users.responsible');
    Route::post('/responsible/', [UsersController::class, 'updateResponsibilities'])->name('users.updateResponsibilities');


});

Route::group([
    'middleware' => 'can:Stand-Create new stand',
    'prefix' => 'stand',
], function () {


    Route::get('/ExampleNext/{stand_id}/{congregation_id}', [StandController::class, 'ExampleTestVersionOfAddingToPublishersNextWeek'])->name('ExampleNext');
    Route::get('/ExampleCurrent/{stand_id}/{congregation_id}', [StandController::class, 'ExampleTestVersionOfAddingToPublishersCurrentWeek'])->name('ExampleCurrent');
    Route::get('/ExampleCurNext/{id}', [StandController::class, 'ExampleTestVersionOfUpdatingPublishersCurrentWeek'])->name('ExampleUpdateCurrentNext');

});


/*Route::get('/UserControl', 'App\Http\Controllers\UserControlController@pageUserControl')->name('pageUserControl');
Route::get('/UserControl/role/{id}', 'App\Http\Controllers\UserControlController@pageRole')->name('UCRole');
Route::get('/UserControl/user/{id}', 'App\Http\Controllers\UserControlController@pageUser')->name('UCRUser');
Route::post('/UserControl/user/{id}', 'App\Http\Controllers\DeveloperController@rolesPermissionsChange')->name('rolesPermissionsChange');
Route::post('/UserControl/user/{id}/delete', 'App\Http\Controllers\DeveloperController@rolesPermissionsDelete')->name('rolesPermissionsDelete');*/





