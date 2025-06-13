<?php

namespace App\Services;

use App\Contracts\UserProfileServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileService implements UserProfileServiceInterface
{
    public function updateProfile(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function changePassword(User $user, string $password): User
    {
        $user->update(['password' => Hash::make($password)]);
        return $user;
    }
}
