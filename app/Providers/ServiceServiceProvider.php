<?php

namespace App\Providers;

use App\Services\AuthService\AuthService;
use App\Services\AuthService\AuthServiceInterface;
use App\Services\EmailService\EmailService;
use App\Services\EmailService\EmailServiceInterface;
use App\Services\PasswordService\PasswordService;
use App\Services\PasswordService\PasswordServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );

        $this->app->bind(
            EmailServiceInterface::class,
            EmailService::class
        );

        $this->app->bind(
            PasswordServiceInterface::class,
            PasswordService::class
        );
    }
}
