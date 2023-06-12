<?php

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;


/*Route::get('/', function () {

    $users = User::all();
    return view('auth.login', ['users' => $users]);

});*/

/**
 * AUTORIZATION ROUTES
 */
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/registration', function () {
    return view('auth.register');
});
Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    /**
     * GENERAL ROUTES
     */
    Route::get('/ads', 'App\Http\Controllers\GeneralController@ads')
        ->name('ads');

    Route::get('/stand', 'App\Http\Controllers\StandController@allstands')
        ->name('stand');

    Route::get('/user/card/{id}', 'App\Http\Controllers\AccountController@account')
        ->name('account');

    Route::get('/notifications', 'App\Http\Controllers\AccountController@notifications')
        ->name('notifications');

    Route::post('/guest/{id}', 'App\Http\Controllers\CongregationRequestsController@joinCongregation')
        ->name('joinCongregation');

    Route::get('/guest', 'App\Http\Controllers\HomeController@guest')
        ->name('guest');

    Route::get('/home',
        'App\Http\Controllers\HomeController@index')
        ->name('home');

    Route::get('/profile',
        'App\Http\Controllers\GeneralController@profile')
        ->name('profile');
});

    /**
     * Manager congregation
     */
    Route::group(['middleware' => 'role:Manager',
        'middleware' => 'role:Developer'], function () {
        Route::get('/congregation',
            'App\Http\Controllers\CongregationsController@select')
            ->name('congregationSelect');

        Route::get('/congregation/{id}',
            'App\Http\Controllers\CongregationsController@view')
            ->name('congregationView');

        Route::get('/congregation/{id}/{user_id}/{conReq}',
            'App\Http\Controllers\CongregationsController@allow')
            ->name('congregationAllow');

        Route::get('/congregation/{id}/{user_id}/{conReq}',
            'App\Http\Controllers\CongregationsController@reject')
            ->name('congregationReject');

});
    /**
     * DEVELOPER
     */

    Route::group(['middleware' => 'role:Developer'], function () {
        Route::get('/roles', 'App\Http\Controllers\DeveloperController@rolesPermissionsPage')
            ->name('rolesPermissionsPage');

        /*UserControl Block BEGIN*/
        Route::get('/users',
            'App\Http\Controllers\UsersController@allUsersPage')
            ->name('users');

        Route::get('/users/card/{id}',
            'App\Http\Controllers\UsersController@userCard')
            ->name('userCard');

        Route::get('/UserControl',
            'App\Http\Controllers\UserControlController@pageUserControl')
            ->name('pageUserControl');

        Route::get('/UserControl/role/{id}',
            'App\Http\Controllers\UserControlController@pageRole')
            ->name('UCRole');

        Route::get('/UserControl/user/{id}',
            'App\Http\Controllers\UserControlController@pageUser')
            ->name('UCRUser');

        Route::post('/UserControl/user/{id}',
            'App\Http\Controllers\DeveloperController@rolesPermissionsChange')
            ->name('rolesPermissionsChange');



        /*StandControl Block BEGIN*/

        Route::get('/stand/create', 'App\Http\Controllers\StandController@createNewStandPage')
            ->name('createNewStandPage');

        Route::post('/stand/create', 'App\Http\Controllers\StandController@createNewStand')
            ->name('createNewStand');

        Route::get('/stand/settings/{id}', 'App\Http\Controllers\StandController@settings')
            ->name('StandSettings');

        Route::post('/stand/settings', 'App\Http\Controllers\StandController@timeUpdate')
            ->name('StandTime');

        Route::get('/stand/test', 'App\Http\Controllers\StandController@test')
            ->name('test');

        Route::get('/stand/ExampleNext', 'App\Http\Controllers\StandController@ExampleTestVersionOfAddingToPublishersNextWeek')
            ->name('ExampleNext');

        Route::get('/stand/ExampleCurrent', 'App\Http\Controllers\StandController@ExampleTestVersionOfAddingToPublishersCurrentWeek')
            ->name('ExampleCurrent');
    });

    Route::group(['middleware' => 'role:User',
        'middleware' => 'role:Developer'], function () {

        Route::get('/stand/table/{id}', 'App\Http\Controllers\StandController@tables')
            ->name('StandTable');

        Route::get('/stand/record1/{id}', 'App\Http\Controllers\StandController@PageUpdateRecordStandFirst')
            ->name('PageUpdateRecordStandFirst');

        Route::get('/stand/record2/{id}', 'App\Http\Controllers\StandController@PageUpdateRecordStandSecond')
            ->name('PageUpdateRecordStandSecond');

        Route::post('/stand/record1/{id}', 'App\Http\Controllers\StandController@UpdateRecordStandFirst')
            ->name('UpdateRecordStandFirst');

        Route::post('/stand/record2/{id}', 'App\Http\Controllers\StandController@UpdateRecordStandSecond')
            ->name('UpdateRecordStandSecond');

        Route::get('/stand/redaction/{id}', 'App\Http\Controllers\StandController@recordRedactionPage')
            ->name('recordRedactionPage');

        Route::get('/stand/redaction/delete1/{id}/{stand}', 'App\Http\Controllers\StandController@recordRedactionDelete1')
            ->name('recordRedactionDelete1');

        Route::get('/stand/redaction/delete2/{id}/{stand}', 'App\Http\Controllers\StandController@recordRedactionDelete2')
            ->name('recordRedactionDelete2');

        Route::post('/stand/redaction/change1/{id}/{stand}', 'App\Http\Controllers\StandController@recordRedactionChange1')
            ->name('recordRedactionChange1');

        Route::post('/stand/redaction/change2/{id}/{stand}', 'App\Http\Controllers\StandController@recordRedactionChange2')
            ->name('recordRedactionChange2');

    });


