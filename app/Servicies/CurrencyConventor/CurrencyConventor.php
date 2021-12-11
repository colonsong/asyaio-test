<?php
namespace App\Servicies\CurrencyConventor;


class CurrencyConventor
{

    private $from;
    private $to;
    private $amount;
    private $exchange;
    private $rate;


    public function from(string $currency) {
        $this->from = $currency;
        return $this;
    }

    public function to(string $currency) {
        $this->to = $currency;
        return $this;
    }

    public function amount(float $amount) {
        $this->amount = $amount;
        return $this;
    }

    public function setExchange(IExchange $exchange) {
        $this->exchange = $exchange;
        return $this;
    }

    public function conver() {
        if (empty ($this->exchange)) {
            throw new InvalidRateException('exchange not setting');
        }
        $this->rate = $this->exchange->getRate($this->from, $this->to);
        $exchangeMoney = $this->multiplicate($this->amount, $this->rate);
        return $this->numberFormat($this->round($exchangeMoney));

    }

    public function multiplicate($amount, $rate, $floatPosition = 5) {
        return bcmul($amount, $rate, $floatPosition);
    }

    public function round(float $amount, int $floatPosition = 2) {
        return round($amount, $floatPosition);;
    }

    public function numberFormat(float $amount,int $floatPosition =2, string $floatFormat = '.', string $thousandFormat = ','){
        return number_format($amount, $floatPosition, $floatFormat, $thousandFormat);
    }

    public function getRate() {
        return $this->rate;
    }



}
