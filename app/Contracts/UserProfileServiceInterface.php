<?php

namespace App\Contracts;

use App\Models\User;

interface UserProfileServiceInterface
{
    public function updateProfile(User $user,array $data): User;
    public function changePassword(User $user,string $password): User;
}
