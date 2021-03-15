<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{
    const TYPE_BUY = 0;
    const TYPE_SELL = 1;
    
    const STATUS_CREATED = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_FINISHED = 3;

    protected $table = 'order_requests';

    protected $fillable = [
        'user_id',
        'order_id',
        'type',
        'status',
        'amount'
    ];

    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
