<?php

namespace Database\Seeders;

use App\Models\PaymentProvider;
use Illuminate\Database\Seeder;

class PaymentProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentProviderData = [
            'BCA'
        ];

        foreach ($paymentProviderData as $data) {
            PaymentProvider::create([
                'name' => $data
            ]);
        }
    }
}
