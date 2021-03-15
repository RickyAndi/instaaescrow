<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'email' => 'admin@admin.com',
                'password' => 'password',
                'name' => 'admin'
            ]
        ];

        $adminRole = Role::where('name', RoleEnum::ADMIN)->first();

        foreach ($userData as $data) {
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'name' => $data['name']
            ]);

            $user->roles()->attach([$adminRole->id]);
        }
    }
}
