<?php

namespace App\Http\Controllers\Retailer;

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

    public function ekycOtp(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|digits:12',
        ]);

        $aadhaarNumber = $request->input('aadhaar_number');
        $response = $this->ekycService->requestOtp($aadhaarNumber);

        if ($response['success']) {
            return response()->json(['status' => true, 'transactionId' => $response['transactionId']]);
        }

        return response()->json(['status' => false, 'message' => $response['message']]);
    }
    public function ekycValidateOtp(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required',
            'otp' => 'required|digits:6',
            'aadhaar_number' => 'required|digits:12',
        ]);

        $transactionId = $request->input('transaction_id');
        $otp = $request->input('otp');
        $aadhaarNumber = $request->input('aadhaar_number');

        $response = $this->ekycService->validateOtpAndGetEkyc($transactionId, $otp, $aadhaarNumber);

        if ($response['success']) {
            return response()->json(['status' => true, 'data' => $response['data']]);
        }

        return response()->json(['status' => false, 'message' => $response['message']]);
    }
    
    public function ekycStore(Request $request)
    {
        
    }
}
