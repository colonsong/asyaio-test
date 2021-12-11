<?php

namespace App\Servicies\CurrencyConventor;

use Exception;

class InvalidCurrencyException extends Exception
{
    // ...
    private $msg;

    public function __construct(string $msg= '') {
        parent::__construct($msg);
    }
}
