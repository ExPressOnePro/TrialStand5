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

/*Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard-3', function () {

    $users = User::all();
    return view('dashboard', ['users' => $users]);
})->name('dash');

Route::get('/stand', 'App\Http\Controllers\StandController@index')->name('stand');


Route::group(['middleware' => 'role:web-developer'], function() {
    Route::get('/dashboard-1', function() {
        return view('dashboard');
    });
});

Route::group(['middleware' => 'role:project-manager'], function() {
    Route::get('/dashboar-2', function() {
        return 'Добро пожаловать, Project Manager';
    });
});
