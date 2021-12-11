<?php

namespace Tests\Unit;

use App\Facades\CurrencyConventor;
use App\Servicies\CurrencyConventor\Exchange;
use App\Servicies\CurrencyConventor\IExchange;
use Mockery\MockInterface;
use Tests\TestCase;

class CurrencyConventorTest extends TestCase
{

    public $from = 'TWD';

    public $to   = 'JPY';

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_normal_covert()
    {

        $exchangeMock = $this->mock(IExchange::class, function (MockInterface $mock) {
            $mock->shouldReceive('getRate')->once()->andReturn(3.67);
        });

        $amount = CurrencyConventor::setExchange($exchangeMock)
            ->from($this->from)
            ->to($this->to)
            ->amount(1)
            ->conver();

        $this->assertEquals(3.67, $amount);
    }
}
