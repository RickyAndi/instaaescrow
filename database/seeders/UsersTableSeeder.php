<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::where('name', RoleEnum::USER)->first();
        $userData = [
            [
                'name' => 'user1',
                'email' => 'user1@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user2',
                'email' => 'user2@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user3',
                'email' => 'user3@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user4',
                'email' => 'user4@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user5',
                'email' => 'user5@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user6',
                'email' => 'user6@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user7',
                'email' => 'user7@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user8',
                'email' => 'user8@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user9',
                'email' => 'user9@email.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'user10',
                'email' => 'user10@email.com',
                'password' => Hash::make('password')
            ],
        ];
        
        foreach ($userData as $datum) {
            $user = User::create($datum);
            $user->roles()->attach([$userRole->id]);
        }
    }
}
