<?php

namespace App\Providers;

use App\Models\Addresses\Country;
use Illuminate\Support\ServiceProvider;
use Auth;
use Route;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('route_name', Route::currentRouteName());
        });
        View::composer('*', function($view){
            $view->with('user', Auth::user());
        });
        View::composer('partials.address-form', function ($view) {
            $view->with('countries', Country::all()->pluck('name', 'id'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
