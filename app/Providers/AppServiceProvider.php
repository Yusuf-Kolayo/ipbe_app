<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;


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
        Blade::if('admin', function () {
            return Auth::user() && auth()->user()->usr_type == 'usr_admin' ;
        });

        Blade::if('agent', function () {
            return Auth::user() && auth()->user()->usr_type == 'usr_agent' ;
        });

        Blade::if('client', function () {
            return Auth::user() && auth()->user()->usr_type == 'usr_client' ;
        });

        Blade::if('super', function () {
            return Auth::user() && auth()->user()->usr_type == 'usr_admin' && auth()->user()->adm_type == 'super';
        });


        Paginator::useBootstrap();
    }
}
