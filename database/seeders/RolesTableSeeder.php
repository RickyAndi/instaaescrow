<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (RoleEnum::AVAILABLE_ROLES as $role) {
            if (!Role::where('name', $role)->exists()) {
                Role::create([
                    'name' => $role
                ]);
            }
        }
    }
}
