<?php

namespace App\Enums;

class RoleEnum
{
    const ADMIN = 'ADMIN';
    const USER = 'USER';

    const AVAILABLE_ROLES = [
        self::ADMIN,
        self::USER
    ];
}
