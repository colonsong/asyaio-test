<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExchangeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_change()
    {
        $response = $this->get('/api/v1/exchange/change?from=JPY&to=TWD&amount=1');
        $response->assertStatus(200);
    }
}
