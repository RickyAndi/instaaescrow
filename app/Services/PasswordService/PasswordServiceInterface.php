<?php


namespace App\Services\PasswordService;


interface PasswordServiceInterface
{
    public function hash(string $plainPassword): string;

    public function check(string $plainPassword, string $hashedPassword): bool;
}
