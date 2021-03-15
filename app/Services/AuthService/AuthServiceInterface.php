<?php

namespace App\Services\AuthService;

use App\Models\User;

interface AuthServiceInterface
{
    public function loginUser(User $user): void;

    public function logoutUser(User $user): void;

    public function loginAdmin(User $user): void;

    public function logoutAdmin(User $user): void;

    public function getCurrentUser(): ?User;

    public function getCurrentAdmin(): ?User;
}
