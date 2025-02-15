<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserProfileService;
use App\Services\ToasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    protected $userProfileService;
    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }
    public function index()
    {
        return view('admin.account.index', ['user' => Auth::user()]);
    }

    public function account()
    {
        return view('admin.account.profile', ['user' => Auth::user()]);

    }
    public function accountUpdate(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => [
                'required',
                Rule::unique(User::class, 'email')
                    ->ignore(Auth::user()->id)
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        try {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            if ($request->hasFile('avatar')) {
                $fileUpload = new FileUploader();
                if (Auth::user()->getRawOriginal('avatar')) {
                    $fileUpload->deleteFile(Auth::user()->getRawOriginal('avatar'));
                }
                $data['avatar'] = $fileUpload->setDirectory('avatar')
                    ->setHeight(200)
                    ->setWidth(200)
                    ->uploadImage($request->file('avatar'));
            }

            $this->userProfileService->updateProfile($request->user(), $data);

            ToasterService::success('Profile update success.!');

            return redirect()->back();

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            
            dd($e->getMessage());

            ToasterService::error('Something went wrong.!');

            return redirect()->back();

        }
    }

    public function password()
    {
        return view('admin.account.password');
    }
    public function passwordUpdate(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        try {
            $this->userProfileService->changePassword($request->user(), $validated['password']);

            ToasterService::success('Password update success.!');

            return redirect()->back();

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            ToasterService::error('Something went wrong.!');

            return redirect()->route('account.profile.index');
        }

    }
}
