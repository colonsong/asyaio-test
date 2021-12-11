<?php

namespace App\Servicies\CurrencyConventor;


use App\Servicies\CurrencyConventor\Exchange;
use App\Servicies\CurrencyConventor\IExchange;
use Illuminate\Support\ServiceProvider;

class ExchangeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(IExchange::class, function ($app) {
            return new Exchange;
        });
    }
}
