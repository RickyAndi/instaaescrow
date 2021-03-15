<?php

namespace App\Services\AuthService;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    public function logoutUser(User $user): void
    {
        Auth::logout();
    }

    public function loginUser(User $user): void
    {
        Auth::guard('web')->login($user, true);
    }

    public function loginAdmin(User $user): void
    {
        Auth::guard('admin')->login($user, true);
    }

    public function logoutAdmin(User $user): void
    {
        Auth::guard('admin')->logout();
    }

    public function getCurrentUser(): ?User
    {
        return Auth::guard('web')->user();
    }

    public function getCurrentAdmin(): ?User
    {
        return Auth::guard('admin')->user();
    }
}
