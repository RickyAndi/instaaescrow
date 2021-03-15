<?php

namespace App\UseCases\UserLogin;

use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\AuthService\AuthServiceInterface;
use App\Services\EmailService\EmailServiceInterface;

class UseCase
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EmailServiceInterface
     */
    private $emailService;

    /**
     * @var AuthServiceInterface
     */
    private $authService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        EmailServiceInterface $emailService,
        AuthServiceInterface $authService
    )
    {
        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
        $this->authService = $authService;
    }

    public function handle(Request $request): void
    {
        $user = $this->userRepository->getByEmail($request->getEmail());

        if (is_null($user)) {
            $user = new User();
            $user->setEmail($request->getEmail());
            $user->setName($request->getName());
            $this->userRepository->save($user);

            $this->emailService->sendWelcomeEmail($user);
        }

        $this->authService->loginUser($user);
    }
}
