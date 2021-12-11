<?php

namespace App\Servicies\CurrencyConventor;

use Exception;

class InvalidRateException extends Exception
{
    // ...
    private $msg;

    public function __construct(string $msg= '') {
        parent::__construct($msg);
    }
}
