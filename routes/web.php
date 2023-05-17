<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Models\User;


/*Route::get('/', function () {

    $users = User::all();
    return view('auth.login', ['users' => $users]);

});*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/registration', 'App\Http\Controllers\Auth\RegisterController@pageRegistration')->name('pageRegistration');

/*Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);*/







Auth::routes();


Route::group(['middleware' => 'role:Developer'], function() {

    Route::get('/home',
        [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');

    Route::get('/dashboard-1', function() {
        return view('dashboard');
    });

    /*UserControl Block BEGIN*/
    Route::get('/UserControl',
        'App\Http\Controllers\UserControlController@pageUserControl')
        ->name('pageUserControl');

    Route::get('/UserControl/Role/{id}',
        'App\Http\Controllers\UserControlController@pageRole')
        ->name('UCRole');

    Route::get('/UserControl/User/{id}',
        'App\Http\Controllers\UserControlController@pageUser')
        ->name('UCRUser');



    /*UserControl Block END*/



    /*StandControl Block BEGIN*/
    Route::get('/stand', 'App\Http\Controllers\StandController@allstands')
        ->name('stand');

    Route::get('/stand/create', 'App\Http\Controllers\StandController@createNewStandPage')
        ->name('createNewStandPage');

    Route::post('/stand/create', 'App\Http\Controllers\StandController@createNewStand')
        ->name('createNewStand');

    Route::get('/stand/table/{id}', 'App\Http\Controllers\StandController@tables')
        ->name('StandTable');

    Route::get('/stand/settings/{id}', 'App\Http\Controllers\StandController@settings')
        ->name('StandSettings');

    Route::post('/stand/settings', 'App\Http\Controllers\StandController@time')
        ->name('StandTime');



    Route::get('/stand/record', 'App\Http\Controllers\StandController@record')
        ->name('recToStand');

    Route::get('/stand/test', 'App\Http\Controllers\StandController@test')
        ->name('test');

    Route::get('/stand/testtemp', 'App\Http\Controllers\StandController@test_insert_temp')
        ->name('testtemp');




    /*UserControl Block END*/
});




Route::group(['middleware' => 'role:project-manager'], function() {
    Route::get('/dashboar-2', function() {
        return 'Добро пожаловать, Project Manager';
    });
});
