<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationData extends Model
{
    const KEY_APPLICATION_NAME = 'application_name';
    const KEY_APPLICATION_OPEN_STATUS = 'application_open_status';

    const TYPE_BOOLEAN = 'type_boolean';
    const TYPE_STRING = 'type_string';
    const TYPE_INTEGER = 'type_integer';
    const TYPE_DECIMAL = 'type_decimal';

    const AVAILABLE_DEFAULT_APPLICATION_DATA = [
        self::KEY_APPLICATION_NAME => [
            'type' => self::TYPE_STRING,
            'value' => 'InstaEscrow'
        ],
        self::KEY_APPLICATION_OPEN_STATUS => [
            'type' => self::TYPE_BOOLEAN,
            'value' => false
        ]
    ];

    protected $table = 'application_data';

    protected $fillable = [
        'key',
        'type',
        'boolean_value',
        'string_value',
        'integer_value',
        'decimal_value'
    ];
}
