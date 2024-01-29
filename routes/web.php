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
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\RolesAndPermissionsController;
use App\Http\Controllers\Stand\StandController;
use App\Http\Controllers\Stand\StandPublishersController;
use App\Http\Controllers\Stand\StandTemplateController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Opcodes\LogViewer\Http\Controllers\LogsController;

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

//Auth::routes();


// CRON
Route::get('/run-cron-task/{token}', [CronController::class, 'publishersUpdateThisWeekFromNextWeekVersion1']);
// CRON
Route::get('/maintenance', [DeveloperController::class, 'maintenance'])->name('maintenance');

Route::get('/', [LoginController::class, 'view'])->name('auth.login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('showRegistrationForm');
Route::post('register', [RegisterController::class, 'create'])->name('register');



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




Route::group(['middleware' => 'auth'], function () {
        Route::get('/guest', [HomeController::class, 'guest'])->name('guest');

        Route::group([
            'prefix' => 'home',
        ], function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::get('/records-with-stand', [HomeController::class, 'recordsWithStandPage'])->name('home.recordsWithStandPage');
        });

        Route::get('/LZn1XfWhZUqi', [HomeController::class, 'home2'])->name('home2');
        Route::get('/help', [HomeController::class, 'helpfaq'])->name('helpfaq');

        Route::get('/changeLog', [HomeController::class, 'changeLog'])->name('changeLog');


        Route::post('/guest/{id}', [CongregationRequestsController::class, 'joinCongregation'])->name('joinCongregation');
        Route::get('/meetingSchedules/{id}', [MeetingSchedulesController::class, 'overview'])->name('meetingSchedules.overview');
        Route::get('/presentation/meetingSchedules', [PresentationController::class, 'presentMeetingSchedules'])->name('presentation.meetingSchedules');


    Route::group([
        'prefix' => 'meetingSchedules',
    ], function () {
        Route::get('/schedule/{weekday_id}', [MeetingSchedulesController::class, 'schedule'])->name('meetingSchedules.schedule');
        Route::post('/create/{congregation_id}', [MeetingSchedulesController::class, 'create'])->name('meetingSchedules.create');
        Route::get('/{id}/redaction', [MeetingSchedulesController::class, 'redaction'])->name('meetingSchedules.redaction');
        Route::post('/{id}/save_responsibles', [MeetingSchedulesController::class, 'save_responsibles'])->name('meetingSchedules.save_responsibles');
        Route::post('/{id}/save_responsibles_weekend', [MeetingSchedulesController::class, 'save_responsibles_weekend'])->name('meetingSchedules.save_responsibles_weekend');
        Route::post('/{id}/save_treasures', [MeetingSchedulesController::class, 'save_treasures'])->name('meetingSchedules.save_treasures');
        Route::post('/{id}/save_field_ministry', [MeetingSchedulesController::class, 'save_field_ministry'])->name('meetingSchedules.save_field_ministry');
        Route::post('/{id}/save_living', [MeetingSchedulesController::class, 'save_living'])->name('meetingSchedules.save_living');
        Route::post('/{id}/save_songs', [MeetingSchedulesController::class, 'save_songs'])->name('meetingSchedules.save_songs');
        Route::post('/{id}/save_songs_weekend', [MeetingSchedulesController::class, 'save_songs_weekend'])->name('meetingSchedules.save_songs_weekend');
        Route::post('/{id}/save_public_speech', [MeetingSchedulesController::class, 'save_public_speech'])->name('meetingSchedules.save_public_speech');
        Route::post('/{id}/save_watchtower', [MeetingSchedulesController::class, 'save_watchtower'])->name('meetingSchedules.save_watchtower');
        Route::post('/publish/{id}', [MeetingSchedulesController::class, 'publish'])->name('meetingSchedules.publish');
        Route::post('/delete/{id}', [MeetingSchedulesController::class, 'delete'])->name('meetingSchedules.delete');

    });

        Route::get('/menu', [HomeController::class, 'menu'])->name('menu.overview');
        Route::get('/menu2', [HomeController::class, 'menu2'])->name('menu.overview2');
        Route::get('/menu3', [HomeController::class, 'menu3'])->name('menu3');

        Route::get('/getStandPublishersData/{id}', [StandController::class, 'getStandPublishersDataForCurrentWeek']);

        Route::get('/stand-publishers/{id}', function () {
            return view('stand_publishers');
        });


        Route::group([
            'middleware' => 'can:module.stand',
            'prefix' => 'stand',
        ], function () {
            Route::get('/current/{id}', [StandController::class, 'table'])->name('stand.current');
            Route::get('/next/{id}', [StandController::class, 'table'])->name('stand.next');

            Route::get('table/{id}', [StandController::class, 'tableJson'])->name('stand.table_json');

            //Bootstrap

            Route::get('/current2/{id}', [StandController::class, 'table2'])->name('stand.current2');
            Route::get('/current2ex/{id}', [StandController::class, 'tableEx'])->name('stand.tableEx');
            Route::get('/next2/{id}', [StandController::class, 'table2'])->name('stand.next2');


            Route::get('/', [StandController::class, 'hub'])->name('stand.hub');
            Route::get('/Boot/', [StandController::class, 'hub2'])->name('stand.hub2');

            Route::get('/aio_current', [StandController::class, 'aioTable'])->name('stand.aio_current');
            Route::get('/aio_current2', [StandController::class, 'aioTable2'])->name('stand.aio_current2');
            Route::get('/aio_next', [StandController::class, 'aioTable'])->name('stand.aio_next');
            Route::get('/aio_next2', [StandController::class, 'aioTable2'])->name('stand.aio_next2');


            Route::get('/currentWeekFront/{id}', [StandController::class, 'currentWeekTableFront'])->name('currentWeekTableFront');
            Route::get('/nextWeekFront/{id}', [StandController::class, 'nextWeekTableFront'])->name('nextWeekTableFront');

            Route::post('/NewRecordStand', [StandPublishersController::class, 'NewRecordStand'])->name('NewRecordStand');
            Route::post('/NewRecordStand2', [StandPublishersController::class, 'NewRecordStand2'])->name('NewRecordStand2');
            Route::post('/record/add/{id}', [StandPublishersController::class, 'AddPublisherToStand'])->name('AddPublisherToStand');
            Route::post('/record2/add/{id}', [StandPublishersController::class, 'AddPublisherToStand2'])->name('AddPublisherToStand2');
            Route::get('/record/delete/{id}/{stand}/{user_id}', [StandPublishersController::class, 'recordRedactionDelete'])->name('recordRedactionDelete');
            Route::get('/record2/delete/{id}/{stand}/{user_id}', [StandPublishersController::class, 'recordRedactionDelete2'])->name('recordRedactionDelete2');
            Route::post('/record/change/{id}/{stand}/{user_id}', [StandPublishersController::class, 'recordRedactionChange'])->name('recordRedactionChange');


            Route::get('/record_create/{day}/{time}/{date}/{stand_template_id}', [StandController::class, 'recordCreate'])->name('stand.record_create');
            Route::get('/record_redaction/{stand_publishers_id}', [StandController::class, 'recordRedaction'])->name('stand.record_redaction');


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


                Route::post('/defaultUpdate/{id}', [StandController::class, 'update'])->name('stand.default_update');
                Route::post('/timeUpdateNext/{id}/{day}', [StandTemplateController::class, 'timeUpdateNext'])->name('StandTimeNext');
                Route::post('/publishersAtStand/{id}', [StandTemplateController::class, 'publishersAtStand'])->name('stand.publishersAtStand.update');
                Route::post('/timeActivation/{id}', [StandTemplateController::class, 'timeActivation'])->name('stand.timeActivation');
                Route::post('/activeTimeCustom/{id}', [StandController::class, 'timeActivation'])->name('stand.activeTimeCustom');


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
                Route::get('/data/{id}', [StandController::class, 'getHistoryData'])->name('history.data');
                Route::get('/getUserName', [UsersController::class, 'getUserName'])->name('getUserName');
            });

            // создавать запись в стенде (для пользователя)
            Route::group([
                'middleware' => 'can:stand.make_entry',
            ], function () {
                Route::post('/NewRecordStand1', [StandPublishersController::class, 'NewRecordStand1'])->name('NewRecordStand1');
            });

        });

        Route::get('/permUser323/{id}', [StandController::class, 'permUserStand'])->name('permUserStand');
        Route::post('/updatePerm', [StandController::class, 'updatePerm'])->name('updatePermission');

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
            Route::get('/overviewAj/{id}', [CongregationsController::class, 'overviewAj'])->name('overviewAj');
            Route::get('/publishers/{congregation_id}/', [CongregationsController::class, 'view'])->name('congregation.publishers');
            Route::get('/publishersAj/{id}/', [CongregationsController::class, 'publishersAj'])->name('congregation.publishersAj');
            Route::get('/createUser/{id}', [CongregationsController::class, 'view'])->name('congregation.createU');
            Route::get('/createUserAj/{id}', [CongregationsController::class, 'createUserAj'])->name('congregation.createUserAj');

            Route::get('/settings/{id}', [CongregationsController::class, 'view'])->name('congregation.settings');
            Route::get('/settingsAj/{id}', [CongregationsController::class, 'settingsAj'])->name('congregation.settingsAj');


            Route::post('/meetingTime/{id}', [CongregationsController::class, 'meetingTime'])->name('congregation.meetingTime');




            Route::post('/crus/{id}', [CongregationsController::class, 'createUserFromCongregation'])->name('createPublisher');


            Route::get('/modules/{congregation_id}/', [CongregationsController::class, 'displayModules'])->name('congregation.modules');
            Route::get('/requests/{congregation_id}/', [CongregationsController::class, 'displayRequests'])->name('congregation.requests');

            Route::get('/ActiveUsersPerWeek/{congregation_id}/', [CongregationsController::class, 'displayActiveUsersPerWeek'])->name('congregation.ActiveUsersPerWeek');
            Route::get('/appointed/{congregation_id}/', [CongregationsController::class, 'displayAppointed'])->name('congregation.appointed');
            Route::get('/settings/{congregation_id}/', [CongregationsController::class, 'displaySettings'])->name('congregation.settings');
            Route::get('/stands/{congregation_id}/', [CongregationsController::class, 'displayStands'])->name('congregation.stands');

        });


        Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.hub');
        Route::get('/contacts2', [ContactsController::class, 'index2'])->name('contacts.hub2');

        Route::post('/profile/basicInfo', [ProfileController::class, 'basicInfoSave'])->name('profile.basicInfoSave');
        Route::post('/profile/contactInfo', [ProfileController::class, 'contactsInfoSave'])->name('profile.contactsInfoSave');
        Route::post('/profile/standShow', [ProfileController::class, 'standShowSave'])->name('profile.standShowSave');
