<?php

namespace Tests\Unit;

use App\Facades\CurrencyConventor;
use App\Servicies\CurrencyConventor\Exchange;
use App\Servicies\CurrencyConventor\IExchange;
use App\Servicies\CurrencyConventor\InvalidRateException;
use Mockery\MockInterface;
use Tests\TestCase;

class ExchangeTest extends TestCase
{
    public $from = 'TWD';

    public $to   = 'JPY';

    public function test_get_rate()
    {
        $exchange = new Exchange();
        $rate = $exchange->getRate($this->from, $this->to);
        $this->assertEquals(3.669, $rate);
    }

    public function test_get_rate_if_currency_is_wrong()
    {
        $this->expectException(InvalidRateException::class);
        $this->from = 'testKey';
        $exchange = new Exchange();
        $rate = $exchange->getRate($this->from, $this->to);
        $this->assertEquals(3.669, $rate);
    }

}
