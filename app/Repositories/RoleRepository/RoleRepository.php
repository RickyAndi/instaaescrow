<?php

namespace App\Repositories\RoleRepository;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function getByUser(User $user): Collection
    {
        return $user->roles;
    }
}
