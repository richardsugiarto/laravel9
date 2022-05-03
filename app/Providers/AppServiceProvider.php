<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
<<<<<<< HEAD
	Schema::defaultStringLength(191);
=======
        session()->put('locale', 'id');
        app()->setLocale(session()->get('locale'));
>>>>>>> 691fc2279b510085d53d33989e2c4aa948a3c28c
    }
}
