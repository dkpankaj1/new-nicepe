<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Http\Controllers\Controller;
use App\Services\EkycService;
use Illuminate\Http\Request;

class EkycController extends Controller
{
    protected $ekycService;

    public function __construct(EkycService $ekycService)
    {
        $this->ekycService = $ekycService;
    }
    public function ekyc()
    {
        return view('ekyc.create',[
            'title' => 'eKYC',
        ]);
    }
}
