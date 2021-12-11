<?php
namespace App\Servicies\CurrencyConventor;

Interface IExchange {

    public function getRate($from, $to);
}
