<?php

namespace App\Servicies\CurrencyConventor;


use Illuminate\Support\ServiceProvider;

class CurrencyConventorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('CurrencyConventor', function ($app) {

            return new CurrencyConventor;
        });
    }
}
