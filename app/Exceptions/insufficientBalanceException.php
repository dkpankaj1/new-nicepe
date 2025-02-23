<?php

namespace App\Exceptions;

use App\Services\ToasterService;
use Exception;

class insufficientBalanceException extends Exception
{
    protected $url;
    public function __construct($url)
    {
        $this->url = $url;
    }
    public function render()
    {
        ToasterService::info('Insufficient balance in your wallet. Please add funds to proceed.');
        return redirect($this->url);
    }
}
