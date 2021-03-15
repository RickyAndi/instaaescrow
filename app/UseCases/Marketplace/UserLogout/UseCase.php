<?php

namespace App\UseCases\Marketplace\UserLogout;

use App\Services\AuthService\AuthServiceInterface;

class UseCase
{
    private $authService;

    public function __construct(
        AuthServiceInterface $authService
    )
    {
        $this->authService = $authService;
    }

    public function handle()
    {
        $user = $this->authService->getCurrentUser();
        $this->authService->logoutUser($user);
    }
}
