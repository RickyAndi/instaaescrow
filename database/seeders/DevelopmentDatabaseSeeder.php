<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DevelopmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CryptocurrenciesTableSeeder::class);
        $this->call(PaymentProviderSeeder::class);
        $this->call(PaymentProviderAccountTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderRequestsTableSeeder::class);
    }
}
