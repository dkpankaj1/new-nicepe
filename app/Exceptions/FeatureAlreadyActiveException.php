<?php

namespace App\Exceptions;

use App\Services\ToasterService;
use Exception;

class FeatureAlreadyActiveException extends Exception
{
    protected $redirectUrl;

    public function __construct($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
        //parent::__construct('Feature is already active');
    }
    public function render()
    {
        ToasterService::error('Feature is already active');
        return redirect($this->redirectUrl);
    }
}
