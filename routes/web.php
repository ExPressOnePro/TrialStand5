<?php

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







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();


Route::group(['middleware' => 'role:User'], function() {
    Route::get('/dashboard-1', function() {
        return view('dashboard');
    });
    Route::get('/UserControl', function () {
        $users = User::all();
        return view('Dev.UserControl', ['users' => $users]);
    })->name('UserControl');
    Route::get('/stand', 'App\Http\Controllers\StandController@index')->name('stand');
});




Route::group(['middleware' => 'role:project-manager'], function() {
    Route::get('/dashboar-2', function() {
        return 'Добро пожаловать, Project Manager';
    });
});
