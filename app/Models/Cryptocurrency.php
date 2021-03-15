<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cryptocurrency extends Model
{
    const BTC = 'BTC';

    const AVAILABLE_CRYPTOCURRENCIES = [
        self::BTC
    ];

    protected $table = 'cryptocurrencies';

    protected $guarded = [];
}
