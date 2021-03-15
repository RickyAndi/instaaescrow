<?php


namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function save(User $user): void
    {
        $user->save();
    }
}
