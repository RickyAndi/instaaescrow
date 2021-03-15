<?php


namespace App\Services\EmailService;

use App\Models\User;

class EmailService implements EmailServiceInterface
{
    public function sendWelcomeEmail(User $user): void
    {
        
    }
}
