<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class EkycService
{
    protected $baseUrl;
    protected $bearerToken;

    public function __construct()
    {
        $this->baseUrl = 'https://odfr.agristack.gov.in/farmer-registry-api-od/agristack/v1/api/farmerRegistryEkyc';
        $this->bearerToken = "";
    }

    /**
     * Request OTP for Aadhaar eKYC
     *
     * @param string $aadhaarNumber
     * @return array
     * @throws RequestException
     */
    public function requestOtp(string $aadhaarNumber): array
    {
        $response = Http::withHeaders([
            'Authorization' => $this->bearerToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get("{$this->baseUrl}/requestEKycOtp", [
            'aadhaarNumber' => $aadhaarNumber,
        ]);

        if ($response->successful() && isset($response->json()['data'])) {
            return [
                'success' => true,
                'transactionId' => $response->json()['data'],
            ];
        }

        return [
            'success' => false,
            'message' => $response->json()['message'] ?? 'Failed to connect to OTP API.',
        ];
    }

    /**
     * Validate OTP and fetch eKYC data
     *
     * @param string $transactionId
     * @param string $otp
     * @param string $aadhaarNumber
     * @return array
     * @throws RequestException
     */
    public function validateOtpAndGetEkyc(string $transactionId, string $otp, string $aadhaarNumber): array
    {
        $postData = [
            'language' => 'en',
            'verificationType' => 'EMAIL',
            'verificationSource' => null,
            'otp' => $otp,
            'aadhaarNumber' => $aadhaarNumber,
            'transactionId' => $transactionId,
            'isUpdateRequest' => false,
        ];

        $response = Http::withHeaders([
            'Authorization' => $this->bearerToken,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/validateOtpAndGetEkycData", $postData);

        if ($response->successful() && isset($response->json()['data'])) {
            $data = $response->json()['data'];

            return [
                'success' => true,
                'ekycData' => [
                    'aadhaarName' => $data['aadhaarName'] ?? 'N/A',
                    'ekycLLAadhaarName' => $data['ekycLLAadhaarName'] ?? 'N/A',
                    'dob' => $data['dob'] ?? 'N/A',
                    'genderEng' => $data['gender']['genderDescEng'] ?? 'N/A',
                    'genderHindi' => $data['gender']['genderDescLl'] ?? 'N/A',
                    'ekycCo' => $data['ekycCo'] ?? 'N/A',
                    'ekycLoc' => $data['ekycLoc'] ?? 'N/A',
                    'ekycLLLoc' => $data['ekycLLLoc'] ?? 'N/A',
                    'ekycVtc' => $data['ekycVtc'] ?? 'N/A',
                    'ekycLLVtc' => $data['ekycLLVtc'] ?? 'N/A',
                    'ekycDist' => $data['ekycDist'] ?? 'N/A',
                    'ekycLLDist' => $data['ekycLLDist'] ?? 'N/A',
                    'ekycState' => $data['ekycState'] ?? 'N/A',
                    'ekycLLState' => $data['ekycLLState'] ?? 'N/A',
                    'ekycPincode' => $data['ekycPincode'] ?? 'N/A',
                    'ekycLLPincode' => $data['ekycLLPincode'] ?? 'N/A',
                    'photoBase64' => $data['ekycPhotoBaseStr'] ?? '',
                ],
            ];
        }

        return [
            'success' => false,
            'message' => $response->json()['message'] ?? 'Failed to validate OTP.',
        ];
    }
}