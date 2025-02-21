<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    protected $except = [
        'apiclient/wallet-recharge/nicepe/redirect',
        'distributor/wallet-recharge/nicepe/redirect',
        'superdistributor/wallet-recharge/nicepe/redirect',
        'retailer/wallet-recharge/nicepe/redirect',
    ];
}
