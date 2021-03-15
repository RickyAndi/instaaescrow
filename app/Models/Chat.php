<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    protected $protected = [
        'order_id',
        'user_id',
        'content'
    ];
}
