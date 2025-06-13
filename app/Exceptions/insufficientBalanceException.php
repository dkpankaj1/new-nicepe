<?php

namespace App\Exceptions;

use Exception;

class insufficientBalanceException extends Exception
{
    public function __construct()
    {
        parent::__construct('Insufficient balance in your wallet. Please add funds to proceed.');
    }
}
