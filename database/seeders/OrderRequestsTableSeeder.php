<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Order;
use App\Models\OrderRequest;
use App\Models\Role;
use Illuminate\Database\Seeder;

class OrderRequestsTableSeeder extends Seeder
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

        $orders = Order::get();
        
        for ($count = 0; $count < 20; $count++) {
            
            $order = $orders->random();

            $user = $users->first(function ($user) use ($order) {
                return $user->id != $order->initator_id;
            });

            $paymentProviderAccount = $user->paymentProviderAccounts->first();

            OrderRequest::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'type' => $order->isBuyOrder() ? OrderRequest::TYPE_SELL : OrderRequest::TYPE_BUY,
                'status' => OrderRequest::STATUS_CREATED,
                'amount' => $order->cryptocurrency_amount,
                'payment_provider_account_id' => $order->isBuyOrder() ? $paymentProviderAccount->id : null
            ]);
        }
    }
}
