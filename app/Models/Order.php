<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const TYPE_BUY = 0;
    const TYPE_SELL = 1;

    const STATUS_CREATED = 0;
    const STATUS_MONEY_CAN_BE_TRANSFERED = 1;
    const STATUS_CRYPTO_CAN_BE_TRANSFERED = 2;
    const STATUS_FINISHED = 3;
    const STATUS_CANCELED = 4;
    const STATUS_FAILED = 5;

    protected $table = 'orders';

    protected $fillable = [
        'cryptocurrency_id',
        'initiator_id',
        'seller_id',
        'buyer_id',
        'random_id',
        'status',
        'price_per_unit',
        'buyer_cryptocurrency_address',
        'cryptocurrency_amount',
        'seller_bank',
        'seller_bank_account_name',
        'seller_bank_account_number',
        'type'
    ];

    protected $casts = [
        'cryptocurrency_amount' => 'float',
        'price' => 'float',
        'price_per_unit' => 'float'
    ];

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initator_id', 'id');
    }

    public function isBuyOrder(): bool
    {
        return $this->type == self::TYPE_BUY;
    }


}
