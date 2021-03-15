<?php

namespace App\UseCases\Backoffice\AdminLogin;

use App\Enums\RoleEnum;
use App\Exceptions\PasswordDoesNotMatchException;
use App\Exceptions\UserDoesNotExistException;
use App\Exceptions\UserIsNotAdminException;
use App\Models\User;
use App\Repositories\RoleRepository\RoleRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\AuthService\AuthServiceInterface;
use App\Services\PasswordService\PasswordServiceInterface;

class UseCase
{
    private $userRepository;
    private $authService;
    private $roleRepository;
    private $passwordService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        AuthServiceInterface $authService,
        RoleRepositoryInterface $roleRepository,
        PasswordServiceInterface $passwordService
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->authService = $authService;
        $this->passwordService = $passwordService;
    }

    public function handle(Request $request): void
    {
        $user = $this->userRepository->getByEmail($request->getEmail());

        if (is_null($user)) {
            throw new UserDoesNotExistException('User does not exist');
        }

        if (!$this->isUserAdmin($user)) {
            throw new UserIsNotAdminException('User is not admin, cannot enter admin page');
        }

        $doPasswordMatch = $this->passwordService
            ->check($request->getPassword(), $user->getHashedPassword());

        if (!$doPasswordMatch) {
            throw new PasswordDoesNotMatchException('Password does not match');
        }

        $this->authService->loginAdmin($user);
    }

    private function isUserAdmin(User $user): bool
    {
        $roles = $this->roleRepository->getByUser($user);
        $rolesName = $roles->pluck('name');
        return in_array(RoleEnum::ADMIN, $rolesName->toArray());
    }
}
