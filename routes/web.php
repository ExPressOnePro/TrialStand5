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


Route::group(['middleware' => 'role:dev'], function() {

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



    /*UserControl Block BEGIN*/
    Route::get('/stand', 'App\Http\Controllers\StandController@index')
        ->name('stand');

    Route::get('/stand/table', 'App\Http\Controllers\StandController@table')
        ->name('tableStand');

    Route::get('/stand/record', 'App\Http\Controllers\StandController@record')
        ->name('recToStand');


    /*UserControl Block END*/
});




Route::group(['middleware' => 'role:project-manager'], function() {
    Route::get('/dashboar-2', function() {
        return 'Добро пожаловать, Project Manager';
    });
});
