<?php

namespace App\Repositories\RoleRepository;

use App\Models\User;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{
    public function getByUser(User $user): Collection;
}
