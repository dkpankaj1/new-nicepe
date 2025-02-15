<?php
namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function createUser(array $data, string $type): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
            'wallet' => $data['wallet'] ?? 0,
            'type' => $type,
            'plan_id' => $data['plan'],
            'active' => $data['is_active'],
        ]);
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
            'plan_id' => $data['plan'],
            'active' => $data['is_active'],
        ]);

        return $user;
    }

    public function deleteUser(User $user): bool
    {
        $user->update([
            'deleted_at' => now(),
            'active' => false,
        ]);

        return true;
    }
}