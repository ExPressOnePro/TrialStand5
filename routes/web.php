<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'role:web-developer'], function() {
    Route::get('/dashboard-1', function() {
        return 'Добро пожаловать, Веб-разработчик';
    });
});

Route::group(['middleware' => 'role:project-manager'], function() {
    Route::get('/dashboar-2', function() {
        return 'Добро пожаловать, Project Manager';
    });
});
