<?php

namespace Database\Seeders;

use App\Models\Cryptocurrency;
use Illuminate\Database\Seeder;

class CryptocurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Cryptocurrency::AVAILABLE_CRYPTOCURRENCIES as $cryptoName) {
            Cryptocurrency::create([
                'name' => $cryptoName
            ]);
        }
    }
}
