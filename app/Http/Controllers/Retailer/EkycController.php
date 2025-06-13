<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use App\Services\EkycService;
use App\Services\ToasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EkycController extends Controller
{
    protected $ekycService;

    public function __construct(EkycService $ekycService)
    {
        $this->ekycService = $ekycService;
    }
    public function showEkycForm()
    {
        return view('ekyc.ekyc', [
            'title' => 'eKYC',
            'action' => route('retailer.ekyc.request')
        ]);
    }

    public function sendEkycOtp(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|digits:12',
        ]);

        $aadhaarNumber = $request->input('aadhaar_number');


        try {
            // Request OTP from eKYC service
            $response = $this->ekycService->requestOtp($aadhaarNumber);

            if ($response['success']) {

                Session::put([
                    'ekyc_transaction_id' => $response['transactionId'],
                    'aadhaar_number' => $aadhaarNumber,
                ]);

                return redirect()->route('retailer.ekyc.validate')->with([
                    'success' => 'OTP sent successfully.'
                ]);

            }

            return redirect()->back()->withErrors([
                'message' => $response['message'] ?? 'Failed to connect to OTP API.',
            ])->withInput();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'message' => 'An error occurred while requesting OTP. Please try again later.',
            ])->withInput();
        }
    }
    public function showOtpValidationForm(Request $request)
    {

        if (!Session::has('ekyc_transaction_id') || !Session::has('aadhaar_number')) {
            return redirect()->route('retailer.ekyc.request')->withErrors([
                'message' => 'Session expired or invalid. Please request OTP again.',
            ]);
        }

        return view('ekyc.otp', [
            'title' => 'eKYC OTP Validation',
            'action' => route('retailer.ekyc.validate'),
        ]);
    }

    public function validateOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        if (!Session::has('ekyc_transaction_id') || !Session::has('aadhaar_number')) {
            return redirect()->route('retailer.ekyc.request')->withErrors([
                'message' => 'Session expired or invalid. Please request OTP again.',
            ]);
        }

        $transactionId = Session::get('ekyc_transaction_id');
        $aadhaarNumber = Session::get('aadhaar_number');
        $otp = $request->input('otp');

        try {

            $response = $this->ekycService->validateOtpAndGetEkyc($transactionId, $otp, $aadhaarNumber);
            if ($response['success']) {
                $ekycData = $response['ekycData'];

                // Store eKYC data in the session
                Session::forget(['ekyc_transaction_id', 'aadhaar_number']);

                // Update user data in the database
                Auth::user()->update([
                    'ekyc' => 1,
                    'aadhaarName' => $ekycData['aadhaarName'] ?? Auth::user()->aadhaarName,
                    'ekycLLAadhaarName' => $ekycData['ekycLLAadhaarName'] ?? Auth::user()->ekycLLAadhaarName,
                    'dob' => $ekycData['dob'] ?? Auth::user()->dob,
                    'genderEng' => $ekycData['genderEng'] ?? Auth::user()->genderEng,
                    'genderHindi' => $ekycData['genderHindi'] ?? Auth::user()->genderHindi,
                    'ekycCo' => $ekycData['ekycCo'] ?? Auth::user()->ekycCo,
                    'ekycLoc' => $ekycData['ekycLoc'] ?? Auth::user()->ekycLoc,
                    'ekycLLLoc' => $ekycData['ekycLLLoc'] ?? Auth::user()->ekycLLLoc,
                    'ekycVtc' => $ekycData['ekycVtc'] ?? Auth::user()->ekycVtc,
                    'ekycLLVtc' => $ekycData['ekycLLVtc'] ?? Auth::user()->ekycLLVtc,
                    'ekycDist' => $ekycData['ekycDist'] ?? Auth::user()->ekycDist,
                    'ekycLLDist' => $ekycData['ekycLLDist'] ?? Auth::user()->ekycLLDist,
                    'ekycState' => $ekycData['ekycState'] ?? Auth::user()->ekycState,
                    'ekycLLState' => $ekycData['ekycLLState'] ?? Auth::user()->ekycLLState,
                    'ekycPincode' => $ekycData['ekycPincode'] ?? Auth::user()->ekycPincode,
                    'ekycLLPincode' => $ekycData['ekycLLPincode'] ?? Auth::user()->ekycLLPincode,
                    'photoBase64' => $ekycData['photoBase64'] ?? Auth::user()->photoBase64,
                ]);

                ToasterService::success('eKYC completed successfully.');
                return redirect()->route('retailer.dashboard')->with([
                    'success' => 'eKYC completed successfully.',
                ]);
            }

            return redirect()->back()->withErrors([
                'otp' => 'Invalid OTP. Please try again.',
            ])->withInput();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'otp' => 'An error occurred while validating OTP. Please try again later.',
            ])->withInput();
        }

    }
}
