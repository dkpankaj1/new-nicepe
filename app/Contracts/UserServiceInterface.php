<?php

namespace App\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    public function createUser(array $data, string $type): User;
    public function updateUser(User $user, array $data): User;
    public function deleteUser(User $user): bool;
}
