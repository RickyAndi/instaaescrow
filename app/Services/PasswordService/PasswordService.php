<?php


namespace App\Services\PasswordService;


use Illuminate\Support\Facades\Hash;

class PasswordService implements PasswordServiceInterface
{
    public function check(string $plainPassword, string $hashedPassword): bool
    {
        return Hash::check($plainPassword, $hashedPassword);
    }

    public function hash(string $plainPassword): string
    {
        return Hash::make($plainPassword);
    }
}
