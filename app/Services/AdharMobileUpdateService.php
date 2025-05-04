<?php

namespace App\Services;

use App\Enums\Status;
use App\Models\AadharMobileUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdharMobileUpdateService
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'parent' => 'nullable|string|max:255',
            'aadhar' => 'required|digits:12',
            'mobile' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'fingerprint1' => 'required|string',
            'fingerprint2' => 'required|string',
            'fingerprint3' => 'required|string',
            'fingerprint4' => 'required|string',
            'fingerprint5' => 'required|string',
        ];
    }

    public function store(Request $request,$transaction)
    {
        try {
            AadharMobileUpdate::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'parent' => $request->parent,
                'aadhar' => $request->aadhar,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'fingerprint1' => $request->fingerprint1,
                'fingerprint2' => $request->fingerprint2,
                'fingerprint3' => $request->fingerprint3,
                'fingerprint4' => $request->fingerprint4,
                'fingerprint5' => $request->fingerprint5,
                'status' => Status::PENDING->value,
                'forward_transaction' => $transaction->id,
                'remark' => "status is pending",
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function hasSufficientBalance(): bool
    {
        $user = Auth::user();
        return $user->balance;
    }
}