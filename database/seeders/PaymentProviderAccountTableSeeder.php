<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\PaymentProvider;
use App\Models\PaymentProviderAccount;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PaymentProviderAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::where('name', RoleEnum::USER)->first();
        $users = $userRole->users;
        
        $bca = PaymentProvider
            ::where('name', PaymentProvider::PAYMENT_PROVIDER_BCA)
            ->first();

        foreach ($users as $user) {
            PaymentProviderAccount::create([
                'user_id' => $user->id,
                'payment_provider_id' => $bca->id,
                'type' => PaymentProviderAccount::TYPE_USER_ACCOUNT,
                'status' => PaymentProviderAccount::STATUS_APPROVED,
                'account_name' => 'lorem ipsum',
                'account_number' => '123456789'
            ]);
        }
    }
}
