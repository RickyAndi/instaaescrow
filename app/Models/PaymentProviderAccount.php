<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentProviderAccount extends Model
{
    use SoftDeletes;

    const STATUS_CREATED = 0;
    const STATUS_REJECTED = 1;
    const STATUS_APPROVED = 2;

    const TYPE_USER_ACCOUNT = 0;
    const TYPE_APPLICATION_ACCOUNT = 1;
    
    protected $table = 'payment_provider_accounts';

    protected $fillable = [
        'payment_provider_id',
        'status',
        'account_name',
        'account_number',
        'type',
        'status'
    ];
}
