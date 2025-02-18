<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploader;
use App\Models\User;
use App\Services\ToasterService;
use App\Services\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

abstract class BaseProfileController extends Controller
{
    protected $userProfileService;
    protected $accountView;
    protected $profileUpdateView;
    protected $passwordUpdateView;
    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
        $this->initializeViewProperties();
    }
    public function index()
    {
        return view($this->accountView, ['user' => Auth::user()]);
    }
    public function account()
    {
        return view($this->profileUpdateView, ['user' => Auth::user()]);
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
            ToasterService::error('Something went wrong.!');
            return redirect()->back();
        }
    }
    public function password()
    {
        return view($this->passwordUpdateView);
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
            ToasterService::error('Something went wrong.!');
            return redirect()->back();
        }
    }
    abstract protected function initializeViewProperties();
}