//    Route::post('/DataHack', [StandController::class, 'ExampleTestVersionOfUpdatingPublishersCurrentWeek'])->name('DataHack');

        Route::group([
            'prefix' => 'profile',
            /*'middleware' => 'role:User',*/
        ], function () {

            Route::get('/overview', [ProfileController::class, 'overview'])->name('profile.overview');
            Route::get('/my', [ProfileController::class, 'profile'])->name('profile');
            Route::get('/reports', [ProfileController::class, 'reports'])->name('profile.reports');
            Route::get('/settings', [ProfileController::class, 'settings'])->name('profile.settings');
            Route::post('/changePassword', [ProfileController::class, 'changePassword'])->name('profile.settings.changePassword');

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
            'middleware' => 'role:Developer',
            'prefix' => 'cons',
        ], function () {

            Route::get('/', [CongregationsController::class, 'hub'])->name('congregation.hub');
            Route::post('/createNewCongregation', [CongregationsController::class, 'create'])->name('congregation.create');

        });

        Route::group([
            'middleware' => ['role:Developer', 'log-viewer'],
        ], function () {
            Route::get('/log-viewer*', [LogsController::class, 'index'])->name('log');
        });


        Route::group([
            'middleware' => 'role:Developer',
            'prefix' => 'dev',
        ], function () {
            Route::get('/hub', [DeveloperController::class, 'hub'])->name('developer.hub');
            Route::get('/activeUsers', [DeveloperController::class, 'activeUsersDisplay'])->name('developer.activeUsersDisplay');
            Route::get('/registeredUsers', [DeveloperController::class, 'registeredUsersDisplay'])->name('developer.registeredUsersDisplay');
            Route::get('/uReqCon', [DeveloperController::class, 'usersRequestsCongregation'])->name('developer.usersRequestsCongregation');
            Route::get('/roles', [DeveloperController::class, 'roles'])->name('developer.roles');
            Route::get('/allUsers/', [DeveloperController::class, 'allUsers'])->name('Developer.allUsers');
            Route::post('/role/{roleId}', [DeveloperController::class, 'updatePermissionsForRole'])->name('developer.updatePermissionsForRole');

            Route::get('/test1', [DeveloperController::class, 'testViewButtons'])->name('testViewButtons');
            Route::get('/test1button', [DeveloperController::class, 'test1button'])->name('test1button');

            Route::get('/generateCodes', [DeveloperController::class, 'generateCodes']);

            Route::get('/', [DeveloperController::class, 'DevTools'])->name('DevTools');
            Route::get('/devRoleUserUpdate', [DeveloperController::class, 'devRoleUserUpdate'])->name('devRoleUserUpdate');
        });


        Route::group([
            'middleware' => 'can:congregation.open_congregation',
            'prefix' => 'congregation',
        ], function () {
            Route::post('/congregation/{id}', [CongregationsController::class, 'updateProfile'])->name('update.profile.congr');
            Route::post('/congregationdeleteuser/{id}', [CongregationsController::class, 'deleteProfile'])->name('delete.profile.congr');
            Route::get('/congregation/{id}/User/{user_id}', [CongregationsController::class, 'allow'])->name('congregationAllow');
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

Route::group([
    'middleware' => 'can:congregation.open_meetings_users',
    'prefix' => 'users',
], function () {
    Route::get('/', [UsersController::class, 'allUsersPage'])->name('users');
    Route::get('/card/{id}', [UsersController::class, 'userCard'])->name('userCard');
    Route::post('/card/{id}', [UsersController::class, 'roleAllow'])->name('roleAllow');
    Route::post('/card/{id}/roledelete', [UsersController::class, 'roleDelete'])->name('roleDelete');
    Route::post('/card/{id}/permissionAllow', [UsersController::class, 'permissionAllow'])->name('permissionAllow');
    Route::post('/card/{id}/permissionDelete', [UsersController::class, 'permissionDelete'])->name('permissionDelete');
    Route::post('/card/switchPermission', [CongregationsController::class, 'switchPermission'])->name('switchPermission');
    Route::post('/card/{id}/changeGroup', [UsersController::class, 'changeGroup'])->name('user.changeGroup');

    Route::get('/responsible/', [UsersController::class, 'displayResponsi ble'])->name('users.responsible');
    Route::post('/responsible/', [UsersController::class, 'updateResponsibilities'])->name('users.updateResponsibilities');

    Route::post('/updateGeneratePassword', [UsersController::class, 'updateGeneratePassword'])->name('users.updateGeneratePassword');
    Route::post('/UIkSTqWyNt3X', [UsersController::class, 'connectUser'])->name('connect.user');



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





