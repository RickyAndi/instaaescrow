<?php


namespace App\Repositories\UserRepository;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getByEmail(string $email): ?User;

    public function save(User $user): void;
}
