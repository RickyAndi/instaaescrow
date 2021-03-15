<?php

namespace App\Services\EmailService;

use App\Models\User;

interface EmailServiceInterface
{
    public function sendWelcomeEmail(User $user): void;
}
