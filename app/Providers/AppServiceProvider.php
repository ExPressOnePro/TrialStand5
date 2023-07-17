<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
*/
    public function boot()
    {
        App::setLocale('ru'); // здесь вместо 'ru' может быть любая нужная вам локаль
        Config::set('app.locale', 'ru'); // здесь тоже указываем нужную локаль
        Lang::setLocale('ru'); // и здесь указываем нужную локаль
    }
}
