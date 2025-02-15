<?php

namespace App\Exceptions;

use Exception;

class Unauthorize extends Exception
{
    public function render()
    {
        return view('errors.unauthorize');
    }
}
