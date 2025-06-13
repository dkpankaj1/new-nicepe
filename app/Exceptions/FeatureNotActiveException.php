<?php

namespace App\Exceptions;

use App\Services\ToasterService;
use Exception;

class FeatureNotActiveException extends Exception
{
    protected $redirectUrl;

    public function __construct($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
        //parent::__construct('The feature is not active. Please activate it.');
    }
    public function render()
    {
        ToasterService::error('The feature is not active. Please activate it.');
        return redirect($this->redirectUrl);
    }
}
