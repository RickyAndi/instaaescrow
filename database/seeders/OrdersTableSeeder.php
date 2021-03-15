<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enums\RoleEnum;
use Illuminate\Support\Str;
use App\Models\Cryptocurrency;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $btc = Cryptocurrency
            ::where('name', Cryptocurrency::BTC)
            ->first();
        
        $userRole = Role
            ::where('name', RoleEnum::USER)
            ->first();
        
        $users = $userRole->users;
        
        $orderData = [
            'buy' => [
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.002,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.002,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.002,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'buyer_cryptocurrency_address' => 'abc',
                    'cryptocurrency_amount' => 0.002,
                    'type' => Order::TYPE_BUY,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ]
            ],
            'sell' => [
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 5000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 5000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 5000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 5000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 10000,
                    'status' => Order::STATUS_CREATED
                ],
                [
                    'cryptocurrency_id' => $btc->id,
                    'random_id' => Str::random(16),
                    'cryptocurrency_amount' => 0.001,
                    'type' => Order::TYPE_SELL,
                    'price' => 5000,
                    'status' => Order::STATUS_CREATED
                ]
            ]
        ];

        foreach ($orderData['buy'] as $datum) {
            $user = $users->random();
            $mergedData = array_merge($datum, [
                'initiator_id' => $user->id,
                'buyer_id' => $user->id,
                'price_per_unit' => (1 / $datum['cryptocurrency_amount']) * $datum['price']
            ]);

            Order::create($mergedData);
        }

        foreach ($orderData['sell'] as $datum) {
            $user = $users->random();
            $mergedData = array_merge($datum, [
                'initiator_id' => $user->id,
                'seller_id' => $user->id,
                'price_per_unit' => (1 / $datum['cryptocurrency_amount']) * $datum['price'],
                'seller_payment_provider_account_id' => $user->paymentProviderAccounts->random()->id
            ]);

            Order::create($mergedData);
        }
    }
}
