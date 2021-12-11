<?php
namespace App\Servicies\CurrencyConventor;


class Exchange implements IExchange
{
    private $rates;

    public function getRate($from, $to) {
        $this->setRates();
        if (!isset($this->rates->currencies->{$from}->{$to})) {
            throw new InvalidRateException('rate not found');
        }
        return $this->rates->currencies->{$from}->{$to};
    }

    private function setRates() {
        $this->rates  = json_decode('{"currencies":{"TWD":{"TWD":1,"JPY":3.669,"USD":0.03281},"JPY":{"TWD":0.26956,"JPY":1,"USD":0.00885},"USD":{"TWD":30.444,"JPY":111.801,"USD":1}}}');
    }

}
